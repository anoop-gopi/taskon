<x-public-layout>
  <section class="bg-primary text-white py-12">
    <div class="container mx-auto px-4">
      <h1 class="text-4xl font-bold">Contact Us</h1>
      <p class="text-white/80 mt-2">Get in touch with our support team.</p>
    </div>
  </section>

  <section class="py-12 bg-base-100">
    <div class="container mx-auto px-4 max-w-4xl">
      <div class="grid md:grid-cols-2 gap-8">
        <div class="space-y-4">
          <h2 class="text-2xl font-bold">We’d love to hear from you</h2>
          <p class="text-base-content/70">Whether you have a question about tasks, payments, or account approvals, our team is ready to help.</p>
          <ul class="space-y-2 text-base-content/80">
            <li>• Response time: within 24–48 hours</li>
            <li>• Support hours: Mon–Fri, 9am–5pm</li>
            <li>• For urgent issues, include “URGENT” in the subject</li>
          </ul>
        </div>

        <div class="card bg-base-100 shadow-lg border border-primary/20">
          <div class="card-body">
            @if(session('success'))
              <div class="alert alert-success mb-4">
                <span class="icon-[tabler--check] size-5"></span>
                <span>{{ session('success') }}</span>
              </div>
            @endif

            <form method="POST" action="{{ route('public.contact.submit') }}" class="space-y-4">
              @csrf
              <div>
                <label class="label">
                  <span class="label-text">Name</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full" required>
              </div>
              <div>
                <label class="label">
                  <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full" required>
              </div>
              <div>
                <label class="label">
                  <span class="label-text">Phone</span>
                </label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="input input-bordered w-full">
              </div>
              <div>
                <label class="label">
                  <span class="label-text">Message</span>
                </label>
                <textarea name="message" rows="4" class="textarea textarea-bordered w-full" required>{{ old('message') }}</textarea>
              </div>
              <button type="submit" class="btn btn-primary w-full">Send Message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-public-layout>
