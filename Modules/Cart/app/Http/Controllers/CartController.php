<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCart()
    {
        //todo
    }

    /**
     * Show the form for creating a new resource.
     */
    public function AddItem(Request $request)
    {
        //todo
    }

    public function removeItem(Request $request)
    {
        //todo
    }

    public function updateItemQuantity(Request $request)
    {
        //todo
    }

    public function createOrder(Request $request)
    {
        //todo

        //get shipment address from user

        //create order
    }
}
