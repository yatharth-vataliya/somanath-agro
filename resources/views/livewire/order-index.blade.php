@section('title')
    Order Section
@endsection
<div class="container-fluid rounded">
    <div class="row p-2">
        <div class="alert alert-info shadow-sm col-md-10 text-center">
            <h5>
                Name :- {{ $customer->customer_name }} Address :- {{ $customer->customer_address }} Mobile
                :- {{ $customer->customer_mobile }}
            </h5>
        </div>
        <div class="col-md-2">
            <a href="{{ route('order.create',['customer_id' => $customer_id ]) }}" class="btn btn-success shadow-sm">Add
                Order</a>
        </div>
    </div>
    <div class="row shadow-sm p-2">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Order Number</th>
                    <th>Customer Number</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Pending</th>
                    <th>Order Details</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @php($no = 1)
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $order->order_unique_id }}</td>
                        <td>{{ $order->customer_unique_id }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->paid }}</td>
                        <td>{{ $order->pending }}</td>
                        <td><a href="{{ route('order.show',[ 'order_id' => encrypt($order->id) ]) }}" class="btn btn-outline-primary">Order Details</a></td>
                        <td>{{ date('d-m-Y h:m a',strtotime($order->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
