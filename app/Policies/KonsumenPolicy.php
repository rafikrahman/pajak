<?php

namespace App\Policies;

use App\Models\Konsumen;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KonsumenPolicy
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
    public function view(User $user, Konsumen $konsumen): bool
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
    public function update(User $user, Konsumen $konsumen): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Konsumen $konsumen): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Konsumen $konsumen): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Konsumen $konsumen): bool
    {
        return $user->hasRole(['super_admin', 'admin', 'pbbkb']);
    }
}
