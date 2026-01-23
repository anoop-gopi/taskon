<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class CreateTask extends Component
{
    public $name = '';
    public $description = '';
    public $earning = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'earning' => 'required|numeric|min:0',
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
        return view('livewire.create-task');
    }
}
