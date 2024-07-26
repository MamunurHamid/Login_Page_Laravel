<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Auth;

class Customers extends Component
{
    public $customers = [];
    public $search = '';
    public $suggestions = [];

    public function mount()
    {
        // Initially load all customers
        $this->customers = Customer::all();
    }

    public function render()
    {
        if (!$this->search) {
            $this->customers = Customer::all();
        } else {
            $this->customers = Customer::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->get();

            $this->generateSuggestions();
        }

        return view('livewire.customers');
    }

    private function generateSuggestions()
    {
        $this->suggestions = Customer::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->take(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function selectSuggestion($suggestion)
    {
        $this->search = $suggestion;
        $this->suggestions = [];
    }

    public function deletecustomer(Customer $customer)
    {
        $customer->delete();
        session()->flash('success', 'Customer Deleted Successfully');
        return $this->redirect('/customers', navigate: true);
    }
}
