<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class EditCustomer extends Component
{

    public $customer = NULL;
    public $customer_name = '';
    public $customer_address = '';
    public $customer_mobile = '';


    public function mount(Customer $customer){
        $this->customer = $customer;
        $this->customer_name = $customer->customer_name;
        $this->customer_address = $customer->customer_address;
        $this->customer_mobile = $customer->customer_mobile;
    }

    public function updated($property)
    {

        // $this->validateOnly($property, [
        //     'customer_name' => 'required|string|max:151',
        //     'customer_address' => 'required|string|max:151',
        //     // 'customer_mobile' => 'required|string|min:10|max:10|unique:customers,customer_mobile'
        // ], [
        //     'customer_name.required' => 'Please Enter Customer Name',
        //     'customer_address.required' => 'Please Enter Customer Address',
        //     'customer_mobile.required' => 'Please Enter Customer Mobile',
        //     'customer_mobile.min' => 'Please Enter Minimum 10 digit Mobile Number',
        //     'customer_mobile.unique' => 'Customer Mobile is already registered please try with some different :):'
        // ]);
    }

    public function updateCustomer()
    {
        $this->validate([
            'customer_name' => 'required|string|max:151',
            'customer_address' => 'required|string|max:151',
            'customer_mobile' => [
                'required','string','min:10','max:10', Rule::unique('App\\Models\\Customer')->ignore($this->customer->id)
            ]
        ], [
            'customer_name.required' => 'Please Enter Customer Name',
            'customer_address.required' => 'Please Enter Customer Address',
            'customer_mobile.required' => 'Please Enter Customer Mobile',
            'customer_mobile.min' => 'Please Enter Minimum 10 digit Mobile Number',
            'customer_mobile.unique' => 'Customer Mobile is already registered please try with some different :):'
        ]);

        Customer::where('id',$this->customer->id)->update([
            'customer_name' => $this->customer_name,
            'customer_address' => $this->customer_address,
            'customer_mobile' => $this->customer_mobile
        ]);

        return redirect()->route('customer.index');

    }

    public function render()
    {
        return view('livewire.edit-customer')->extends('layouts.app');
    }
}
