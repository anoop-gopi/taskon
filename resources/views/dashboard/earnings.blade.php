<x-dashboard-layout>
  <!-- Success/Error Messages -->
  @if(session('success'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-success shadow-lg">
        <span class="icon-[tabler--check] size-5"></span>
        <span>{{ session('success') }}</span>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-error shadow-lg">
        <span class="icon-[tabler--x] size-5"></span>
        <span>{{ session('error') }}</span>
      </div>
    </div>
  @endif

  <!-- Hero Section -->
  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl md:text-5xl font-bold">Earnings</h1>
      <p class="text-white/80 mt-2">Track your balance and request withdrawals</p>
    </div>
  </section>

  <!-- Content Section -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <!-- Balance Highlight -->
      <div class="card bg-primary text-white shadow-xl mb-8">
        <div class="card-body">
          <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
              <p class="text-white/80 text-sm uppercase tracking-wide">Current Balance</p>
              <h2 class="text-4xl md:text-5xl font-bold mt-2">${{ number_format($currentBalance, 2) }}</h2>
              <p class="text-white/70 text-sm mt-2">Available for withdrawal</p>
            </div>
            <div class="grid grid-cols-2 gap-6">
              <div class="bg-primary-focus/30 rounded-lg p-4">
                <p class="text-white/80 text-xs uppercase">Total Earnings</p>
                <p class="text-2xl font-semibold mt-2">${{ number_format($totalEarnings, 2) }}</p>
              </div>
              <div class="bg-primary-focus/30 rounded-lg p-4">
                <p class="text-white/80 text-xs uppercase">Total Withdrawn</p>
                <p class="text-2xl font-semibold mt-2">${{ number_format($approvedWithdrawals, 2) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Withdraw Form -->
      <div class="card bg-base-100 shadow-lg border border-primary/20 mb-10">
        <div class="card-body">
          <h3 class="text-xl font-bold mb-4">Withdraw Money</h3>
          @if($hasPendingWithdrawal)
            <div class="alert alert-warning mb-4">
              <span class="icon-[tabler--clock] size-5"></span>
              <span>You already have a pending withdrawal. Please wait for it to be processed before requesting another.</span>
            </div>
          @endif
          <form action="{{ route('dashboard.earnings.withdraw') }}" method="POST" class="grid md:grid-cols-3 gap-4 items-end">
            @csrf
            <div class="form-control md:col-span-2">
              <label class="label">
                <span class="label-text font-semibold">Withdrawal Amount (USD)</span>
              </label>
              <input type="number" step="0.01" min="1" name="amount" class="input input-bordered w-full" placeholder="0.00" required {{ $hasPendingWithdrawal ? 'disabled' : '' }}>
              @error('amount')
                <label class="label">
                  <span class="label-text-alt text-error">{{ $message }}</span>
                </label>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary w-full" {{ $hasPendingWithdrawal ? 'disabled' : '' }}>
              <span class="icon-[tabler--cash] size-5"></span>
              Request Withdrawal
            </button>
          </form>
        </div>
      </div>

      <!-- Withdrawal History -->
      <div class="card bg-base-100 shadow-lg border border-primary/20">
        <div class="card-body">
          <h3 class="text-xl font-bold mb-4">Withdrawal History</h3>
          <div class="overflow-x-auto">
            <table class="table w-full">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse($withdrawals as $withdrawal)
                  <tr>
                    <td>{{ $withdrawal->created_at->format('M d, Y H:i') }}</td>
                    <td class="font-semibold">${{ number_format($withdrawal->amount, 2) }}</td>
                    <td>
                      @if($withdrawal->status === 'approved')
                        <span class="badge badge-success gap-1">
                          <span class="icon-[tabler--check] size-4"></span>
                          Approved
                        </span>
                      @elseif($withdrawal->status === 'rejected')
                        <span class="badge badge-error gap-1">
                          <span class="icon-[tabler--x] size-4"></span>
                          Rejected
                        </span>
                      @else
                        <span class="badge badge-warning gap-1">
                          <span class="icon-[tabler--clock] size-4"></span>
                          Pending
                        </span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center text-base-content/60">No withdrawal requests yet.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-6">
            {{ $withdrawals->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
</x-dashboard-layout>
