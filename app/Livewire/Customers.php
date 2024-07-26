<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;

class Customers extends Component
{
    public $customers = [];
    public $search = '';
    public $suggestions = '';

    public function mount()
    {
        // Initially load all customers
        $this->customers = Customer::all();
    }

    public function render()
    {
        return view('livewire.customers');
    }

    public function updatedSearch()
    {
        if (strlen($this->search) < 3) {
            $this->customers = Customer::all();
            $this->suggestions = '';
        } else {
           
            $this->customers = Customer::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->get();
            
            $this->generateSuggestions();
        }
    }

    private function generateSuggestions()
    {
        $this->suggestions = '';
        foreach ($this->customers as $customer) {
            $this->suggestions .= $customer->name . ', ' . $customer->email . ', ' . $customer->phone . '; ';
        }
        $this->suggestions = rtrim($this->suggestions, '; ');
    }

    public function deleteCustomer(Customer $customer)
    {
        $customer->delete();
        session()->flash('success', 'Customer Deleted Successfully');
        return $this->redirect('/customers', navigate: true);
    }
}
