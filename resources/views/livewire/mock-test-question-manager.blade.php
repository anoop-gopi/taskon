<div class="space-y-6">

    @if (session()->has('questionSuccess'))
        <div class="alert alert-success">
            <span class="icon-[tabler--circle-check] size-5"></span>
            <span>{{ session('questionSuccess') }}</span>
        </div>
    @endif

    {{-- Questions List --}}
    <div class="card bg-base-100 shadow-md">
        <div class="card-body">
            <div class="flex items-center justify-between mb-4">
                <h2 class="card-title">
                    Questions
                    <div class="badge badge-info gap-1 ml-2">
                        <span class="icon-[tabler--help-square-rounded] size-4"></span>
                        {{ $questions->count() }}
                    </div>
                </h2>
                <button wire:click="toggleForm" class="btn btn-primary btn-sm gap-2">
                    @if($showForm)
                        <span class="icon-[tabler--x] size-4"></span>
                        Cancel
                    @else
                        <span class="icon-[tabler--plus] size-4"></span>
                        Add Question
                    @endif
                </button>
            </div>

            {{-- Add Question Form --}}
            @if($showForm)
                <div class="bg-base-200 rounded-xl p-6 mb-6 border border-primary/20">
                    <h3 class="font-semibold text-base mb-4">
                        Question {{ $questions->count() + 1 }}
                    </h3>

                    <form wire:submit.prevent="addQuestion" class="space-y-4">
                        {{-- Question Text --}}
                        <div class="form-control">
                            <div class="label"><span class="label-text font-semibold">Question Text *</span></div>
                            <textarea
                                wire:model="question_text"
                                rows="3"
                                class="textarea textarea-bordered w-full @error('question_text') textarea-error @enderror"
                                placeholder="Type the question here..."
                            ></textarea>
                            @error('question_text')
                                <div class="label"><span class="label-text-alt text-error">{{ $message }}</span></div>
                            @enderror
                        </div>

                        {{-- Options --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(['A','B','C','D'] as $opt)
                                <div class="form-control">
                                    <div class="label"><span class="label-text">Option {{ $opt }} *</span></div>
                                    <input
                                        type="text"
                                        wire:model="option_{{ strtolower($opt) }}"
                                        class="input input-bordered @error('option_' . strtolower($opt)) input-error @enderror"
                                        placeholder="Option {{ $opt }}"
                                    />
                                    @error('option_' . strtolower($opt))
                                        <div class="label"><span class="label-text-alt text-error">{{ $message }}</span></div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        {{-- Correct Answer --}}
                        <div class="form-control max-w-xs">
                            <div class="label"><span class="label-text font-semibold">Correct Answer *</span></div>
                            <select wire:model="correct_option" class="select select-bordered @error('correct_option') select-error @enderror">
                                <option value="A">Option A</option>
                                <option value="B">Option B</option>
                                <option value="C">Option C</option>
                                <option value="D">Option D</option>
                            </select>
                            @error('correct_option')
                                <div class="label"><span class="label-text-alt text-error">{{ $message }}</span></div>
                            @enderror
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button type="submit" class="btn btn-primary gap-2">
                                <span class="icon-[tabler--device-floppy] size-5"></span>
                                Save Question
                            </button>
                            <button type="button" wire:click="toggleForm" class="btn btn-ghost">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            {{-- Questions Table --}}
            @if($questions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th class="w-12">#</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th class="w-24">Correct</th>
                                <th class="w-20">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr class="align-top">
                                    <td class="font-bold text-primary">{{ $question->question_number }}</td>
                                    <td class="max-w-xs">{{ $question->question_text }}</td>
                                    <td>
                                        <div class="text-sm space-y-1">
                                            @foreach(['A','B','C','D'] as $opt)
                                                <div class="flex items-start gap-1 {{ $question->correct_option === $opt ? 'text-success font-semibold' : 'text-base-content/70' }}">
                                                    <span class="shrink-0 font-medium">{{ $opt }}.</span>
                                                    <span>{{ $question->{'option_' . strtolower($opt)} }}</span>
                                                    @if($question->correct_option === $opt)
                                                        <span class="icon-[tabler--check] size-4 shrink-0 mt-0.5"></span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <div class="badge badge-success font-bold">{{ $question->correct_option }}</div>
                                    </td>
                                    <td>
                                        <button
                                            wire:click="deleteQuestion({{ $question->id }})"
                                            wire:confirm="Delete Question {{ $question->question_number }}? The remaining questions will be renumbered."
                                            class="btn btn-ghost btn-xs text-error gap-1"
                                        >
                                            <span class="icon-[tabler--trash] size-4"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 text-base-content/50">
                    <span class="icon-[tabler--help-square-rounded] size-14 mb-3"></span>
                    <p class="font-semibold">No questions yet</p>
                    <p class="text-sm mt-1">Click <strong>Add Question</strong> to start building this test.</p>
                </div>
            @endif
        </div>
    </div>
</div>
