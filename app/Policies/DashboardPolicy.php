<?php
namespace App\Policies;

use App\Models\User;

class DashboardPolicy
{
    public function view(User $user)
    {
        return $user->isAdmin() || $user->isProvider();
    }
}



