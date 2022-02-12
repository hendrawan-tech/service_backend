<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Timeline;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimelinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the timeline can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list timelines');
    }

    /**
     * Determine whether the timeline can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Timeline  $model
     * @return mixed
     */
    public function view(User $user, Timeline $model)
    {
        return $user->hasPermissionTo('view timelines');
    }

    /**
     * Determine whether the timeline can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create timelines');
    }

    /**
     * Determine whether the timeline can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Timeline  $model
     * @return mixed
     */
    public function update(User $user, Timeline $model)
    {
        return $user->hasPermissionTo('update timelines');
    }

    /**
     * Determine whether the timeline can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Timeline  $model
     * @return mixed
     */
    public function delete(User $user, Timeline $model)
    {
        return $user->hasPermissionTo('delete timelines');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Timeline  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete timelines');
    }

    /**
     * Determine whether the timeline can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Timeline  $model
     * @return mixed
     */
    public function restore(User $user, Timeline $model)
    {
        return false;
    }

    /**
     * Determine whether the timeline can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Timeline  $model
     * @return mixed
     */
    public function forceDelete(User $user, Timeline $model)
    {
        return false;
    }
}
