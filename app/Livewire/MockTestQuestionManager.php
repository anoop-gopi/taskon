<?php

namespace App\Livewire;

use App\Models\MockTestQuestion;
use Livewire\Component;

class MockTestQuestionManager extends Component
{
    public int $mockTestId;

    // Add-question form fields
    public string $question_text = '';
    public string $option_a = '';
    public string $option_b = '';
    public string $option_c = '';
    public string $option_d = '';
    public string $correct_option = 'A';

    public bool $showForm = false;

    protected $rules = [
        'question_text' => 'required|string',
        'option_a'      => 'required|string|max:500',
        'option_b'      => 'required|string|max:500',
        'option_c'      => 'required|string|max:500',
        'option_d'      => 'required|string|max:500',
        'correct_option' => 'required|in:A,B,C,D',
    ];

    public function addQuestion(): void
    {
        $this->validate();

        $nextNumber = MockTestQuestion::where('mock_test_id', $this->mockTestId)->count() + 1;

        MockTestQuestion::create([
            'mock_test_id'    => $this->mockTestId,
            'question_number' => $nextNumber,
            'question_text'   => $this->question_text,
            'option_a'        => $this->option_a,
            'option_b'        => $this->option_b,
            'option_c'        => $this->option_c,
            'option_d'        => $this->option_d,
            'correct_option'  => $this->correct_option,
        ]);

        $this->resetForm();
        session()->flash('questionSuccess', 'Question ' . $nextNumber . ' added successfully.');
    }

    public function deleteQuestion(int $questionId): void
    {
        $question = MockTestQuestion::where('mock_test_id', $this->mockTestId)->findOrFail($questionId);
        $deletedNumber = $question->question_number;
        $question->delete();

        // Renumber remaining questions to stay sequential
        MockTestQuestion::where('mock_test_id', $this->mockTestId)
            ->where('question_number', '>', $deletedNumber)
            ->orderBy('question_number')
            ->get()
            ->each(function ($q, $i) use ($deletedNumber) {
                $q->update(['question_number' => $deletedNumber + $i]);
            });
    }

    public function toggleForm(): void
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->resetForm();
        }
    }

    private function resetForm(): void
    {
        $this->reset(['question_text', 'option_a', 'option_b', 'option_c', 'option_d']);
        $this->correct_option = 'A';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.mock-test-question-manager', [
            'questions' => MockTestQuestion::where('mock_test_id', $this->mockTestId)
                ->orderBy('question_number')
                ->get(),
        ]);
    }
}
