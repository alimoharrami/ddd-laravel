<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Domain\Models\Order;
use App\Shared\Contracts\Product\ProductServiceInterface;
use App\Shared\Contracts\User\FinanceServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Order\Services\OrderProductService;

class OrderController extends Controller
{
    public function __construct(
        private readonly ProductServiceInterface $productService,
        private readonly FinanceServiceInterface $financeService,
        private readonly OrderProductService $orderProductService,
    )
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $orders = Order::query()->where('user_id', auth()->id())->get();

        $ordersWithProducts = $this->orderProductService->attachProductsToOrders($orders, $this->productService);

        return response()->json([
            'orders' => $ordersWithProducts
        ]);
    }

    public function show(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:orders,id'
        ]);

        $order = Order::query()
            ->where('id', $validated['id'])
            ->where('user_id', auth()->id())
            ->first();

        if(!$order) return response()->json(['message' => 'Order not found.'], 404);

        $orderWithProducts = $this->orderProductService->attachProductsToOrder($order, $this->productService);

        $orderTransactions = $this->financeService->getTransactionDTOsWithOrderID($orderWithProducts->id);

        return response()->json([
            'order' => $orderWithProducts,
            'transactions' => $orderTransactions
        ]);
    }
}
