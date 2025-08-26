<!-- Blade Template Updates -->
<div class="p-4">
   <div class="flex justify-end">
     <button wire:click="openModal"
            class="w-64 inline-block px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">
        Add Refer Patient
    </button>
   </div>

    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black opacity-50" wire:click="closeModal"></div>
            <div class="relative bg-white rounded-lg shadow-lg w-full max-w-4xl p-6 overflow-auto max-h-[90vh]">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">
                        {{ $currentReferralId ? 'Edit Referral' : 'Refer Patient' }}
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-gray-600 hover:text-gray-800">&times;</button>
                </div>

                <form wire:submit.prevent="save">
                   <form wire:submit.prevent="save">
                    <!-- 3x3 grid (use col-span to make larger textareas full width) -->
                    <div class="grid grid-cols-3 gap-4">

                        <!-- Patient -->
                        <div>
                            <label class="block text-sm font-medium">Patient</label>
                            <select wire:model="patient_id" class="mt-1 block w-full border rounded p-2">
                                <option value="">-- Select Patient --</option>
                                @foreach($patients as $p)
                                    <option value="{{ $p->id }}">{{ $p->fullname }}</option>
                                @endforeach
                            </select>
                            @error('patient_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Med -->
                        <div>
                            <label class="block text-sm font-medium">Medical Staff</label>
                            <select wire:model="med_id" class="mt-1 block w-full border rounded p-2">
                                <option value="">-- Select Medical Staff --</option>
                                @foreach($meds as $m)
                                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                                @endforeach
                            </select>
                            @error('med_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-medium">Date Referred</label>
                            <input type="date" wire:model="date_referred" class="mt-1 block w-full border rounded p-2" />
                            @error('date_referred') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Time -->
                        <div>
                            <label class="block text-sm font-medium">Time Referred</label>
                            <input type="time" wire:model="time_referred" class="mt-1 block w-full border rounded p-2" />
                            @error('time_referred') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Age -->
                        <div>
                            <label class="block text-sm font-medium">Age</label>
                            <input type="number" wire:model="age" class="mt-1 block w-full border rounded p-2" />
                            @error('age') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Sex -->
                        <div>
                            <label class="block text-sm font-medium">Sex</label>
                            <select wire:model="sex" class="mt-1 block w-full border rounded p-2">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            @error('sex') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Religion -->
                        <div>
                            <label class="block text-sm font-medium">Religion</label>
                            <input type="text" wire:model="religion" class="mt-1 block w-full border rounded p-2" />
                            @error('religion') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Status -->
                   <div>
    <label class="block text-sm font-medium">Status</label>
    <select wire:model="status" class="mt-1 block w-full border rounded p-2">
        <option value="">-- Select Status --</option>
        <option value="Pending">Pending</option>
        <option value="Stable">Stable</option>
        <option value="Critical">Critical</option>
        <option value="Recovered">Recovered</option>
        <option value="Under Observation">Under Observation</option>
    </select>
    @error('status')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


                        <!-- Diagnosis Impression (span full width) -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Diagnosis Impression</label>
                            <textarea wire:model="diagnosis_impression" rows="3" class="mt-1 block w-full border rounded p-2"></textarea>
                            @error('diagnosis_impression') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Other Diagnosis -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Other Diagnosis</label>
                            <textarea wire:model="other_diagnos" rows="2" class="mt-1 block w-full border rounded p-2"></textarea>
                            @error('other_diagnos') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Reason for referral -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Reason for Referral</label>
                            <textarea wire:model="reason_for_referral" rows="2" class="mt-1 block w-full border rounded p-2"></textarea>
                            @error('reason_for_referral') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Remarks -->
                        <div class="col-span-3">
                            <label class="block text-sm font-medium">Remarks</label>
                            <textarea wire:model="remarks" rows="2" class="mt-1 block w-full border rounded p-2"></textarea>
                            @error('remarks') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>



                    <div class="mt-4 flex justify-end space-x-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">
                            {{ $currentReferralId ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="mt-6">
        {{-- <h4 class="font-semibold mb-2">Recent Referrals</h4> --}}
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded">
                <thead class="bg-blue-700 text-white">
                    <tr>
                        <th class="px-3 py-2 text-left">Patient</th>
                        <th class="px-3 py-2 text-left">Doctor</th>
                        <th class="px-3 py-2 text-left">Date</th>
                        <th class="px-3 py-2 text-left">Time</th>
                        <th class="px-3 py-2 text-left">Status</th>
                        <th class="px-3 py-2 text-left">Actions</th> <!-- New column -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($referrals as $r)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $r->patient->fullname ?? '—' }}</td>
                            <td class="px-3 py-2">{{ $r->mdname }}</td>
                            <td class="px-3 py-2">{{ $r->date_referred }}</td>
                        <td class="px-3 py-2">
    {{ \Carbon\Carbon::parse($r->time_referred)->format('g:i A') }}
</td>
   <td class="px-3 py-2">{{ $r->status }}</td>

                            <td class="px-3 py-2 flex space-x-2">
                                <button wire:click="edit({{ $r->id }})"
                                        class="bg-yellow-400 text-white px-3 py-1 rounded">
                                    Edit
                                </button>
                                <button wire:click="delete({{ $r->id }})"
                                        onclick="return confirm('Are you sure you want to delete this referral?')"
                                        class="bg-red-400 text-white px-3 py-1 rounded">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
