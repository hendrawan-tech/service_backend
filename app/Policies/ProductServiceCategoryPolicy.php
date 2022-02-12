<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductServiceCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductServiceCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productServiceCategory can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list productservicecategories');
    }

    /**
     * Determine whether the productServiceCategory can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductServiceCategory  $model
     * @return mixed
     */
    public function view(User $user, ProductServiceCategory $model)
    {
        return $user->hasPermissionTo('view productservicecategories');
    }

    /**
     * Determine whether the productServiceCategory can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create productservicecategories');
    }

    /**
     * Determine whether the productServiceCategory can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductServiceCategory  $model
     * @return mixed
     */
    public function update(User $user, ProductServiceCategory $model)
    {
        return $user->hasPermissionTo('update productservicecategories');
    }

    /**
     * Determine whether the productServiceCategory can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductServiceCategory  $model
     * @return mixed
     */
    public function delete(User $user, ProductServiceCategory $model)
    {
        return $user->hasPermissionTo('delete productservicecategories');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductServiceCategory  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete productservicecategories');
    }

    /**
     * Determine whether the productServiceCategory can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductServiceCategory  $model
     * @return mixed
     */
    public function restore(User $user, ProductServiceCategory $model)
    {
        return false;
    }

    /**
     * Determine whether the productServiceCategory can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ProductServiceCategory  $model
     * @return mixed
     */
    public function forceDelete(User $user, ProductServiceCategory $model)
    {
        return false;
    }
}
