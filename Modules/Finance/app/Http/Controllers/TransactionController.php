<?php

namespace Modules\Finance\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Shared\Contracts\User\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Finance\Services\PaymentService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TransactionController extends Controller
{
    function __construct(
        private readonly OrderServiceInterface $orderService,
        private readonly PaymentService  $paymentService,
    )
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function pay(Request $request): JsonResponse
    {
        $request->validate([
            'order_id' => 'required',
        ]);
        $order_id = $request->get('order_id');

        $amount = $this->orderService->getOrderAmountWithOrderId($order_id);
        if(!$amount) return response()->json(['message' => 'The order does not exist.'], ResponseAlias::HTTP_NOT_FOUND);

        $transaction_id = $this->paymentService->processPayment($amount, $order_id);

        if(!$transaction_id) return response()->json(['message' => 'The payment was not successful.'], ResponseAlias::HTTP_NOT_ACCEPTABLE);

        $this->orderService->orderPayed($order_id);

        return response()->json(['message' => 'The payment was successful.']);
    }
}
