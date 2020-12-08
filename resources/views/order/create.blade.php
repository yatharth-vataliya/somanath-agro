@extends('layouts.app')

@section('title')
    Add Order
@endsection

@section('content')

    <div class="container-fluid bg-white shadow-sm rounded">
        <div class="row p-2 shadow-sm" id="app">
            <div class="col-md-12">
                <form action="{{ route('order.store') }}" method="POST" id="order_form">
                    @csrf
                    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="product_name[]" id="product_name" class="form-control"
                                   placeholder="Product Name">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="product_quantity[]"
                                   oninput="document.getElementById('sub_1').value = (document.getElementById('p_1').value * this.value);super_count();"
                                   id="q_1" class="form-control" placeholder="Product Quantity">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="product_price[]"
                                   oninput="document.getElementById('sub_1').value = (document.getElementById('q_1').value * this.value);super_count();"
                                   id="p_1" class="form-control" placeholder="Product Price">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="sub_total[]" id="sub_1" class="form-control"
                                   Placeholder="Sub Total">
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="add_product" class="btn btn-outline-success">Add Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row shadow-sm p-2">
            <div id="total" class="col-md-2 offset-md-8 text-center"></div>
            <div class="col-md-2">
                <button type="button" id="submit_order" class="btn btn-success">Submit Order</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        var row_count = 2;
        $("#add_product").on('click', function () {
            let html = `<div class="row mt-2" id="row_${row_count}">
                        <div class="col-md-4">
                            <input  type="text" name="product_name[]" class="form-control" placeholder="Product Name">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="product_quantity[]"  oninput="document.getElementById('sub_${row_count}').value = (document.getElementById('p_${row_count}').value * this.value);super_count();" id="q_${row_count}" class="form-control" placeholder="Product Quantity" >
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="product_price[]" oninput="document.getElementById('sub_${row_count}').value = (document.getElementById('q_${row_count}').value * this.value);super_count();" id="p_${row_count}" class="form-control" placeholder="Product Price">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="sub_total[]" id="sub_${row_count}" class="form-control" Placeholder="Sub Total">
                        </div>
                        <div class="col-md-2">
                            <button type="button" onclick="remove_product(${row_count})" class="btn btn-outline-danger">Remove Product</button>
                        </div>
                    </div>`;
            row_count++;
            $("#order_form").append(html);
        });

        function remove_product(row_id) {
            $("#row_" + row_id).remove();
            var total = 0;
            $.each($("input[name='sub_total[]'"), function (index, element) {
                total = total + parseInt(element.value);
            });
            $("#total").html("Total is :- " + total);
        }

        function super_count(){
            var total = 0;
            $.each($("input[name='sub_total[]'"), function (index, element) {
                total = total + parseInt(element.value);
            });
            $("#total").html("Total is :- " + total);
        }

        $(document).ready(function(){
            var total = 0;
            $.each($("input[name='sub_total[]'"), function (index, element) {
                total = total + parseInt(element.value);
            });
            $("#total").html("Total is :- " + total);
        });

        $("#submit_order").on('click',function(){
            $("#order_form").submit();
        });

    </script>
@endsection
