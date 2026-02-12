<x-admin-layout>
  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-primary to-primary-focus text-white py-8 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div>
          <h1 class="text-3xl md:text-4xl font-bold mb-2">Upgrade Requests</h1>
          <p class="text-white/80">Review and approve plan upgrade payments</p>
        </div>
        <div class="stats shadow-lg bg-white/10 text-white backdrop-blur-sm mt-4 md:mt-0">
          <div class="stat">
            <div class="stat-title text-white/70">Pending Requests</div>
            <div class="stat-value text-white">{{ $pendingCount }}</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Content Section -->
  <section class="py-8 bg-base-100">
    <div class="container mx-auto px-4">
      @if(session('success'))
        <div class="alert alert-success mb-6">
          <span class="icon-[tabler--check] size-5"></span>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-error mb-6">
          <span class="icon-[tabler--x] size-5"></span>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <!-- Filter Tabs -->
      <div class="tabs tabs-boxed mb-6 bg-base-200 p-1">
        <a href="{{ route('admin.upgrade-requests', ['status' => 'pending']) }}" 
           class="tab {{ (!request('status') || request('status') == 'pending') ? 'tab-active' : '' }}">
          Pending Payment
        </a>
        <a href="{{ route('admin.upgrade-requests', ['status' => 'pending_approval']) }}" 
           class="tab {{ request('status') == 'pending_approval' ? 'tab-active' : '' }}">
          Pending Approval
        </a>
        <a href="{{ route('admin.upgrade-requests', ['status' => 'approved']) }}" 
           class="tab {{ request('status') == 'approved' ? 'tab-active' : '' }}">
          Approved
        </a>
        <a href="{{ route('admin.upgrade-requests', ['status' => 'rejected']) }}" 
           class="tab {{ request('status') == 'rejected' ? 'tab-active' : '' }}">
          Rejected
        </a>
      </div>

      <!-- Upgrade Requests Table -->
      <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
          @if($requests->isEmpty())
            <div class="text-center py-12">
              <span class="icon-[tabler--file-invoice] size-16 mx-auto text-base-content/30 mb-4"></span>
              <p class="text-base-content/60">No upgrade requests found</p>
            </div>
          @else
            <div class="overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>Request ID</th>
                    <th>User</th>
                    <th>Upgrade</th>
                    <th>Amount</th>
                    <th>Screenshot</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($requests as $request)
                    <tr>
                      <td>
                        <span class="font-mono text-sm">#{{ str_pad($request->id, 5, '0', STR_PAD_LEFT) }}</span>
                      </td>
                      <td>
                        <div>
                          <div class="font-semibold">{{ $request->user->name }}</div>
                          <div class="text-sm text-base-content/60">{{ $request->user->email }}</div>
                        </div>
                      </td>
                      <td>
                        <div class="flex items-center gap-2">
                          <span class="badge badge-sm">{{ $request->fromCategory->name }}</span>
                          <span class="icon-[tabler--arrow-right] size-4"></span>
                          <span class="badge badge-primary badge-sm">{{ $request->toCategory->name }}</span>
                        </div>
                      </td>
                      <td>
                        <span class="font-semibold">${{ number_format($request->amount, 0) }}</span>
                      </td>
                      <td>
                        @if($request->payment_screenshot)
                          <label 
                            for="viewScreenshot{{ $request->id }}"
                            class="btn btn-sm btn-ghost gap-2 cursor-pointer"
                          >
                            <span class="icon-[tabler--photo] size-4"></span>
                            View
                          </label>
                        @else
                          <span class="text-base-content/40 text-sm">No screenshot</span>
                        @endif
                      </td>
                      <td>
                        @if($request->status == 'pending_payment')
                          <span class="badge badge-warning gap-2">
                            <span class="icon-[tabler--clock] size-3"></span>
                            Pending Payment
                          </span>
                        @elseif($request->status == 'pending_approval')
                          <span class="badge badge-info gap-2">
                            <span class="icon-[tabler--hourglass] size-3"></span>
                            Pending Approval
                          </span>
                        @elseif($request->status == 'approved')
                          <span class="badge badge-success gap-2">
                            <span class="icon-[tabler--check] size-3"></span>
                            Approved
                          </span>
                        @elseif($request->status == 'rejected')
                          <span class="badge badge-error gap-2">
                            <span class="icon-[tabler--x] size-3"></span>
                            Rejected
                          </span>
                        @endif
                      </td>
                      <td>
                        <div class="text-sm">
                          <div>{{ $request->created_at->format('M d, Y') }}</div>
                          <div class="text-base-content/50">{{ $request->created_at->format('h:i A') }}</div>
                        </div>
                      </td>
                      <td>
                        @if($request->status == 'pending_approval')
                          <div class="flex gap-2">
                            <label 
                              for="approveModal{{ $request->id }}"
                              class="btn btn-sm btn-success gap-2 cursor-pointer"
                            >
                              <span class="icon-[tabler--check] size-4"></span>
                              Approve
                            </label>
                            <label 
                              for="rejectModal{{ $request->id }}"
                              class="btn btn-sm btn-error gap-2 cursor-pointer"
                            >
                              <span class="icon-[tabler--x] size-4"></span>
                              Reject
                            </label>
                          </div>
                        @elseif($request->status == 'approved' || $request->status == 'rejected')
                          @if($request->admin_notes)
                            <label 
                              for="notesModal{{ $request->id }}"
                              class="btn btn-sm btn-ghost gap-2 cursor-pointer"
                            >
                              <span class="icon-[tabler--notes] size-4"></span>
                              View Notes
                            </label>
                          @else
                            <span class="text-base-content/40 text-sm">No actions</span>
                          @endif
                        @else
                          <span class="text-base-content/40 text-sm">Waiting for payment</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
              {{ $requests->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- Dialogs Container - Outside Table -->
  <div id="dialogs-container">
    @foreach($requests as $request)
      <!-- Screenshot Modal - Checkbox based -->
      @if($request->payment_screenshot)
        <input type="checkbox" id="viewScreenshot{{ $request->id }}" class="modal-toggle" />
        <div class="modal" role="dialog">
          <div class="modal-box w-11/12 max-w-3xl">
            <h3 class="font-bold text-lg mb-4">Payment Screenshot</h3>
            <img 
              src="{{ asset('storage/' . $request->payment_screenshot) }}" 
              alt="Payment Screenshot"
              class="w-full rounded-lg"
            />
            <div class="modal-action">
              <label for="viewScreenshot{{ $request->id }}" class="btn">Close</label>
            </div>
          </div>
          <label class="modal-backdrop" for="viewScreenshot{{ $request->id }}"></label>
        </div>
      @endif

      <!-- Approve Modal -->
      <input type="checkbox" id="approveModal{{ $request->id }}" class="modal-toggle" />
      <div class="modal" role="dialog">
        <div class="modal-box">
          <label for="approveModal{{ $request->id }}" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
          <h3 class="font-bold text-lg mb-4">Approve Upgrade Request</h3>
          <p class="mb-4">Are you sure you want to approve this upgrade request?</p>
          <div class="bg-base-200 p-4 rounded-lg mb-4">
            <p class="text-sm"><strong>User:</strong> {{ $request->user->name }}</p>
            <p class="text-sm"><strong>Upgrade:</strong> {{ $request->fromCategory->name }} → {{ $request->toCategory->name }}</p>
            <p class="text-sm"><strong>Amount:</strong> ${{ number_format($request->amount, 0) }}</p>
          </div>
          <form action="{{ route('admin.upgrade-requests.approve', $request->id) }}" method="POST">
            @csrf
            <div class="form-control mb-4">
              <label class="label">
                <span class="label-text">Admin Notes (Optional)</span>
              </label>
              <textarea 
                name="admin_notes" 
                class="textarea textarea-bordered" 
                placeholder="Add any notes..."
              ></textarea>
            </div>
            <div class="modal-action">
              <label for="approveModal{{ $request->id }}" class="btn btn-ghost">Cancel</label>
              <button type="submit" class="btn btn-success gap-2">
                <span class="icon-[tabler--check] size-4"></span>
                Confirm Approval
              </button>
            </div>
          </form>
        </div>
        <label class="modal-backdrop" for="approveModal{{ $request->id }}"></label>
      </div>

      <!-- Reject Modal -->
      <input type="checkbox" id="rejectModal{{ $request->id }}" class="modal-toggle" />
      <div class="modal" role="dialog">
        <div class="modal-box">
          <label for="rejectModal{{ $request->id }}" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
          <h3 class="font-bold text-lg mb-4">Reject Upgrade Request</h3>
          <p class="mb-4">Please provide a reason for rejecting this request:</p>
          <form action="{{ route('admin.upgrade-requests.reject', $request->id) }}" method="POST">
            @csrf
            <div class="form-control mb-4">
              <label class="label">
                <span class="label-text">Rejection Reason</span>
              </label>
              <textarea 
                name="admin_notes" 
                class="textarea textarea-bordered" 
                placeholder="E.g., Invalid payment screenshot, payment not received..."
              ></textarea>
            </div>
            <div class="modal-action">
              <label for="rejectModal{{ $request->id }}" class="btn btn-ghost">Cancel</label>
              <button type="submit" class="btn btn-error gap-2">
                <span class="icon-[tabler--x] size-4"></span>
                Confirm Rejection
              </button>
            </div>
          </form>
        </div>
        <label class="modal-backdrop" for="rejectModal{{ $request->id }}"></label>
      </div>

      <!-- Notes Modal -->
      @if($request->admin_notes)
        <input type="checkbox" id="notesModal{{ $request->id }}" class="modal-toggle" />
        <div class="modal" role="dialog">
          <div class="modal-box">
            <label for="notesModal{{ $request->id }}" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
            <h3 class="font-bold text-lg mb-4">Admin Notes</h3>
            <div class="bg-base-200 p-4 rounded-lg">
              <p class="text-sm">{{ $request->admin_notes }}</p>
            </div>
            <div class="modal-action">
              <label for="notesModal{{ $request->id }}" class="btn">Close</label>
            </div>
          </div>
          <label class="modal-backdrop" for="notesModal{{ $request->id }}"></label>
        </div>
      @endif
    @endforeach
  </div>

  <style>
    /* Ensure modals show when checkbox is checked - use adjacent sibling combinator */
    .modal-toggle:checked + .modal {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        pointer-events: auto !important;
        position: fixed;
        inset: 0;
        justify-content: center;
        align-items: center;
        z-index: 999;
        background-color: rgba(0, 0, 0, 0.8);
    }
    
    /* Modal box with solid background */
    .modal-box {
        background-color: white !important;
        border-radius: 0.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
        max-width: 512px;
        width: 90vw;
        padding: 1.5rem;
        position: relative;
        z-index: 1000;
    }
    
    /* Ensure modal box is centered and visible */
    .modal-toggle:checked + .modal .modal-box {
        position: relative;
        z-index: 1000;
    }
    
    /* Backdrop styling */
    .modal-backdrop {
        background-color: transparent;
    }
  </style>

  <script>
    // Add event listeners to all checkboxes for debugging
    document.addEventListener('DOMContentLoaded', function() {
      const checkboxes = document.querySelectorAll('.modal-toggle');
      console.log('Modal toggle checkboxes found:', checkboxes.length);
      
      // Add change listeners to ALL checkboxes
      checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
          console.log('Checkbox ' + this.id + ' changed to:', this.checked);
        });
      });
      
      // Log all modal divs
      const modals = document.querySelectorAll('.modal');
      console.log('Modal divs found:', modals.length);
    });
  </script>
</x-admin-layout>
