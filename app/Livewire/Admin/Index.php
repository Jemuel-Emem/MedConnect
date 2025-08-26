<?php
namespace App\Livewire\Admin;

use App\Models\Patient;
use App\Models\Refferred;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $patientCount;
    public $userCount;
    public $referredCount;
    public $newReferredCount;

    public function mount()
    {
        $this->updateCounts();
    }

    public function updateCounts()
    {
        $this->patientCount = Patient::count();
        $this->userCount = User::count();
        $this->referredCount = Refferred::count();
        $this->newReferredCount = Refferred::where('status', 'pending')->count(); // or use created_at filter
    }

    public function render()
    {
        return view('livewire.admin.index', [
            'patientCount' => $this->patientCount,
            'userCount' => $this->userCount,
            'referredCount' => $this->referredCount,
            'newReferredCount' => $this->newReferredCount
        ]);
    }
}
