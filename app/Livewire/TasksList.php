<?php

namespace App\Livewire;

use Livewire\Component;

class TasksList extends Component
{
    public $search = '';

    public function render()
    {
        $tasks = collect([
            ['id' => 1, 'name' => 'Website Design', 'description' => 'Design a modern website layout', 'fee' => 500.00, 'count' => 3],
            ['id' => 2, 'name' => 'API Development', 'description' => 'Build RESTful API endpoints', 'fee' => 750.00, 'count' => 5],
            ['id' => 3, 'name' => 'Database Setup', 'description' => 'Configure database schema', 'fee' => 300.00, 'count' => 2],
            ['id' => 4, 'name' => 'Mobile App', 'description' => 'Develop iOS and Android app', 'fee' => 1200.00, 'count' => 8],
            ['id' => 5, 'name' => 'Content Writing', 'description' => 'Write product descriptions', 'fee' => 150.00, 'count' => 12],
            ['id' => 6, 'name' => 'SEO Optimization', 'description' => 'Optimize website for search', 'fee' => 400.00, 'count' => 4],
            ['id' => 7, 'name' => 'Testing & QA', 'description' => 'Test application functionality', 'fee' => 350.00, 'count' => 6],
            ['id' => 8, 'name' => 'Deployment', 'description' => 'Deploy to production server', 'fee' => 200.00, 'count' => 1],
        ]);

        $filtered = $tasks->filter(function ($task) {
            return empty($this->search) ||
                str_contains(strtolower($task['name']), strtolower($this->search)) ||
                str_contains(strtolower($task['description']), strtolower($this->search));
        });

        return view('livewire.tasks-list', [
            'tasks' => $filtered->values(),
        ]);
    }
}
