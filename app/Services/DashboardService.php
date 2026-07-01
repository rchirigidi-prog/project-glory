<?php

namespace App\Services;

use App\Models\User;

class DashboardService
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function stats(): array
    {
        return [
            'users' => $this->user->countUsers(),

            // Temporary values
            'artists' => 0,
            'albums'  => 0,
            'songs'   => 0,
            'radio'   => 'LIVE'
        ];
    }
}
