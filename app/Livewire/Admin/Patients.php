<?php

namespace App\Livewire\Admin;

use App\Models\Patient;
use Livewire\Component;

class Patients extends Component
{
    public $showModal = false;
    public $patients;

    public $patientId;
    public $fullname, $contact_number, $birthday, $sex, $civil_status, $religion, $region, $province, $municipal, $barangay;

    public function render()
    {
        $this->patients = Patient::latest()->get();
        return view('livewire.admin.patients');
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $this->validate([
            'fullname' => 'required',
            'contact_number' => 'required',
            // Add more validations as needed
        ]);

        Patient::updateOrCreate(
            ['id' => $this->patientId],
            [
                'fullname' => $this->fullname,
                'contact_number' => $this->contact_number,
                'birthday' => $this->birthday,
                'sex' => $this->sex,
                'civil_status' => $this->civil_status,
                'religion' => $this->religion,
                'region' => $this->region,
                'province' => $this->province,
                'municipal' => $this->municipal,
                'barangay' => $this->barangay,
            ]
        );

       flash()->success('Patient saved successfully!');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $this->patientId = $id;
        $this->fullname = $patient->fullname;
        $this->contact_number = $patient->contact_number;
        $this->birthday = $patient->birthday;
        $this->sex = $patient->sex;
        $this->civil_status = $patient->civil_status;
        $this->religion = $patient->religion;
        $this->region = $patient->region;
        $this->province = $patient->province;
        $this->municipal = $patient->municipal;
        $this->barangay = $patient->barangay;

        $this->showModal = true;
    }

    public function delete($id)
    {
        Patient::findOrFail($id)->delete();
              flash()->success('Patient deleted successfully!');

    }

    private function resetInputFields()
    {
        $this->patientId = null;
        $this->fullname = '';
        $this->contact_number = '';
        $this->birthday = '';
        $this->sex = '';
        $this->civil_status = '';
        $this->religion = '';
        $this->region = '';
        $this->province = '';
        $this->municipal = '';
        $this->barangay = '';
    }
}
