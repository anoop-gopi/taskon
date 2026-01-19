<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $users = collect([
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'joined_date' => '2023-06-15', 'earnings' => 2450.50],
            ['id' => 2, 'name' => 'Sarah Miller', 'email' => 'sarah@example.com', 'joined_date' => '2023-08-22', 'earnings' => 3200.75],
            ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike@example.com', 'joined_date' => '2023-09-10', 'earnings' => 1890.25],
            ['id' => 4, 'name' => 'Emily Davis', 'email' => 'emily@example.com', 'joined_date' => '2023-10-05', 'earnings' => 4100.00],
            ['id' => 5, 'name' => 'Robert Wilson', 'email' => 'robert@example.com', 'joined_date' => '2023-11-12', 'earnings' => 2750.90],
            ['id' => 6, 'name' => 'Jessica Brown', 'email' => 'jessica@example.com', 'joined_date' => '2024-01-08', 'earnings' => 3500.40],
            ['id' => 7, 'name' => 'David Taylor', 'email' => 'david@example.com', 'joined_date' => '2024-02-14', 'earnings' => 2100.60],
            ['id' => 8, 'name' => 'Amanda White', 'email' => 'amanda@example.com', 'joined_date' => '2024-03-20', 'earnings' => 3850.75],
        ]);

        $filtered = $users->filter(function ($user) {
            return empty($this->search) ||
                str_contains(strtolower($user['name']), strtolower($this->search)) ||
                str_contains(strtolower($user['email']), strtolower($this->search));
        });

        return view('livewire.users-list', [
            'users' => $filtered->values(),
        ]);
    }
}
