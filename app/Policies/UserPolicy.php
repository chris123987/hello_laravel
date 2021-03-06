<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $currentUser  默认为当前登录用户实例
     * @param User $user  要进行授权的用户实例
     * @return bool
     */
    public function update(User $currentUser, User $user){
       //当两个 id 相同时，则代表两个用户是相同用户，用户通过授权
        return $currentUser->id ===$user->id;
    }

    public function destroy(User $currentUser,User $user){

        return $currentUser->is_admin && $currentUser->id !==$user->id;
    }

}
