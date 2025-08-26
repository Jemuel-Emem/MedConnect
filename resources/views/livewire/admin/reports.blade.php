<div>
<div class="p-6 bg-white rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Referred Patients Report</h2>
        <button onclick="window.print()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            🖨 Print
        </button>
    </div>

    <table class="w-full border border-gray-300 text-sm">
        <thead class="bg-blue-700 text-white">
            <tr>
                <th class="border px-3 py-2">#</th>
                <th class="border px-3 py-2">Patient Name</th>
                <th class="border px-3 py-2">Date Referred</th>
                <th class="border px-3 py-2">Status</th>
                <th class="border px-3 py-2">Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse($referred as $index => $ref)
                <tr>
                    <td class="border px-3 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="border px-3 py-2 text-center">{{ $ref->patient->fullname ?? 'N/A' }}</td>
                    <td class="border px-3 py-2 text-center">{{ $ref->created_at->format('Y-m-d') }}</td>
                    <td class="border px-3 py-2 text-center">{{ $ref->status ?? 'Pending' }}</td>
                    <td class="border px-3 py-2 text-center">{{ $ref->remarks ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No referred patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<style>
@media print {
    button {
        display: none;
    }
    body {
        background: white !important;
    }
}
</style>

</div>
