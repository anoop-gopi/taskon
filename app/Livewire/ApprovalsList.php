<?php

namespace App\Livewire;

use App\Models\TaskCompleted;
use Livewire\Component;
use Livewire\WithPagination;

class ApprovalsList extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $approvals = TaskCompleted::with(['task', 'user', 'taskStatus'])
            ->where('status', 1) // Only show pending approvals (status 1 = Pending)
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('email', 'like', '%' . $this->search . '%')
                      ->orWhere('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('task', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('date_time', 'desc')
            ->paginate(10)
            ->map(function ($approval) {
                return [
                    'id' => $approval->id,
                    'user_email' => $approval->user->email,
                    'user_name' => $approval->user->name,
                    'task_id' => $approval->task_id,
                    'task_name' => $approval->task->name,
                    'completion_date' => $approval->date_time,
                    'amount' => $approval->task->earning,
                ];
            });

        return view('livewire.approvals-list', [
            'approvals' => $approvals,
        ]);
    }
}
