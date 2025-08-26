<div>
    <!-- Add Department Button -->
    <div class="flex justify-end">
        <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded w-64">
            Add Department
        </button>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4">
                   {{ $userId ? 'Edit Department' : 'Add Department' }}

                </h2>

                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-1 gap-4">
                        <input type="text" wire:model="name" placeholder="Name" class="border p-2 rounded">
                        <input type="text" wire:model="department" placeholder="Department" class="border p-2 rounded">
                        <input type="text" wire:model="contact" placeholder="Contact Number" class="border p-2 rounded">
                        <input type="email" wire:model="email" placeholder="Email" class="border p-2 rounded">
                        <input type="password" wire:model="password" placeholder="Password" class="border p-2 rounded">
                    </div>

                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-400 text-white rounded">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Table -->
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
                    <th class="text-left py-2 px-4">Name</th>
                    <th class="text-left py-2 px-4">Department</th>
                    <th class="text-left py-2 px-4">Contact</th>
                    <th class="text-left py-2 px-4">Email</th>
                    <th class="text-left py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accounts as $acc)
                    <tr class="border-t">
                         <td class="py-2 px-4">{{ $acc->id }}</td>
                        <td class="py-2 px-4">{{ $acc->name }}</td>
                        <td class="py-2 px-4">{{ $acc->department }}</td>
                        <td class="py-2 px-4">{{ $acc->contact }}</td>
                        <td class="py-2 px-4">{{ $acc->email }}</td>
                        <td class="py-2 px-4 space-x-2">
                            <button wire:click="edit({{ $acc->id }})" class="bg-yellow-400 text-white px-3 py-1 rounded">
                                Edit
                            </button>
                            <button wire:click="delete({{ $acc->id }})"
                                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                class="bg-red-600 text-white px-3 py-1 rounded">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No departments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
