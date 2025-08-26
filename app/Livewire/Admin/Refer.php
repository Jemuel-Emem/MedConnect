<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Refferred;
use App\Models\Patient;
use App\Models\User;

class Refer extends Component
{
    public $showModal = false;
    public $currentReferralId = null; // Track referral being edited

    // form fields
    public $patient_id;
    public $med_id;
    public $date_referred;
    public $time_referred;
    public $age;
    public $sex;
    public $religion;
    public $status;
    public $diagnosis_impression;
    public $other_diagnos;
    public $reason_for_referral;
    public $remarks;

    public function render()
    {
        $patients = Patient::orderBy('fullname')->get();
        $meds     = User::where('is_admin', 1)->orderBy('name')->get();
        $referrals = Refferred::with(['patient','doctor'])->latest()->get();

        return view('livewire.admin.refer', compact('patients','meds','referrals'));
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->currentReferralId = null;
    }

    public function edit($id)
    {
        $referral = Refferred::findOrFail($id);

        $this->currentReferralId = $id;
        $this->patient_id = $referral->patient_id;
        $this->med_id = $referral->med_id;
        $this->date_referred = $referral->date_referred;
        $this->time_referred = $referral->time_referred;
        $this->age = $referral->age;
        $this->sex = $referral->sex;
        $this->religion = $referral->religion;
        $this->status = $referral->status;
        $this->diagnosis_impression = $referral->diagnosis_impression;
        $this->other_diagnos = $referral->other_diagnos;
        $this->reason_for_referral = $referral->reason_for_referral;
        $this->remarks = $referral->remarks;

        $this->showModal = true;
    }

    public function delete($id)
    {
        $referral = Refferred::findOrFail($id);
        $referral->delete();

        flash()->success('Referral deleted successfully!');
    }

    public function save()
    {
        // Validation rules
        $rules = [
            'patient_id'            => 'required|exists:patients,id',
            'med_id'                => 'required|exists:users,id',
            'date_referred'         => 'required|date',
            'time_referred'         => 'required',
            'age'                   => 'required|integer',
            'sex'                   => 'required|string',
            'religion'              => 'nullable|string',
            'status'                => 'nullable|string',
            'diagnosis_impression'  => 'nullable|string',
            'other_diagnos'         => 'nullable|string',
            'reason_for_referral'   => 'nullable|string',
            'remarks'               => 'nullable|string',
        ];

        // Add unique rule for new referrals only
        // if (!$this->currentReferralId) {
        //     $rules['patient_id'] .= '|unique:refferreds,patient_id,NULL,id,med_id,' . $this->med_id;
        // }

        $this->validate($rules);

        $med = User::find($this->med_id);
        if (!$med || intval($med->is_admin) !== 1) {
            flash()->error('Selected medical staff is invalid.');
            return;
        }

        $data = [
            'patient_id'            => $this->patient_id,
            'med_id'                => $this->med_id,
            'mdname'                => $med->name ?? '',
            'date_referred'         => $this->date_referred,
            'time_referred'         => $this->time_referred,
            'age'                   => $this->age,
            'sex'                   => $this->sex,
            'religion'              => $this->religion,
            'status'                => $this->status,
            'diagnosis_impression'  => $this->diagnosis_impression,
            'other_diagnos'         => $this->other_diagnos,
            'reason_for_referral'   => $this->reason_for_referral,
            'remarks'               => $this->remarks,
        ];

        if ($this->currentReferralId) {
            // Update existing referral
            $referral = Refferred::findOrFail($this->currentReferralId);
            $referral->update($data);
            $message = 'Referral updated successfully!';
        } else {
            // Create new referral
            Refferred::create($data);
            $message = 'Patient referral added successfully!';
        }

        flash()->success($message);
        $this->closeModal();
    }

    private function resetFields()
    {
        $this->reset([
            'patient_id',
            'med_id',
            'date_referred',
            'time_referred',
            'age',
            'sex',
            'religion',
            'status',
            'diagnosis_impression',
            'other_diagnos',
            'reason_for_referral',
            'remarks',
            'currentReferralId'
        ]);
    }
}
