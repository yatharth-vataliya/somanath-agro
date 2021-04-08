@extends('layouts.app')

@section('title')
Order Details
@endsection

@section('styles')

@endsection

@section('content')

<div class="container-fluid bg-white" id="print-invoice">
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
        <div class="col-md-3">
            Total :- {{ $order->total }}
        </div>
        <div class="col-md-3">
            Paid :- {{ $order->paid }}
        </div>
        <div class="col-md-3">
            Pending :- {{ $order->pending }}
        </div>
        <div class="col-md-3 print-div">
            <button type="button" onclick="printInvoice();" class="btn btn-outline-danger">Get Print Out</button>
        </div>
    </div>
    <div class="row rounded shadow-sm">
        <div class="col-md-12">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Product Company</th>
                        <th>Batch No</th>
                        <th>Expiry Date</th>
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
                        <td>{{ $order_item->company_name }}</td>
                        <td>{{ $order_item->batch_no }}</td>
                        <td>{{ $order_item->expiry_date }}</td>
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
<script>
    function printInvoice() {
        $('.print-div').css('display', 'none');
        printJS('print-invoice', 'html');
        $('.print-div').css('display', 'block');
    }
</script>
@endsection