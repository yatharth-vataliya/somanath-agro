@extends('layouts.app')

@section('title')
Add Order
@endsection

@section('content')
<div class="container-fluid bg-white shadow-sm rounded">
    @if ($errors->any())
    <div class="row p-2 shadow-sm">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    <div class="row p-2 shadow-sm">
        <div class="col-md-12">
            <form action="{{ route('order.store') }}" method="POST" id="order_form">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                <div id="add_row">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="product_name">product Name</label>
                            <input type="text" name="product_name[]" id="product_name" class="form-control" placeholder="Product Name" required="true">
                        </div>
                        <div class="col-md-2">
                        <label for="company_name">Company Name</label>
                            <input type="text" name="company_name[]" id="company_name" class="form-control" placeholder="Company Name" required="true">
                        </div>
                        <div class="col-md-2">
                        <label for="batch_no">Batch No</label>
                            <input type="text" name="batch_no[]" id="batch_no" class="form-control" placeholder="Batch No" required="true">
                        </div>
                        <div class="col-md-2">
                        <label for="expiry_date">Expiry date</label>
                            <input type="date" name="expiry_date[]" id="expiry_date" class="form-control" placeholder="Expiry Date" required="true">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                        <label for="product_quantity">Produt Quantity</label>
                            <input type="number" name="product_quantity[]" oninput="document.getElementById('sub_1').value = (document.getElementById('p_1').value * this.value);super_count();" id="q_1" class="form-control" placeholder="Product Quantity" required="true">
                        </div>
                        <div class="col-md-2">
                        <label for="product_price">Product Price</label>
                            <input type="number" name="product_price[]" oninput="document.getElementById('sub_1').value = (document.getElementById('q_1').value * this.value);super_count();" id="p_1" class="form-control" placeholder="Product Price" required="true">
                        </div>
                        <div class="col-md-2">
                        <label for="">Sub Total</label>
                            <input type="number" name="sub_total[]" id="sub_1" class="form-control" Placeholder="Sub Total">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 m-2">
                            <button type="button" id="add_product" class="btn btn-outline-success">Add Product
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-md-2">
                        <label for="paid_to_you">Paid To You</label>
                        <input type="number" id="paid_to_you" name="paid" class="form-control" Placeholder="Paid to you" required="true">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-success" value="Submit Order">
                    </div>
                    <div id="total" class="col-md-2 offset-md-4 text-center"></div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var row_count = 2;
    $("#add_product").on('click', function() {
        let html = `
                    <div id="row_${row_count}">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label>Product Name</label>
                            <input  type="text" name="product_name[]" class="form-control" placeholder="Product Name" required="true">
                        </div>
                        <div class="col-md-2">
                            <label>Company Name</label>
                            <input type="text" name="company_name[]" class="form-control" Placeholder="Company Name" required="true">
                        </div>
                        <div class="col-md-2">
                            <label>Batch No</label>
                            <input type="text" name="batch_no[]" id="batch_no" class="form-control" placeholder="Batch No" required="true">
                        </div>
                        <div class="col-md-2">
                            <label>Expiry Date</label>
                            <input type="date" name="expiry_date[]" id="expiry_date" class="form-control" placeholder="Expiry Date" required="true">
                        </div>
                    </div>
                    <div class="row mt-2">
                    <div class="col-md-2">
                            <label>Product Quantity</label>
                            <input type="number" name="product_quantity[]"  oninput="document.getElementById('sub_${row_count}').value = (document.getElementById('p_${row_count}').value * this.value);super_count();" id="q_${row_count}" class="form-control" placeholder="Product Quantity" required="true">
                        </div>
                        <div class="col-md-2">
                            <label>Product Price</label>
                            <input type="number" name="product_price[]" oninput="document.getElementById('sub_${row_count}').value = (document.getElementById('q_${row_count}').value * this.value);super_count();" id="p_${row_count}" class="form-control" placeholder="Product Price" required="true">
                        </div>
                        <div class="col-md-2">
                            <label>Sub Total</label>
                            <input type="number" name="sub_total[]" id="sub_${row_count}" class="form-control" Placeholder="Sub Total">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <button type="button" onclick="remove_product(${row_count})" class="btn btn-outline-danger">Remove Product</button>
                        </div>
                    </div>
                    </div>
                    `;
        row_count++;
        $("#add_row").append(html);
    });

    function remove_product(row_id) {
        $("#row_" + row_id).remove();
        var total = 0;
        $.each($("input[name='sub_total[]'"), function(index, element) {
            total = total + parseInt(element.value);
        });
        $("#total").html("Total is :- " + total);
    }

    function super_count() {
        var total = 0;
        $.each($("input[name='sub_total[]'"), function(index, element) {
            total = total + parseInt(element.value);
        });
        $("#total").html("Total is :- " + total);
    }

    $(document).ready(function() {
        var total = 0;
        $.each($("input[name='sub_total[]'"), function(index, element) {
            total = total + parseInt(element.value);
        });
        $("#total").html("Total is :- " + total);
    });
</script>
@endsection