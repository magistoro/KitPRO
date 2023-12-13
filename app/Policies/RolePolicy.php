<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{

    // public function view(User $user)
    // {
    //     if (!$user) {
    //         // User is not logged in, show button for non-logged in users
    //         return view('buttons.non_logged_in');
    //     }
        
    //     if ($user->role === 'admin' || $user->role === 'manager') {
    //         // User is logged in as admin or manager, show button for admin/manager users
    //         return view('buttons.admin_manager');
    //     }
    
    //     // User is logged in as a regular user, show button for regular users
    //     return view('buttons.regular_user');
    // }
    







    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function UserView(User $user, User $model): bool
    {
        // return  ($model->role_id === Role::getUserRoleID()) ;
        return $model->role_id === Role::getUserRoleID();
    }

    public function AdminView(User $user, User $model): bool
    {
        return $model->role_id === Role::getAdminRoleID();
    }

    public function ManagerView(User $user, User $model): bool
    {
        return $model->role_id === Role::getManagerRoleID();
    }
}
