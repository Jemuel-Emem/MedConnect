<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    public $showModal = false;

    public $userId;
    public $name;
    public $email;
    public $password;
    public $department;
    public $contact;

    public function render()
    {
        // Pass 'accounts' to the Blade so your existing view (which expects $accounts) works
        return view('livewire.admin.users', [
            'accounts' => User::latest()->get(),
        ]);
    }

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            // allow same email when updating the same record
            'email' => 'required|email|unique:users,email,' . ($this->userId ?? 'NULL') . ',id',
            'department' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
        ];

        // password required on create, optional on update
        if (!$this->userId) {
            $rules['password'] = 'required|string|min:6';
        } elseif ($this->password) {
            $rules['password'] = 'string|min:6';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'department' => $this->department,
            'contact' => $this->contact,
            'is_admin' => 1, // always set to 1 as requested
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        flash()->success($this->userId ? 'Admin updated successfully!' : 'Admin added successfully!');

        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->department = $user->department;
        $this->contact = $user->contact;
        $this->password = ''; // never populate real password
        $this->showModal = true;
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        flash()->success('Admin deleted successfully!');
    }

    private function resetFields()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->department = '';
        $this->contact = '';
    }
}
