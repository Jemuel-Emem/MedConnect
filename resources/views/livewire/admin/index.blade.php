<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-6" wire:poll.10s="updateCounts">

  <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform text-center">
    <div class="text-4xl mb-2">🧑‍⚕️</div>
    <h4 class="text-lg font-semibold">Patients</h4>
    <h2 class="text-3xl font-bold mt-2">{{ number_format($patientCount) }}</h2>
  </div>

  <div class="bg-gradient-to-r from-pink-400 to-pink-600 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform text-center">
    <div class="text-4xl mb-2">👥</div>
    <h4 class="text-lg font-semibold">Users</h4>
    <h2 class="text-3xl font-bold mt-2">{{ number_format($userCount) }}</h2>
  </div>

  <div class="bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform text-center">
    <div class="text-4xl mb-2">🔗</div>
    <h4 class="text-lg font-semibold">Referred Patients</h4>
    <h2 class="text-3xl font-bold mt-2">{{ number_format($referredCount) }}</h2>
  </div>

  @if($newReferredCount > 0)
  <div class="col-span-1 sm:col-span-2 md:col-span-3">
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-md">
      <strong>📢 New Referral Alert!</strong>
      You have <span class="font-bold">{{ $newReferredCount }}</span> new referred patient(s) pending review.
    </div>
  </div>
  @endif

</div>
