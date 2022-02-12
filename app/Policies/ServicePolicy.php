<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the service can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list services');
    }

    /**
     * Determine whether the service can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Service  $model
     * @return mixed
     */
    public function view(User $user, Service $model)
    {
        return $user->hasPermissionTo('view services');
    }

    /**
     * Determine whether the service can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create services');
    }

    /**
     * Determine whether the service can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Service  $model
     * @return mixed
     */
    public function update(User $user, Service $model)
    {
        return $user->hasPermissionTo('update services');
    }

    /**
     * Determine whether the service can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Service  $model
     * @return mixed
     */
    public function delete(User $user, Service $model)
    {
        return $user->hasPermissionTo('delete services');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Service  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete services');
    }

    /**
     * Determine whether the service can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Service  $model
     * @return mixed
     */
    public function restore(User $user, Service $model)
    {
        return false;
    }

    /**
     * Determine whether the service can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Service  $model
     * @return mixed
     */
    public function forceDelete(User $user, Service $model)
    {
        return false;
    }
}
