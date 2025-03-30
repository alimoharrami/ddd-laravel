<?php

namespace Modules\Order\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //todo return orders
    }

    /**
     * Show the specified resource.
     */
    public function disableOrder($id)
    {
        //todo make order disable
    }

    public function update($id)
    {
        //todo update order amounts
    }
}
