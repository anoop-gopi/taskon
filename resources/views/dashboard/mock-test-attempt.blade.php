<x-dashboard-layout>
  @if(session('error'))
    <div class="container mx-auto px-4 pt-4">
      <div class="alert alert-error shadow-lg">
        <span class="icon-[tabler--alert-circle] size-5"></span>
        <span>{{ session('error') }}</span>
      </div>
    </div>
  @endif

  <section class="bg-primary text-white py-12 -mx-4 md:-mx-0">
    <div class="container mx-auto px-4">
      <a href="{{ route('dashboard.mock-tests') }}" class="inline-flex items-center text-white/80 hover:text-white mb-6 transition">
        <span class="icon-[tabler--arrow-left] size-5 mr-2"></span>
        Back to Mock Tests
      </a>
      <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $mockTest->title }}</h1>
      <p class="text-white/80">Answer all questions and submit to see your score.</p>
    </div>
  </section>

  <section class="py-12 bg-base-200">
    <div class="container mx-auto px-4 max-w-5xl">
      <form method="POST" action="{{ route('dashboard.mock-tests.submit', $mockTest->id) }}" class="space-y-6">
        @csrf

        @foreach($mockTest->questions as $question)
          <div class="card bg-base-100 shadow-md border border-primary/15">
            <div class="card-body">
              <h2 class="font-bold text-lg">
                Q{{ $question->question_number }}. {{ $question->question_text }}
              </h2>

              <div class="mt-4 space-y-3">
                @foreach(['A', 'B', 'C', 'D'] as $option)
                  @php
                    $optionText = $question->{'option_' . strtolower($option)};
                    $inputName = 'answers[' . $question->id . ']';
                  @endphp
                  <label class="flex items-start gap-3 p-3 rounded-lg border border-base-300 hover:border-primary/50 cursor-pointer transition">
                    <input
                      type="radio"
                      name="{{ $inputName }}"
                      value="{{ $option }}"
                      class="radio radio-primary mt-0.5"
                      {{ old('answers.' . $question->id) === $option ? 'checked' : '' }}
                      required
                    >
                    <span class="text-base-content">
                      <span class="font-semibold">{{ $option }}.</span>
                      {{ $optionText }}
                    </span>
                  </label>
                @endforeach
              </div>

              @error('answers.' . $question->id)
                <p class="text-error text-sm mt-2">{{ $message }}</p>
              @enderror
            </div>
          </div>
        @endforeach

        <div class="flex justify-end">
          <button type="submit" class="btn btn-primary btn-lg gap-2">
            <span class="icon-[tabler--send] size-5"></span>
            Submit Test
          </button>
        </div>
      </form>
    </div>
  </section>
</x-dashboard-layout>

