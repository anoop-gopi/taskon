<x-dashboard-layout>
  <!-- Hero Section -->
  <section class="bg-gradient-to-r from-primary to-primary-focus text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Upgrade Your Account</h1>
        <p class="text-white/80 text-lg">Unlock more tasks and higher earnings with our premium plans</p>
      </div>
    </div>
  </section>

  <!-- Current Plan -->
  <section class="py-8 bg-base-200">
    <div class="container mx-auto px-4">
      <div class="max-w-2xl mx-auto">
        <div class="alert alert-info">
          <span class="icon-[tabler--info-circle] size-6"></span>
          <div>
            <h3 class="font-bold">Current Plan: {{ $currentCategory->name }}</h3>
            <div class="text-sm">
              {{ $currentCategory->tasks_per_week }} {{ $currentCategory->tasks_per_week == 1 ? 'task' : 'tasks' }} per month
              @if($currentCategory->earning_per_task > 0)
                • ${{ number_format($currentCategory->earning_per_task, 0) }} per task
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing Plans -->
  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        @foreach($categories as $category)
        <div class="card bg-base-100 shadow-xl border-2 {{ $currentCategory->id == $category->id ? 'border-primary' : 'border-base-300' }} hover:shadow-2xl transition">
          <div class="card-body">
            <!-- Plan Header -->
            <div class="text-center mb-6">
              @if($category->name == 'Basic')
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span class="icon-[tabler--star] size-8 text-blue-500"></span>
                </div>
              @elseif($category->name == 'Pro')
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span class="icon-[tabler--stars] size-8 text-purple-500"></span>
                </div>
              @else
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <span class="icon-[tabler--crown] size-8 text-orange-500"></span>
                </div>
              @endif
              
              <h2 class="text-2xl font-bold mb-2">{{ $category->name }}</h2>
              <div class="text-4xl font-bold text-primary mb-2">
                ${{ number_format($category->price, 0) }}
                <span class="text-base font-normal text-base-content/60">/month</span>
              </div>
            </div>

            <!-- Features -->
            <div class="space-y-3 mb-6">
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span><strong>{{ $category->tasks_per_week }}</strong> tasks per month</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span><strong>${{ number_format($category->earning_per_task, 0) }}</strong> per task</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span>Potential: <strong>${{ number_format($category->tasks_per_week * $category->earning_per_task * 4, 0) }}/month</strong></span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span>Priority support</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="icon-[tabler--check] size-5 text-success"></span>
                <span>Access to premium tasks</span>
              </div>
            </div>

            <!-- CTA Button -->
            @if($currentCategory->id == $category->id)
              <button class="btn btn-outline btn-disabled w-full" disabled>
                Current Plan
              </button>
            @elseif($currentCategory->id > $category->id)
              <button class="btn btn-ghost w-full" disabled>
                Lower Tier
              </button>
            @else
              <button 
                type="button" 
                class="btn btn-primary w-full gap-2" 
                aria-haspopup="dialog" 
                aria-expanded="false" 
                aria-controls="upgradeModal-{{ $category->id }}"
                data-overlay="#upgradeModal-{{ $category->id }}"
                onclick="initUpgradeModal({{ $category->id }})"
              >
                <span class="icon-[tabler--arrow-up] size-5"></span>
                Upgrade Now
              </button>

              <!-- Modal for this category -->
              <div id="upgradeModal-{{ $category->id }}" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1">
                <div class="modal-dialog overlay-open:opacity-100 w-11/12 max-w-2xl">
                  <div class="modal-content max-h-[90vh] overflow-y-auto">
                    <div class="modal-header">
                      <h3 class="modal-title">Upgrade to {{ $category->name }}</h3>
                      <button
                        type="button"
                        class="btn btn-text btn-circle btn-sm absolute end-3 top-3"
                        aria-label="Close"
                        data-overlay="#upgradeModal-{{ $category->id }}"
                      >
                        <span class="icon-[tabler--x] size-4"></span>
                      </button>
                    </div>
                    <div class="modal-body" id="modalContent-{{ $category->id }}">
                      <!-- Loading state -->
                      <div class="flex items-center justify-center py-12">
                        <span class="loading loading-spinner loading-lg"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
        @endforeach
      </div>

      <!-- Benefits Section -->
      <div class="max-w-4xl mx-auto mt-16">
        <h2 class="text-3xl font-bold text-center mb-8">Why Upgrade?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="card bg-base-200">
            <div class="card-body items-center text-center">
              <span class="icon-[tabler--trending-up] size-12 text-primary mb-4"></span>
              <h3 class="card-title text-lg">Higher Earnings</h3>
              <p class="text-base-content/70">Earn significantly more per task with premium plans</p>
            </div>
          </div>
          <div class="card bg-base-200">
            <div class="card-body items-center text-center">
              <span class="icon-[tabler--calendar-check] size-12 text-primary mb-4"></span>
              <h3 class="card-title text-lg">More Tasks</h3>
              <p class="text-base-content/70">Complete more tasks per month to maximize income</p>
            </div>
          </div>
          <div class="card bg-base-200">
            <div class="card-body items-center text-center">
              <span class="icon-[tabler--lock-open] size-12 text-primary mb-4"></span>
              <h3 class="card-title text-lg">Exclusive Access</h3>
              <p class="text-base-content/70">Get access to premium tasks not available to free users</p>
            </div>
          </div>
        </div>
      </div>

      <!-- ROI Calculator -->
      <div class="max-w-4xl mx-auto mt-16 card bg-gradient-to-br from-primary/10 to-secondary/10 shadow-xl">
        <div class="card-body">
          <h2 class="card-title text-2xl mb-6">Return on Investment</h2>
          <div class="overflow-x-auto">
            <table class="table">
              <thead>
                <tr>
                  <th>Plan</th>
                  <th>Monthly Cost</th>
                  <th>Potential Earnings</th>
                  <th>Net Profit</th>
                  <th>ROI</th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                <tr>
                  <td class="font-semibold">{{ $category->name }}</td>
                  <td>${{ number_format($category->price, 0) }}</td>
                  <td class="text-success font-semibold">${{ number_format($category->tasks_per_week * $category->earning_per_task * 4, 0) }}</td>
                  <td class="text-primary font-bold">${{ number_format(($category->tasks_per_week * $category->earning_per_task * 4) - $category->price, 0) }}</td>
                  <td class="font-bold">{{ number_format(((($category->tasks_per_week * $category->earning_per_task * 4) - $category->price) / $category->price) * 100, 0) }}%</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <p class="text-sm text-base-content/60 mt-4">
            * Based on completing all available tasks per month
          </p>
        </div>
      </div>
    </div>
  </section>

  @push('scripts')
  <!-- QR Code Library -->
  <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>

  <script>
    console.log('Upgrade page scripts loaded');
    
    function initUpgradeModal(categoryId) {
      console.log('Initializing modal for category:', categoryId);
      const modalContent = document.getElementById('modalContent-' + categoryId);
      
      if (!modalContent) {
        console.error('Modal content element not found!');
        return;
      }
      
      // Show loading
      modalContent.innerHTML = `
        <div class="flex items-center justify-center py-12">
          <span class="loading loading-spinner loading-lg"></span>
        </div>
      `;
      
      // Create upgrade request and load invoice
      fetch(`/dashboard/upgrade/${categoryId}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(response => response.json())
      .then(data => {
        console.log('Upgrade request response:', data);
        if (data.success) {
          loadInvoice(data.upgradeRequestId, categoryId);
        } else {
          modalContent.innerHTML = `
            <div class="alert alert-error">
              <span class="icon-[tabler--x] size-5"></span>
              <span>${data.message || 'Failed to create upgrade request'}</span>
            </div>
          `;
        }
      })
      .catch(error => {
        console.error('Error creating upgrade request:', error);
        modalContent.innerHTML = `
          <div class="alert alert-error">
            <span class="icon-[tabler--x] size-5"></span>
            <span>An error occurred. Please try again.</span>
          </div>
        `;
      });
    }

    function loadInvoice(upgradeRequestId, categoryId) {
      console.log('Loading invoice for request:', upgradeRequestId);
      const modalContent = document.getElementById('modalContent-' + categoryId);
      
      fetch(`/dashboard/upgrade/invoice/${upgradeRequestId}/content`)
        .then(response => response.json())
        .then(data => {
          console.log('Invoice content loaded');
          modalContent.innerHTML = data.html;
          
          // Generate QR Code after content is loaded
          setTimeout(() => {
            const qrcodeElement = document.getElementById('qrcode-modal');
            if (qrcodeElement) {
              qrcodeElement.innerHTML = '';
              new QRCode(qrcodeElement, {
                text: data.paymentUrl,
                width: 200,
                height: 200,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
              });
            }
          }, 100);
        })
        .catch(error => {
          console.error('Error loading invoice:', error);
        });
    }

    // Copy Payment URL
    function copyPaymentUrl() {
      const input = document.getElementById('payment-url-modal');
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
      const preview = document.getElementById('image-preview-modal');
      const previewImg = document.getElementById('preview-img-modal');
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

    // Handle form submission
    window.handleFormSubmit = function(event, categoryId) {
      event.preventDefault();
      console.log('Form submit handler called for category:', categoryId);
      
      const form = event.target;
      const formData = new FormData(form);
      
      // Show loading
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalContent = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="loading loading-spinner"></span> Submitting...';
      
      fetch(form.action, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        console.log('Submit response:', data);
        if (data.success) {
          // Close modal using FlyonUI overlay method
          const modal = document.getElementById('upgradeModal-' + categoryId);
          if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('overlay-open');
          }
          
          // Show success alert
          const alertHtml = `
            <div class="alert alert-success shadow-lg mb-4 removing:translate-x-5 removing:opacity-0 transition duration-300 ease-in-out" role="alert" id="success-alert">
              <span class="icon-[tabler--check] size-5"></span>
              <div>
                <strong>Success!</strong> ${data.message || 'Payment screenshot submitted! Your upgrade request is pending admin approval.'}
              </div>
              <button class="ms-auto cursor-pointer leading-none" data-remove-element="#success-alert" aria-label="Close">
                <span class="icon-[tabler--x] size-5"></span>
              </button>
            </div>
          `;
          
          // Insert alert at the top of the page
          const container = document.querySelector('.container.mx-auto.px-4');
          if (container) {
            container.insertAdjacentHTML('afterbegin', alertHtml);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
              const alert = document.getElementById('success-alert');
              if (alert) {
                alert.remove();
              }
            }, 5000);
          }
          
          // Reload after a short delay
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        } else {
          // Show error alert
          const alertHtml = `
            <div class="alert alert-error shadow-lg mb-4 removing:translate-x-5 removing:opacity-0 transition duration-300 ease-in-out" role="alert" id="error-alert">
              <span class="icon-[tabler--x] size-5"></span>
              <div>
                <strong>Error!</strong> ${data.message || 'Failed to submit payment screenshot'}
              </div>
              <button class="ms-auto cursor-pointer leading-none" data-remove-element="#error-alert" aria-label="Close">
                <span class="icon-[tabler--x] size-5"></span>
              </button>
            </div>
          `;
          
          const modalContent = document.getElementById('modalContent-' + categoryId);
          if (modalContent) {
            modalContent.insertAdjacentHTML('afterbegin', alertHtml);
          }
          
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalContent;
        }
      })
      .catch(error => {
        console.error('Submit error:', error);
        alert('An error occurred. Please try again.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalContent;
      });
    };
  </script>
  @endpush
</x-dashboard-layout>
