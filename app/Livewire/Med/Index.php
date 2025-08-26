<?php

namespace App\Livewire\Med;

use App\Models\Refferred;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $referrals;

    public $showModal = false;
    public $referralId;
    public $status;
    public $remarks;

    public function mount()
    {
        // Get only referrals where med_id matches the logged-in user
        $this->referrals = Refferred::with('patient')
            ->where('med_id', Auth::id())
            ->latest()
            ->get();
    }
public function editReferral($id)
    {
        $referral = Refferred::findOrFail($id);
        $this->referralId = $referral->id;
        $this->status = $referral->status;
        $this->remarks = $referral->remarks;
        $this->showModal = true;
    }

    public function updateReferral()
    {
        $this->validate([
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        Refferred::where('id', $this->referralId)->update([
            'status' => $this->status,
            'remarks' => $this->remarks,
        ]);

        $this->referrals = Refferred::with('patient')->where('med_id', auth()->id())->get();
        $this->showModal = false;
          flash()->success('Referral updated successfully!');

    }
    public function render()
    {
        return view('livewire.med.index', [
            'referrals' => $this->referrals
        ]);
    }
}
