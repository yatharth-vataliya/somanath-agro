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
        return view('order.create', compact('customer_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'product_name.*' => 'required|string',
            'company_name.*' => 'required|string',
            'batch_no.*' => 'required|string',
            'expiry_date.*' => 'required|date',
            'product_quantity.*' => 'required|integer',
            'product_price.*' => 'required|integer',
            'paid' => 'required|integer'
        ], [
            'customer_id.required' => 'Please don\'t mess with the code :):',
            'product_name.*.required' => 'Please fill product name in all the fields :):',
            'product_quantity.*.required' => 'please fill product price in all the fields :):',
            'product_price.*.required' => 'please fill product price in all the fields :):',
            'product_quantity.*.integer' => 'please fill product price in (digit) all the fields :):',
            'product_price.*.integer' => 'please fill product price in (digit) all the fields :):',
            'paid.required' => 'Please fill the paid field at least with zero (0) :):'
        ]);

        $order = Order::select(['order_unique_id'])->orderBy('id', 'desc')->first();
        $order_id = NULL;
        if ($order == NULL || $order == '') {
            $order_unique_id = 'order_1';
        } else {
            $temp_id = explode('_', $order->order_unique_id);
            $int_id = 1 + (int)end($temp_id);
            $order_unique_id = 'order_' . $int_id;
        }

        $customer = Customer::find(decrypt($request->input('customer_id')));
//        $customer_unique_id = $customer?->customer_unique_id; // for php8
        $customer_unique_id = NULL;
        if (!empty($customer)) {
            $customer_unique_id = $customer->customer_unique_id;
        } else {
            return back()->withErrors(['errors' => 'Please Don\'t mess with the code']);
        }

        $total = NULL;

        for ($i = 0; $i < count($request->input('product_name')); $i++) {
            $total += $request->input('product_price')[$i] * $request->input('product_quantity')[$i];
        }

        $customer->total_paid = $customer->total_paid + $total;
        $pending = $total - $request->input('paid');
        $customer->total_pending = $customer->total_pending + $pending;
        $customer->save();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $customer->id,
            'customer_unique_id' => $customer->customer_unique_id,
            'order_unique_id' => $order_unique_id,
            'total' => $total,
            'paid' => $request->input('paid'),
            'pending' => $total - $request->input('paid')
        ]);

        for ($i = 0; $i < count($request->input('product_name')); $i++) {

            OrderItem::create([
                'user_id' => auth()->user()->id,
                'order_id' => $order->id,
                'customer_id' => $customer->id,
                'customer_unique_id' => $customer->customer_unique_id,
                'product_name' => $request->input('product_name')[$i],
                'company_name' => $request->input('company_name')[$i],
                'batch_no' => $request->input('batch_no')[$i],
                'expiry_date' => $request->input('expiry_date')[$i],
                'product_quantity' => $request->input('product_quantity')[$i],
                'product_price' => $request->input('product_price')[$i],
                'total' => $request->input('product_price')[$i] * $request->input('product_quantity')[$i]
            ]);

        }

        return redirect()->route('orders.index', ['customer_id' => encrypt($customer->id)]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show($order_id)
    {
        $order = Order::find(decrypt($order_id));
        $customer = Customer::find($order->customer_id);
        $order_items = OrderItem::where('order_id', decrypt($order_id))->get();
        return view('order.order_details', compact('order', 'order_items', 'customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
