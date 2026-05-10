<x-layout>
<div class="min-h-screen bg-base-100 flex">
  <!-- Sidebar -->
  <div class="w-64 bg-base-200 shadow-lg flex flex-col hidden lg:flex">
    <div class="p-6 border-b border-base-300">
      <h2 class="text-2xl font-bold text-primary">Admin</h2>
      <p class="text-base-content/60 text-sm">Control Panel</p>
    </div>

    <nav class="flex-1 p-4 space-y-2">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--home] size-5"></span>
        <span>Home</span>
      </a>
      <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--users] size-5"></span>
        <span>Users</span>
      </a>
      <a href="{{ route('admin.tasks') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checklist] size-5"></span>
        <span>Mock Tests</span>
      </a>
      <a href="{{ route('admin.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--checkbox] size-5"></span>
        <span>Approvals</span>
      </a>
      <a href="{{ route('admin.upgrade-requests') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--file-invoice] size-5"></span>
        <span>Upgrade Requests</span>
      </a>
      <a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--wallet] size-5"></span>
        <span>Payment Requests</span>
      </a>
      <a href="{{ route('admin.videos') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
      <a href="{{ route('admin.password.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--lock-password] size-5"></span>
        <span>Change Password</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition">
        <span class="icon-[tabler--logout] size-5"></span>
        <span>Logout</span>
      </button>
    </div>
  </div>

  <!-- Main Content Wrapper -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-primary-focus">
      <div class="px-4 md:px-8 py-12">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <div>
            <h1 class="text-4xl font-bold text-white mb-2">Payment Requests</h1>
            <p class="text-white/80">Review and manage user withdrawal requests</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 px-4 md:px-8 py-8">
      @if(session('success'))
        <div class="alert alert-success shadow-lg mb-6">
          <span class="icon-[tabler--check] size-5"></span>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <h2 class="card-title text-lg mb-4">Latest Withdrawal Requests</h2>
          <div class="overflow-x-auto">
            <table class="table w-full">
              <thead>
                <tr>
                  <th>User Email</th>
                  <th>Wallet Address</th>
                  <th>Date & Time</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($requests as $request)
                  <tr>
                    <td class="font-medium">{{ $request->user->email }}</td>
                    <td class="text-base-content/70">{{ $request->user->crypto_wallet ?? '—' }}</td>
                    <td>{{ $request->created_at->format('M d, Y H:i') }}</td>
                    <td class="font-semibold">${{ number_format($request->amount, 2) }}</td>
                    <td>
                      @if($request->status === 'approved')
                        <span class="badge badge-success gap-1">
                          <span class="icon-[tabler--check] size-4"></span>
                          Approved
                        </span>
                      @elseif($request->status === 'rejected')
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
                    <td>
                      @if($request->status === 'pending')
                        <div class="flex gap-2">
                          <form method="POST" action="{{ route('admin.finance.approve', $request->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                          </form>
                          <form method="POST" action="{{ route('admin.finance.reject', $request->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-error">Reject</button>
                          </form>
                        </div>
                      @else
                        <span class="text-base-content/60 text-sm">No actions</span>
                      @endif
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-base-content/60">No withdrawal requests found.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <div class="mt-6">
            {{ $requests->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</x-layout>
