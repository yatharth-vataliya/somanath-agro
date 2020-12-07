<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class IndexCustomer extends Component
{

    use WithPagination;

    protected $listeners = ['deleteCustomer' => 'deleteCustomer'];

    protected $paginationTheme = 'bootstrap';

    public $search_customer = '';

    public function updatingSearchCustomer()
    {
        $this->resetPage();
    }


    public function render()
    {
        $customers = Customer::where('customer_name', 'like', '%'.$this->search_customer.'%')
            ->orWhere('customer_address', 'like', '%'.$this->search_customer.'%')
            ->orWhere('customer_mobile', 'like', '%'.$this->search_customer.'%')
            ->paginate(7);
        return view('livewire.index-customer',compact('customers'))->extends('layouts.app');
    }

    public function deleteCustomer($customer_id){
        $customer = Customer::find($customer_id);
        $customer->delete();
    }

}
