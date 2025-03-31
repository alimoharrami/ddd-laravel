<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Domain\Models\Order;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $orders = Order::all();

        return response()->json([
            'orders' => $orders
        ]);
    }
}
