<?php

namespace App\Http\Livewire;

use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CreateCustomer extends Component
{

    public $customer_name = '';
    public $customer_address = 'Mota Panchdevada';
    public $customer_mobile = '';
    private $customer_unique_id;

    public function updated($property)
    {

        $this->validateOnly($property, [
            'customer_name' => 'required|string|max:151',
            'customer_address' => 'required|string|max:151',
            // 'customer_mobile' => 'required|string|min:10|max:10|unique:customers,customer_mobile'
        ], [
            'customer_name.required' => 'Please Enter Customer Name',
            'customer_address.required' => 'Please Enter Customer Address',
            'customer_mobile.required' => 'Please Enter Customer Mobile',
            'customer_mobile.min' => 'Please Enter Minimum 10 digit Mobile Number',
            'customer_mobile.unique' => 'Customer Mobile is already registered please try with some different :):'
        ]);
    }

    public function storeCustomer()
    {
        $this->validate([
            'customer_name' => 'required|string|max:151',
            'customer_address' => 'required|string|max:151',
            'customer_mobile' => 'required|string|min:10|max:10|unique:customers,customer_mobile'
        ], [
            'customer_name.required' => 'Please Enter Customer Name',
            'customer_address.required' => 'Please Enter Customer Address',
            'customer_mobile.required' => 'Please Enter Customer Mobile',
            'customer_mobile.min' => 'Please Enter Minimum 10 digit Mobile Number',
            'customer_mobile.unique' => 'Customer Mobile is already registered please try with some different :):'
        ]);

        $customer = Customer::select('customer_unique_id')->orderBy('id', 'DESC')->first();

        if ($customer == NULL || $customer == '') {
            $this->customer_unique_id = 'customer_1';
        } else {
            $temp_id = explode('_', $customer->customer_unique_id);
            $int_id = 1 + (int)end($temp_id);
            $this->customer_unique_id = 'customer_' . $int_id;
        }

        Customer::create([
            'user_id' => Auth::id(),
            'customer_unique_id' => $this->customer_unique_id,
            'customer_name' => $this->customer_name,
            'customer_address' => $this->customer_address,
            'customer_mobile' => $this->customer_mobile
        ]);

        $this->customer_unique_id = NUll;
        $this->customer_name = '';
        $this->customer_address = 'Mota Pachdevada';
        $this->customer_mobile = '';

        session()->flash('info', 'Customer Added Successfully. :):');

    }

    public function render()
    {
        return view('livewire.create-customer')->extends('layouts.app');
    }
}
