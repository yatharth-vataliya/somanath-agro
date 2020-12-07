@section('title')
    Order Section
@endsection
<div class="container-fluid rounded">
    <div class="row p-2">
        <div class="col-md-12 text-right">
            <a href="{{ route('order.create',['customer_id' => $customer_id ]) }}" class="btn btn-success shadow-sm">Add Order</a>
        </div>
    </div>
    <div class="row shadow-sm p-2">
        <div class="col-md-12">

        </div>
    </div>
</div>
