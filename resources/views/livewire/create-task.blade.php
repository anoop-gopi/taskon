<div>
    @if (session()->has('success'))
        <div class="alert alert-success mb-4">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="space-y-6">
            <!-- Task Name -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Task Name *</span>
                </label>
                <input 
                    type="text" 
                    wire:model="name" 
                    class="input input-bordered w-full @error('name') input-error @enderror" 
                    placeholder="Enter task name"
                />
                @error('name')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Description</span>
                </label>
                <textarea 
                    wire:model="description" 
                    class="textarea textarea-bordered w-full h-32 @error('description') textarea-error @enderror" 
                    placeholder="Enter task description"
                ></textarea>
                @error('description')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <!-- Earning -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Earning (USD) *</span>
                </label>
                <input 
                    type="number" 
                    step="0.01"
                    wire:model="earning" 
                    class="input input-bordered w-full @error('earning') input-error @enderror" 
                    placeholder="0.00"
                />
                @error('earning')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
            </div>

            <!-- User Category -->
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-semibold">Available For *</span>
                    <span class="label-text-alt">Which user category can see this task?</span>
                </label>
                <select 
                    wire:model="category_id" 
                    class="select select-bordered w-full @error('category_id') select-error @enderror"
                >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }} 
                            @if($category->id > 1)
                                ({{ $category->tasks_per_week }} tasks/week, ${{ number_format($category->earning_per_task, 0) }}/task)
                            @else
                                ({{ $category->tasks_per_week }} task/week)
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <label class="label">
                        <span class="label-text-alt text-error">{{ $message }}</span>
                    </label>
                @enderror
                <label class="label">
                    <span class="label-text-alt text-info">
                        <span class="icon-[tabler--info-circle] size-4 inline"></span>
                        Tasks are visible to selected category and all higher tiers
                    </span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 justify-end">
                <a href="{{ route('admin.tasks') }}" class="btn btn-ghost">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary gap-2">
                    <span class="icon-[tabler--device-floppy] size-5"></span>
                    Create Task
                </button>
            </div>
        </div>
    </form>
</div>
