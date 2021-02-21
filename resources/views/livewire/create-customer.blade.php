@section('title')
    Add Customer
@endsection
<div class="container-fluid bg-white rounded shadow-sm">
    @if ($errors->any())
        <div class="alert alert-danger my-2 p-2">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="my-1 p-2 rounded">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(!empty(session('info')))
        <div class="alert alert-info p-2 m-2 text-center">
            {{ session('info') }}
        </div>
    @endif
    <div class="row p-2">
        <div class="col-md-12">
            <form wire:submit.prevent="storeCustomer">
                <div class="row">
                    <div class="col-md-4">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" wire:model="customer_name" id="customer_name" class="form-control" placeholder="Customer Name">
                    </div>
                    <div class="col-md-4">
                        <label for="customer_address">Customer Address</label>
                        <input type="text" wire:model="customer_address" id="customer_address" class="form-control" placeholder="Customer Address">
                    </div>
                    <div class="col-md-4">
                        <label for="customer_mobile">Customer Mobile</label>
                        <input type="text" wire:model="customer_mobile" id="customer_mobile" class="form-control" placeholder="Customer Mobile">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="col-md-4">
                        <input type="submit" value="Add Customer" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
