<?php

namespace App\Livewire;

use App\Models\MockTest;
use Livewire\Component;

class CreateTask extends Component
{
    public $title = '';
    public $description = '';

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ];

    public function save()
    {
        $validated = $this->validate();

        $mockTest = MockTest::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
        ]);

        session()->flash('success', 'Mock test created. Now add questions below.');

        return redirect()->route('admin.task.show', $mockTest->id);
    }

    public function render()
    {
        return view('livewire.create-task');
    }
}
