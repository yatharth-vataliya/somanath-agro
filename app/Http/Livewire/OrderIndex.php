<?php

namespace App\Http\Livewire;

use Livewire\Component;

class OrderIndex extends Component
{
    public $customer_id = NULL;

    public function mount($customer_id){
        $this->customer_id = $customer_id;
    }

    public function render()
    {
        return view('livewire.order-index')->extends('layouts.app');
    }
}
