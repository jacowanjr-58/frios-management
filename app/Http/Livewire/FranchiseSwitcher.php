<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class FranchiseSwitcher extends Component
{
    public $selectedFranchise;

    public function mount()
    {
        $this->selectedFranchise = session('active_franchise_id') ?? auth()->user()->franchisees->first()?->id;
    }

    public function updatedSelectedFranchise($value)
    {
        $value = (int) $value;
        if (auth()->user()->franchisees->pluck('id')->contains($value)) {
            Session::put('active_franchise_id', $value);
            $this->dispatchBrowserEvent('franchise-switched');
        }
    }

    public function render()
    {
        return view('livewire.franchise-switcher', [
            'franchisees' => auth()->user()->franchisees
        ]);
    }
}
