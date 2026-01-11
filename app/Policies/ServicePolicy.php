<?php
namespace App\Policies;

use App\Models\Service;
use App\Models\User;

class ServicePolicy
{
    public function viewAny(User $user)
    {
        return $user->isCustomer();
    }

    public function viewAnyDashboard(User $user)
    {
        return $user->isProvider() || $user->isAdmin();
    }

    public function view(User $user, Service $service)
    {
        return $user->isAdmin() || $user->id == $service->provider_id;
    }

    public function create(User $user)
    {
        return $user->isProvider() || $user->isAdmin();
    }

    public function update(User $user, Service $service)
    {
        return $user->isAdmin()
            || ($user->isProvider() && $service->provider_id === $user->id);
    }

    public function delete(User $user, Service $service)
    {
        return $this->update($user, $service);
    }

    public function restore(User $user)
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user)
    {
        return $user->isAdmin();
    }
}
