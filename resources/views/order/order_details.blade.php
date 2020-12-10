@extends('layouts.app')

@section('title')
    Order Details
@endsection

@section('styles')

@endsection

@section('content')

    <div class="container-fluid bg-white">
        <div class="row p-2 rounded">
            <div class="col-md-4">
                Customer Name :- {{ $customer->customer_name }}
            </div>
            <div class="col-md-4">
                Customer Address :- {{ $customer->customer_address }}
            </div>
            <div class="col-md-4">
                Customer Mobile :- {{ $customer->customer_mobile }}
            </div>
        </div>
        <div class="row p-2 rounded">
            <div class="col-md-4">
                Total :- {{ $order->total }}
            </div>
            <div class="col-md-4">
                Paid :- {{ $order->paid }}
            </div>
            <div class="col-md-4">
                Pending :- {{ $order->pending }}
            </div>
        </div>
        <div class="row rounded shadow-sm">
            <div class="col-md-12">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($no =1)
                    @foreach($order_items as $order_item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $order_item->product_name }}</td>
                            <td>{{ $order_item->product_quantity }}</td>
                            <td>{{ $order_item->product_price }}</td>
                            <td>{{ $order_item->product_quantity * $order_item->product_price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
