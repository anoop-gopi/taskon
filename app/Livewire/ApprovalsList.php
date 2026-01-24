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
            ->paginate(10);

        return view('livewire.approvals-list', [
            'approvals' => $approvals,
        ]);
    }
}
