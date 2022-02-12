<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductImage;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductImagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productImage can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list productimages');
    }

    /**
     * Determine whether the productImage can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductImage  $model
     * @return mixed
     */
    public function view(User $user, ProductImage $model)
    {
        return $user->hasPermissionTo('view productimages');
    }

    /**
     * Determine whether the productImage can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create productimages');
    }

    /**
     * Determine whether the productImage can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductImage  $model
     * @return mixed
     */
    public function update(User $user, ProductImage $model)
    {
        return $user->hasPermissionTo('update productimages');
    }

    /**
     * Determine whether the productImage can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductImage  $model
     * @return mixed
     */
    public function delete(User $user, ProductImage $model)
    {
        return $user->hasPermissionTo('delete productimages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductImage  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete productimages');
    }

    /**
     * Determine whether the productImage can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductImage  $model
     * @return mixed
     */
    public function restore(User $user, ProductImage $model)
    {
        return false;
    }

    /**
     * Determine whether the productImage can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductImage  $model
     * @return mixed
     */
    public function forceDelete(User $user, ProductImage $model)
    {
        return false;
    }
}
