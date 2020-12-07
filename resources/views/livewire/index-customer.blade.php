@section('title')
    All Customer
@endsection
<div class="container-fluid bg-white rounded shadow-sm">
    <div class="row p-2 shadow-sm">
        <div class="col-md-12">
            <input type="text" wire:model="search_customer" class="form-control" placeholder="Search Customer">
        </div>
    </div>
    <div class="row p-2 shadow-sm">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Mobile</th>
                    <th>Total Paid</th>
                    <th>Total Pending</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Orders</th>
                </tr>
                @php($no = 1)
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_address }}</td>
                        <td>{{ $customer->customer_mobile }}</td>
                        <td>{{ $customer->total_paid }}</td>
                        <td>{{ $customer->total_pending }}</td>
                        <td>Edit</td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="delete_customer({{ $customer->id }})">
                                Delete
                            </button>
                        </td>
                        <td>Orders</td>
                    </tr>
                @endforeach
            </table>
            <div class="p-2 text-center">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
            function delete_customer(customer_id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                       Livewire.emit('deleteCustomer',customer_id);
                    }
                });
            }
    </script>
@endsection
