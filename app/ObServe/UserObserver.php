<?php
/**
 *
 * ============================================================================
 * @Version: 1.0
 * @Author: weimingliang
 * @Date: 2018/11/2
 * @Time: 15:12
 */

namespace App\ObServe;


use App\User;

class UserObserver
{
    public function creating(User $user)
    {
        $user->email_token = str_random(10);
        $user->email_active = false;
    }
}