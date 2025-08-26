<div class="p-4 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4 border-b pb-2">My Referred Patients</h2>

    @if($referrals->isEmpty())
        <div class="text-gray-500 text-center py-6">
            <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 17v-4h6v4m-3-4V7m-9 6a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
            No patients referred to you yet.
        </div>
    @else
        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 border text-left">Patient Name</th>
                        <th class="px-4 py-2 border text-left">Status</th>
                        <th class="px-4 py-2 border text-left">Diagnosis / Impression</th>
                        <th class="px-4 py-2 border text-left">Other Diagnosis</th>
                        <th class="px-4 py-2 border text-left">Reason for Referral</th>
                        <th class="px-4 py-2 border text-left">Remarks</th>
                        <th class="px-4 py-2 border text-left">Date Referred</th>
                        <th class="px-4 py-2 border text-left">Time Referred</th>
                        <th class="px-4 py-2 text-center font-semibold text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($referrals as $r)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $r->patient->fullname ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 border capitalize">{{ $r->status ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $r->diagnosis_impression ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $r->other_diagnos ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $r->reason_for_referral ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $r->remarks ?? '-' }}</td>
                            <td class="px-4 py-2 border">
                                {{ $r->date_referred ? \Carbon\Carbon::parse($r->date_referred)->format('M d, Y') : '-' }}
                            </td>
                            <td class="px-4 py-2 border">
                                {{ $r->time_referred ? \Carbon\Carbon::parse($r->time_referred)->format('g:i A') : '-' }}
                            </td>

                             <td class="px-4 py-2 text-center">
                                <button wire:click="editReferral({{ $r->id }})"
                                    class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600">
                                    Update
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="space-y-4 md:hidden">
            @foreach($referrals as $r)
                <div class="border rounded-lg p-4 shadow-sm bg-gray-50">
                    <p><span class="font-semibold">Patient:</span> {{ $r->patient->fullname ?? 'Unknown' }}</p>
                    <p><span class="font-semibold">Status:</span> {{ $r->status ?? '-' }}</p>
                    <p><span class="font-semibold">Diagnosis:</span> {{ $r->diagnosis_impression ?? '-' }}</p>
                    <p><span class="font-semibold">Other Diagnosis:</span> {{ $r->other_diagnos ?? '-' }}</p>
                    <p><span class="font-semibold">Reason:</span> {{ $r->reason_for_referral ?? '-' }}</p>
                    <p><span class="font-semibold">Remarks:</span> {{ $r->remarks ?? '-' }}</p>
                    <p><span class="font-semibold">Date:</span>
                        {{ $r->date_referred ? \Carbon\Carbon::parse($r->date_referred)->format('M d, Y') : '-' }}
                    </p>
                    <p><span class="font-semibold">Time:</span>
                        {{ $r->time_referred ? \Carbon\Carbon::parse($r->time_referred)->format('g:i A') : '-' }}
                    </p>
                </div>
            @endforeach
        </div>

         @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h3 class="text-lg font-bold mb-4">Update Referral</h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select wire:model="status" class="w-full border-gray-300 rounded">
                        <option value="">Select Status</option>
                         <option value="Pending">Pending</option>
        <option value="Stable">Stable</option>
        <option value="Critical">Critical</option>
        <option value="Recovered">Recovered</option>
        <option value="Under Observation">Under Observation</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Remarks</label>
                    <textarea wire:model="remarks" rows="3" class="w-full border-gray-300 rounded"></textarea>
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                    <button wire:click="updateReferral" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Save</button>
                </div>
            </div>
        </div>
    @endif
    @endif
</div>
