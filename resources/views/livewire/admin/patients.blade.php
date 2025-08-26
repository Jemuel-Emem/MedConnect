<div>
    <!-- Add Patient Button -->
    <div class="flex justify-end">
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded w-64">
            Add Patient
        </button>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-2xl">
                <h2 class="text-xl font-semibold mb-4">Add Patient</h2>

                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" wire:model="fullname" placeholder="Full Name" class="border p-2 rounded">
                        <input type="text" wire:model="contact_number" placeholder="Contact Number" class="border p-2 rounded">
                        <input type="date" wire:model="birthday" class="border p-2 rounded">
                        <input type="text" wire:model="sex" placeholder="Sex" class="border p-2 rounded">
                        <input type="text" wire:model="civil_status" placeholder="Civil Status" class="border p-2 rounded">
                        <input type="text" wire:model="religion" placeholder="Religion" class="border p-2 rounded">
                        <input type="text" wire:model="region" placeholder="Region" class="border p-2 rounded">
                        <input type="text" wire:model="province" placeholder="Province" class="border p-2 rounded">
                        <input type="text" wire:model="municipal" placeholder="Municipal" class="border p-2 rounded">
                        <input type="text" wire:model="barangay" placeholder="Barangay" class="border p-2 rounded">
                    </div>

                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

   <div class="mt-6">
    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow rounded">
        <thead class="bg-blue-600 text-white">
            <tr>
                    <th class="text-left py-2 px-4">ID</th>
                <th class="text-left py-2 px-4">Full Name</th>
                <th class="text-left py-2 px-4">Contact</th>
                <th class="text-left py-2 px-4">Date of Birth</th>
                <th class="text-left py-2 px-4">Sex</th>
                <th class="text-left py-2 px-4">Barangay</th>
                  <th class="text-left py-2 px-4">Municipal</th>
                 <th class="text-left py-2 px-4">Region</th>
                  <th class="text-left py-2 px-4">Religion</th>
                <th class="text-left py-2 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr class="border-t">
                    <td class="py-2 px-4">{{ $patient->id }}</td>
                    <td class="py-2 px-4">{{ $patient->fullname }}</td>
                    <td class="py-2 px-4">{{ $patient->contact_number }}</td>
                     <td class="py-2 px-4">{{ $patient->birthday }}</td>
                    <td class="py-2 px-4">{{ $patient->sex }}</td>
                    <td class="py-2 px-4">{{ $patient->barangay }}</td>
                    <td class="py-2 px-4">{{ $patient->municipal }}</td>
                           <td class="py-2 px-4">{{ $patient->region }}</td>
                                  <td class="py-2 px-4">{{ $patient->religion }}</td>
                    <td class="py-2 px-4 space-x-2">
                        <button wire:click="edit({{ $patient->id }})" class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
                        <button wire:click="delete({{ $patient->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>
