<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use App\Models\Customer;

class OrderIndex extends Component
{
    use WithPagination;

    public $customer_id = NULL;

    public function mount($customer_id){
        $this->customer_id = $customer_id;

    }

    public function render()
    {
        $customer = Customer::find(decrypt($this->customer_id));
        $orders = Order::latest()->paginate(7);
        return view('livewire.order-index',compact('orders','customer'))->extends('layouts.app');
    }
}
