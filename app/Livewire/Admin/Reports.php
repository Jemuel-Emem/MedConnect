<?php

namespace App\Livewire\Admin;

use App\Models\Refferred;
use Livewire\Component;

class Reports extends Component
{
    public $referred;

    public function mount()
    {
        $this->referred = Refferred::latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.reports', [
            'referred' => $this->referred
        ]);
    }
}
