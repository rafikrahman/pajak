<?php

namespace App\Policies;

use App\Models\Transportir;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TransportirPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transportir $transportir): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transportir $transportir): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transportir $transportir): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transportir $transportir): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transportir $transportir): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }
}
