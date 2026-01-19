<?php

namespace App\Livewire;

use Livewire\Component;

class ApprovalsList extends Component
{
    public $search = '';

    public function render()
    {
        $approvals = collect([
            ['id' => 1, 'user_email' => 'john@example.com', 'task_name' => 'Website Design', 'task_id' => 'TASK-001', 'completion_date' => '2024-01-19 14:30:00', 'amount' => 500.00],
            ['id' => 2, 'user_email' => 'sarah@example.com', 'task_name' => 'API Development', 'task_id' => 'TASK-002', 'completion_date' => '2024-01-18 11:45:00', 'amount' => 750.00],
            ['id' => 3, 'user_email' => 'mike@example.com', 'task_name' => 'Database Setup', 'task_id' => 'TASK-003', 'completion_date' => '2024-01-17 09:20:00', 'amount' => 300.00],
            ['id' => 4, 'user_email' => 'emily@example.com', 'task_name' => 'Mobile App', 'task_id' => 'TASK-004', 'completion_date' => '2024-01-16 16:15:00', 'amount' => 1200.00],
            ['id' => 5, 'user_email' => 'robert@example.com', 'task_name' => 'Content Writing', 'task_id' => 'TASK-005', 'completion_date' => '2024-01-15 13:00:00', 'amount' => 150.00],
            ['id' => 6, 'user_email' => 'jessica@example.com', 'task_name' => 'SEO Optimization', 'task_id' => 'TASK-006', 'completion_date' => '2024-01-14 10:30:00', 'amount' => 400.00],
            ['id' => 7, 'user_email' => 'david@example.com', 'task_name' => 'Testing & QA', 'task_id' => 'TASK-007', 'completion_date' => '2024-01-13 15:45:00', 'amount' => 350.00],
            ['id' => 8, 'user_email' => 'amanda@example.com', 'task_name' => 'Deployment', 'task_id' => 'TASK-008', 'completion_date' => '2024-01-12 12:00:00', 'amount' => 200.00],
        ]);

        $filtered = $approvals->filter(function ($approval) {
            return empty($this->search) ||
                str_contains(strtolower($approval['user_email']), strtolower($this->search)) ||
                str_contains(strtolower($approval['task_name']), strtolower($this->search)) ||
                str_contains(strtolower($approval['task_id']), strtolower($this->search));
        });

        return view('livewire.approvals-list', [
            'approvals' => $filtered->values(),
        ]);
    }
}
