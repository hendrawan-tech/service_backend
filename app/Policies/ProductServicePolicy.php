<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductService;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductServicePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productService can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list productservices');
    }

    /**
     * Determine whether the productService can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductService  $model
     * @return mixed
     */
    public function view(User $user, ProductService $model)
    {
        return $user->hasPermissionTo('view productservices');
    }

    /**
     * Determine whether the productService can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create productservices');
    }

    /**
     * Determine whether the productService can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductService  $model
     * @return mixed
     */
    public function update(User $user, ProductService $model)
    {
        return $user->hasPermissionTo('update productservices');
    }

    /**
     * Determine whether the productService can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductService  $model
     * @return mixed
     */
    public function delete(User $user, ProductService $model)
    {
        return $user->hasPermissionTo('delete productservices');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductService  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete productservices');
    }

    /**
     * Determine whether the productService can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductService  $model
     * @return mixed
     */
    public function restore(User $user, ProductService $model)
    {
        return false;
    }

    /**
     * Determine whether the productService can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductService  $model
     * @return mixed
     */
    public function forceDelete(User $user, ProductService $model)
    {
        return false;
    }
}
