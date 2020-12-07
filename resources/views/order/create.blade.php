@extends('layouts.app')

@section('title')
    Add Order
@endsection

@section('content')

    <div class="container-fluid bg-white shadow-sm rounded">
        <div class="row p-2 shadow-sm">
            <div class="col-md-12">
                <form action="" method="POST" id="order_form">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                    <div class="row">
                        <div class="col-md-4">
                            <input  type="text" name="product_name[]" id="product_name" class="form-control" placeholder="Product Name">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="product_quantity[]" id="product_quantity" class="form-control" placeholder="Product Quantity" >
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="product_price[]" id="product_price" class="form-control" placeholder="Product Price">
                        </div>
                        <div class="col-md-2">
                            <input type="number" id="sub_total" class="form-control" Placeholder="Sub Total">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-success">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
