<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\UserCategory;
use Livewire\Component;

class CreateTask extends Component
{
    public $name = '';
    public $description = '';
    public $earning = '';
    public $category_id = 1; // Default to Free

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'earning' => 'required|numeric|min:0',
        'category_id' => 'required|exists:user_categories,id',
    ];

    public function save()
    {
        $validated = $this->validate();

        Task::create($validated);

        session()->flash('success', 'Task created successfully!');

        return redirect()->route('admin.tasks');
    }

    public function render()
    {
        $categories = UserCategory::orderBy('id')->get();
        
        return view('livewire.create-task', [
            'categories' => $categories,
        ]);
    }
}
