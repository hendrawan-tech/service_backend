<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Orderitems;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderitemsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the orderitems can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list allorderitems');
    }

    /**
     * Determine whether the orderitems can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orderitems  $model
     * @return mixed
     */
    public function view(User $user, Orderitems $model)
    {
        return $user->hasPermissionTo('view allorderitems');
    }

    /**
     * Determine whether the orderitems can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create allorderitems');
    }

    /**
     * Determine whether the orderitems can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orderitems  $model
     * @return mixed
     */
    public function update(User $user, Orderitems $model)
    {
        return $user->hasPermissionTo('update allorderitems');
    }

    /**
     * Determine whether the orderitems can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orderitems  $model
     * @return mixed
     */
    public function delete(User $user, Orderitems $model)
    {
        return $user->hasPermissionTo('delete allorderitems');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orderitems  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete allorderitems');
    }

    /**
     * Determine whether the orderitems can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orderitems  $model
     * @return mixed
     */
    public function restore(User $user, Orderitems $model)
    {
        return false;
    }

    /**
     * Determine whether the orderitems can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Orderitems  $model
     * @return mixed
     */
    public function forceDelete(User $user, Orderitems $model)
    {
        return false;
    }
}
