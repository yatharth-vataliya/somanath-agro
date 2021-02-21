<template>
    <div class="row mt-2" id="row_${this.row_count}">
        <div class="col-md-4">
            <input type="text" name="product_name[]" class="form-control" placeholder="Product Name">
        </div>
        <div class="col-md-2">
            <input type="number" name="product_quantity[]" v-model="product_quantity[rowCount]"
                   class="form-control" placeholder="Product Quantity">
        </div>
        <div class="col-md-2">
            <input type="number" name="product_price[]" v-model="product_price[rowCount]" class="form-control"
                   placeholder="Product Price">
        </div>
        <div class="col-md-2">
            <input type="number" v-bind:value="product_quantity[rowCount] * product_price[rowCount]"
                   class="form-control" Placeholder="Sub Total">
        </div>
        <div class="col-md-2">
            <button type="button" onclick="remove_product(this.row_count)" class="btn btn-outline-danger">Remove
                Product
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddProduct",
    props: [
        'rowCount'
    ],
    data() {
        return {
            product_quantity : [],
            product_price : [],
            product_subtotal : []
        }
    }
}
</script>

<style scoped>

</style>
