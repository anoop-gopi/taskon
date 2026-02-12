<x-dashboard-layout>
  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-primary to-primary-focus text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Invoice Created</h1>
        <p class="text-white/80 text-lg">Complete your payment to upgrade your plan</p>
      </div>
    </div>
  </section>

  <!-- Invoice Content -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="max-w-2xl mx-auto">
        <div class="card bg-base-100 shadow-2xl border-2 border-primary/20">
          <div class="card-body">
            <!-- Invoice Header -->
            <div class="text-center mb-8 pb-6 border-b-2 border-base-300">
              <div class="badge badge-warning gap-2 mb-4">
                <span class="icon-[tabler--clock] size-4"></span>
                Pending Payment
              </div>
              <h2 class="text-3xl font-bold mb-2">Invoice Amount</h2>
              <p class="text-5xl font-bold text-primary">{{ number_format($upgradeRequest->amount, 0) }} USD</p>
              <p class="text-sm text-base-content/60 mt-4">
                Invoice expires in 
                <span class="font-semibold text-warning">
                  {{ $upgradeRequest->expires_at ? $upgradeRequest->expires_at->diffForHumans() : '2 hours' }}
                </span>
              </p>
              <p class="text-xs text-base-content/50 mt-1">
                After this period, the payment link will stop working
              </p>
            </div>

            <!-- Upgrade Details -->
            <div class="bg-base-200 rounded-lg p-4 mb-6">
              <h3 class="font-semibold mb-2">Upgrade Details</h3>
              <div class="flex justify-between text-sm">
                <span class="text-base-content/70">Plan:</span>
                <span class="font-semibold">{{ $upgradeRequest->toCategory->name }}</span>
              </div>
              <div class="flex justify-between text-sm mt-1">
                <span class="text-base-content/70">Tasks per week:</span>
                <span class="font-semibold">{{ $upgradeRequest->toCategory->tasks_per_week }}</span>
              </div>
              <div class="flex justify-between text-sm mt-1">
                <span class="text-base-content/70">Earning per task:</span>
                <span class="font-semibold">${{ number_format($upgradeRequest->toCategory->earning_per_task, 0) }}</span>
              </div>
            </div>

            <!-- Payment URL -->
            <div class="mb-6">
              <label class="label">
                <span class="label-text font-semibold flex items-center gap-2">
                  <span class="icon-[tabler--link] size-5"></span>
                  Wallet address
                </span>
              </label>
              <div class="flex gap-2">
                <input 
                  type="text" 
                  readonly 
                  value="{{ $upgradeRequest->payment_url }}" 
                  id="payment-url"
                  class="input input-bordered w-full text-sm font-mono"
                />
                <button 
                  onclick="copyPaymentUrl()" 
                  class="btn btn-square btn-outline"
                  title="Copy URL"
                >
                  <span class="icon-[tabler--copy] size-5"></span>
                </button>
              </div>
            </div>

            <!-- QR Code -->
            <div class="flex justify-center mb-6">
              <div class="bg-white p-6 rounded-lg shadow-inner">
                <div id="qrcode"></div>
              </div>
            </div>

            <!-- Submit Payment Screenshot -->
            <div class="divider">OR</div>

            <form action="{{ route('dashboard.upgrade.submit-payment', $upgradeRequest->id) }}" method="POST" enctype="multipart/form-data" id="payment-form">
              @csrf
              <div class="form-control mb-4">
                <label class="label">
                  <span class="label-text font-semibold">
                    Upload Payment Screenshot
                  </span>
                </label>
                <input 
                  type="file" 
                  name="payment_screenshot" 
                  accept="image/*"
                  class="file-input file-input-bordered w-full" 
                  required
                  id="screenshot-input"
                  onchange="previewImage(event)"
                />
                @error('payment_screenshot')
                  <label class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                  </label>
                @enderror
              </div>

              <!-- Image Preview -->
              <div id="image-preview" class="hidden mb-4">
                <img id="preview-img" class="w-full rounded-lg border-2 border-base-300" />
              </div>

              <div class="alert alert-warning mb-4">
                <span class="icon-[tabler--alert-triangle] size-5"></span>
                <div class="text-sm">
                  <strong>Important:</strong> Please complete the payment using the link/QR code above, 
                  then upload a clear screenshot of your payment confirmation for admin verification.
                </div>
              </div>

              <button type="submit" class="btn btn-primary btn-block gap-2">
                <span class="icon-[tabler--upload] size-5"></span>
                Submit Payment Screenshot
              </button>
            </form>

            <!-- Back Button -->
            <a href="{{ route('dashboard.upgrade') }}" class="btn btn-ghost btn-block mt-4">
              Cancel & Go Back
            </a>
          </div>
        </div>

        <!-- Instructions -->
        <div class="card bg-base-200 shadow-lg mt-6">
          <div class="card-body">
            <h3 class="card-title text-lg mb-4">
              <span class="icon-[tabler--info-circle] size-6 text-info"></span>
              Payment Instructions
            </h3>
            <ol class="list-decimal list-inside space-y-2 text-sm">
              <li>Click the payment link above or scan the QR code with your crypto wallet</li>
              <li>Complete the payment of <strong>{{ number_format($upgradeRequest->amount, 0) }} USD</strong></li>
              <li>Take a screenshot of your payment confirmation</li>
              <li>Upload the screenshot using the form above</li>
              <li>Wait for admin approval (usually within 24 hours)</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- QR Code Library -->
  <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
  
  <script>
    // Generate QR Code
    new QRCode(document.getElementById("qrcode"), {
      text: "{{ $upgradeRequest->payment_url }}",
      width: 200,
      height: 200,
      colorDark : "#000000",
      colorLight : "#ffffff",
      correctLevel : QRCode.CorrectLevel.H
    });

    // Copy Payment URL
    function copyPaymentUrl() {
      const input = document.getElementById('payment-url');
      input.select();
      document.execCommand('copy');
      
      // Show toast notification
      const toast = document.createElement('div');
      toast.className = 'toast toast-top toast-end';
      toast.innerHTML = `
        <div class="alert alert-success">
          <span class="icon-[tabler--check] size-5"></span>
          <span>Payment URL copied to clipboard!</span>
        </div>
      `;
      document.body.appendChild(toast);
      
      setTimeout(() => {
        toast.remove();
      }, 3000);
    }

    // Preview Image
    function previewImage(event) {
      const preview = document.getElementById('image-preview');
      const previewImg = document.getElementById('preview-img');
      const file = event.target.files[0];
      
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
          preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
      }
    }
  </script>
</x-dashboard-layout>
