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
        <span>Tasks</span>
      </a>
      <a href="{{ route('admin.approvals') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary text-white font-medium">
        <span class="icon-[tabler--checkbox] size-5"></span>
        <span>Approvals</span>
      </a>
      <a href="{{ route('admin.finance') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--wallet] size-5"></span>
        <span>Payment Requests</span>
      </a>
      <a href="{{ route('admin.videos') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--video] size-5"></span>
        <span>Videos</span>
      </a>
      <a href="{{ route('admin.testimonials') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--message-star] size-5"></span>
        <span>Testimonials</span>
      </a>
      <a href="#settings" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-primary/10 text-base-content transition">
        <span class="icon-[tabler--settings] size-5"></span>
        <span>Settings</span>
      </a>
    </nav>

    <div class="p-4 border-t border-base-300">
      <button class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-error/20 text-error font-medium transition">
        <span class="icon-[tabler--logout] size-5"></span>
        <span>Logout</span>
      </button>
    </div>
  </div>

  <!-- Mobile Menu Button -->
  <div class="lg:hidden absolute top-4 left-4 z-50">
    <button class="btn btn-square btn-ghost" id="mobile-menu-btn">
      <span class="icon-[tabler--menu] size-6"></span>
    </button>
  </div>

  <!-- Main Content Wrapper -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary to-primary-focus">
      <div class="px-4 md:px-8 py-8">
        <div class="flex items-center gap-4">
          <a href="{{ route('admin.approvals') }}" class="btn btn-ghost btn-circle">
            <span class="icon-[tabler--arrow-left] size-6 text-white"></span>
          </a>
          <div>
            <h1 class="text-3xl font-bold text-white">Approval Review</h1>
            <p class="text-white/80 text-sm">Review and approve task completion</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 px-4 md:px-8 py-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Task Completion Details -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Quick Overview -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg mb-4">Overview</h3>
              <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div>
                  <p class="text-base-content/60 text-xs mb-1">Task ID</p>
                  <p class="font-semibold text-primary">{{ $approval->task_id }}</p>
                </div>
                <div>
                  <p class="text-base-content/60 text-xs mb-1">Task Name</p>
                  <p class="font-semibold">{{ $approval->task->name }}</p>
                </div>
                <div>
                  <p class="text-base-content/60 text-xs mb-1">Amount</p>
                  <p class="font-semibold text-success">${{ number_format($approval->task->earning, 2) }}</p>
                </div>
                <div>
                  <p class="text-base-content/60 text-xs mb-1">Status</p>
                  @if($approval->status == 1)
                    <div class="badge badge-warning gap-1">
                      <span class="icon-[tabler--clock] size-2"></span>
                      {{ $approval->taskStatus->name }}
                    </div>
                  @elseif($approval->status == 2)
                    <div class="badge badge-success gap-1">
                      <span class="icon-[tabler--check] size-2"></span>
                      {{ $approval->taskStatus->name }}
                    </div>
                  @else
                    <div class="badge badge-error gap-1">
                      <span class="icon-[tabler--x] size-2"></span>
                      {{ $approval->taskStatus->name }}
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <!-- User Information -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg mb-4">User Information</h3>
              <div class="space-y-3">
                <div class="flex justify-between border-b border-base-300 pb-3">
                  <span class="text-base-content/60">User Name</span>
                  <span class="font-semibold">{{ $approval->user->name }}</span>
                </div>
                <div class="flex justify-between border-b border-base-300 pb-3">
                  <span class="text-base-content/60">User Email</span>
                  <span class="font-semibold">{{ $approval->user->email }}</span>
                </div>
                <div class="flex justify-between border-b border-base-300 pb-3">
                  <span class="text-base-content/60">User ID</span>
                  <span class="font-semibold">#{{ str_pad($approval->user_id, 4, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-base-content/60">Account Status</span>
                  <div class="badge badge-success gap-1">
                    <span class="icon-[tabler--circle-filled] size-2"></span>
                    Active
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Task Completion Details -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg mb-4">Task Completion Details</h3>
              <div class="space-y-3">
                <div class="flex justify-between border-b border-base-300 pb-3">
                  <span class="text-base-content/60">Task ID</span>
                  <span class="font-semibold text-primary">{{ $approval->task_id }}</span>
                </div>
                <div class="flex justify-between border-b border-base-300 pb-3">
                  <span class="text-base-content/60">Task Name</span>
                  <span class="font-semibold">{{ $approval->task->name }}</span>
                </div>
                <div class="flex justify-between border-b border-base-300 pb-3">
                  <span class="text-base-content/60">Completion Date</span>
                  <span class="font-semibold">{{ \Carbon\Carbon::parse($approval->date_time)->format('M d, Y') }}</span>
                </div>
                <div class="flex justify-between border-b border-base-300 pb-3">
                  <span class="text-base-content/60">Completion Time</span>
                  <span class="font-semibold">{{ \Carbon\Carbon::parse($approval->date_time)->format('h:i A') }}</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-base-content/60">Amount</span>
                  <span class="font-semibold text-success text-lg">${{ number_format($approval->task->earning, 2) }}</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Submitted Screenshot/Work -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg mb-4">Submitted Work & Screenshot</h3>
              @if($approval->image_path)
                <div class="bg-base-200 rounded-lg p-6 mb-4">
                  <img src="{{ asset('storage/' . $approval->image_path) }}" alt="Task completion screenshot" class="w-full h-auto rounded-lg shadow-sm">
                </div>
              @else
                <div class="bg-base-200 rounded-lg p-6 mb-4">
                  <div class="flex items-center justify-center h-96 bg-base-300 rounded-lg border-2 border-dashed border-base-400">
                    <div class="text-center">
                      <span class="icon-[tabler--photo] size-16 text-base-content/30 mx-auto block mb-2"></span>
                      <p class="text-base-content/50 mb-2">No Screenshot Uploaded</p>
                      <p class="text-xs text-base-content/40">User did not upload a screenshot</p>
                    </div>
                  </div>
                </div>
              @endif
              @if($approval->notes)
                <div class="divider my-2"></div>
                <div class="space-y-2">
                  <p class="text-sm font-medium text-base-content/60">User's Submission Notes:</p>
                  <div class="bg-base-200 rounded-lg p-4">
                    <p class="text-base">{{ $approval->notes }}</p>
                  </div>
                </div>
              @endif
            </div>
          </div>

          <!-- Task Description -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body">
              <h3 class="card-title text-lg mb-4">Task Description</h3>
              <div class="space-y-3">
                <div class="bg-base-200 rounded-lg p-4">
                  <p class="text-base">{{ $approval->task->description }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Approval Actions -->
        <div class="lg:col-span-1">
          <!-- Status Card -->
          <div class="card bg-base-100 shadow-md mb-6">
            <div class="card-body items-center text-center">
              @if($approval->status == 1)
                <div class="bg-warning/10 rounded-lg p-4 mb-4">
                  <span class="icon-[tabler--clock] size-12 text-warning"></span>
                </div>
                <h3 class="card-title text-lg">{{ $approval->taskStatus->name }}</h3>
                <p class="text-base-content/60 text-sm mt-2">Waiting for your decision</p>
              @elseif($approval->status == 2)
                <div class="bg-success/10 rounded-lg p-4 mb-4">
                  <span class="icon-[tabler--check] size-12 text-success"></span>
                </div>
                <h3 class="card-title text-lg">{{ $approval->taskStatus->name }}</h3>
                <p class="text-base-content/60 text-sm mt-2">Task has been approved</p>
              @else
                <div class="bg-error/10 rounded-lg p-4 mb-4">
                  <span class="icon-[tabler--x] size-12 text-error"></span>
                </div>
                <h3 class="card-title text-lg">{{ $approval->taskStatus->name }}</h3>
                <p class="text-base-content/60 text-sm mt-2">Task has been rejected</p>
              @endif
              <div class="divider my-2"></div>
              
              <!-- Approval Timeline -->
              <div class="text-left space-y-3 w-full">
                <div class="text-xs">
                  <p class="text-base-content/60 mb-1">Submitted</p>
                  <p class="font-semibold">{{ \Carbon\Carbon::parse($approval->date_time)->diffForHumans() }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="card bg-base-100 shadow-md">
            <div class="card-body space-y-3">
              @if($approval->status == 1)
                <form action="{{ route('admin.approval.approve', $approval->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-success gap-2 w-full" onclick="return confirm('Are you sure you want to approve this task?')">
                    <span class="icon-[tabler--check] size-5"></span>
                    Approve & Process Payment
                  </button>
                </form>
                <form action="{{ route('admin.approval.reject', $approval->id) }}" method="POST" class="mt-3">
                  @csrf
                  <button type="submit" class="btn btn-error gap-2 w-full" onclick="return confirm('Are you sure you want to reject this task?')">
                    <span class="icon-[tabler--x] size-5"></span>
                    Reject
                  </button>
                </form>
              @elseif($approval->status == 2)
                <div class="alert alert-success">
                  <span class="icon-[tabler--check] size-5"></span>
                  <span>This task has been approved</span>
                </div>
              @else
                <div class="alert alert-error">
                  <span class="icon-[tabler--x] size-5"></span>
                  <span>This task has been rejected</span>
                </div>
              @endif
            </div>
          </div>

          <!-- Additional Info -->
          <div class="card bg-base-100 shadow-md mt-6">
            <div class="card-body">
              <h4 class="text-sm font-semibold mb-3">Review Guidelines</h4>
              <div class="space-y-2 text-xs text-base-content/60">
                <p>✓ Verify task completion</p>
                <p>✓ Check deliverables quality</p>
                <p>✓ Confirm all requirements met</p>
                <p>✓ Process payment if approved</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Activity Log -->
      <div class="card bg-base-100 shadow-md">
        <div class="card-body">
          <h3 class="card-title text-lg mb-4">Activity Timeline</h3>
          <div class="space-y-3">
            <div class="flex gap-3">
              <div class="flex flex-col items-center">
                <div class="w-3 h-3 bg-success rounded-full"></div>
                @if($approval->status != 1)
                  <div class="w-0.5 h-12 bg-base-300"></div>
                @endif
              </div>
              <div class="pb-6">
                <p class="font-semibold">Task Submitted</p>
                <p class="text-base-content/60 text-sm">{{ \Carbon\Carbon::parse($approval->date_time)->format('M d, Y h:i A') }}</p>
                <p class="text-base-content/60 text-sm mt-1">User submitted completed task for review</p>
              </div>
            </div>

            @if($approval->status == 2)
              <div class="flex gap-3">
                <div class="flex flex-col items-center">
                  <div class="w-3 h-3 bg-success rounded-full"></div>
                </div>
                <div>
                  <p class="font-semibold">Task Approved</p>
                  <p class="text-base-content/60 text-sm">{{ \Carbon\Carbon::parse($approval->updated_at)->format('M d, Y h:i A') }}</p>
                  <p class="text-base-content/60 text-sm mt-1">Task has been approved by admin</p>
                </div>
              </div>
            @elseif($approval->status == 3)
              <div class="flex gap-3">
                <div class="flex flex-col items-center">
                  <div class="w-3 h-3 bg-error rounded-full"></div>
                </div>
                <div>
                  <p class="font-semibold">Task Rejected</p>
                  <p class="text-base-content/60 text-sm">{{ \Carbon\Carbon::parse($approval->updated_at)->format('M d, Y h:i A') }}</p>
                  <p class="text-base-content/60 text-sm mt-1">Task has been rejected by admin</p>
                </div>
              </div>
            @else
              <div class="flex gap-3">
                <div class="flex flex-col items-center">
                  <div class="w-3 h-3 bg-warning rounded-full"></div>
                </div>
                <div>
                  <p class="font-semibold">Awaiting Admin Approval</p>
                  <p class="text-base-content/60 text-sm">Now</p>
                  <p class="text-base-content/60 text-sm mt-1">Waiting for your decision</p>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('mobile-menu-btn').addEventListener('click', function() {
    const sidebar = document.querySelector('.w-64');
    sidebar.classList.toggle('hidden');
  });
</script>
</x-layout>
