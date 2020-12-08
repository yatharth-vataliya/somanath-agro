<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($customer_id)
    {
        return view('order.create',compact('customer_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'product_name.*' => 'required|string',
            'product_quantity.*' => 'required|integer',
            'product_price.*' => 'required|integer',
            'paid' => 'required|integer'
        ],[
            'customer_id.required' => 'Please don\'t mess with the code :):',
            'product_name.*.required' => 'Please fill product name in all the fields :):',
            'product_quantity.*.required' => 'please fill product price in all the fields :):',
            'product_price.*.required' => 'please fill product price in all the fields :):',
            'product_quantity.*.integer' => 'please fill product price in (digit) all the fields :):',
            'product_price.*.integer' => 'please fill product price in (digit) all the fields :):',
            'paid.required' => 'Please fill the paid field at least with zero (0) :):'
        ]);

        $order = OrderP::select(['order_unique_id'])->orderBy('id','desc')->first();
        $order_id = NULL;
        if ($order == NULL || $order == '') {
            $order_id = 'order_1';
        } else {
            $temp_id = explode('_', $order->order_unique_id);
            $int_id = 1 + (int)end($temp_id);
            $order_id = 'order_' . $int_id;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
