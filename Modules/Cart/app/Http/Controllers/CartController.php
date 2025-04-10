<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Domain\Models\Cart;
use App\Modules\Product\Domain\Models\CartItem;
use App\Shared\Contracts\Product\ProductServiceInterface;
use App\Shared\Contracts\User\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cart\Services\CartProductService;
use Modules\Shared\DTOs\User\CartItemDTO;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CartController extends Controller
{
    function __construct(
        private readonly ProductServiceInterface $productService,
        private readonly CartProductService $cartProductService,
        private readonly OrderServiceInterface $orderService,
    )
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function getCart(): JsonResponse
    {
        $cart = Cart::with('items')->firstOrCreate(
            ['user_id' => auth()->id()]
        );

        if ($cart->items->isEmpty()) {
            return response()->json(['cart' => $cart]);
        }

        $cartWithProducts = $this->cartProductService->attachProductsToCart($cart, $this->productService);

        return response()->json(['cart' => $cartWithProducts]);
    }

    /**
     * Add item to cart
     */
    public function AddItem(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity'   => 'required|integer|min:1',
        ]);

        $cart = Cart::query()->firstOrCreate(
            ['user_id' => auth()->id()]
        );

        $product = $this->productService->getProductDTOAvailable($validated['product_id'], $validated['quantity']);

        if(!$product) return response()->json(['message' => 'Product not Available!']);


        $cartItem = CartItem::query()->where('cart_id', $cart->id)
            ->where('product_id', $validated['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $validated['quantity'];
            $cartItem->save();
        } else {
            CartItem::query()->create([
                'cart_id'    => $cart->id,
                'product_id' => $validated['product_id'],
                'quantity'   => $validated['quantity'],
                'price'      => $product->price,
            ]);
        }

        return response()->json(['message' => 'Product Added to cart successfully!']);
    }

    public function removeItem(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required',
        ]);

        $cart = Cart::query()->where('user_id', auth()->id())->first();

        if (!$cart)
            return response()->json(['message' => 'Cart not found.'], ResponseAlias::HTTP_NOT_FOUND);

        $cartItem = $cart->items()->where('product_id', $validated['product_id'])->first();

        if (!$cartItem)
            return response()->json(['message' => 'Item not found in the cart.'], ResponseAlias::HTTP_NOT_FOUND);

        $cartItem->delete();

        return response()->json(['message' => 'Product Deleted From Cart Successfully']);
    }

    public function createOrder(): JsonResponse
    {
        $cart = Cart::query()->where('user_id', auth()->id())->first();

        if (!$cart || $cart->items->isEmpty())
            return response()->json(['message' => 'Your cart is empty or not found.'], ResponseAlias::HTTP_NOT_FOUND);

        $cartItemsDTOs = $cart->items->map(function ($item) {
            return new CartItemDTO(
                $item->id,
                $item->product_id,
                $item->quantity,
                $item->price
            );
        })->toArray();

        $this->orderService->submitOrder(auth()->id(), $cartItemsDTOs);

        return response()->json(['message' => 'Order placed successfully!']);
    }
}
