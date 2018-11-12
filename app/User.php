<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * 获取粉丝
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follower()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower');
    }

    /**
     * 获取粉丝关注的用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower', 'user_id');
    }

    /**
     * 判断该用是否是我的粉丝
     * @param $uid
     * @return mixed
     */
    public function isFollow($uid)
    {
        return $this->follower()->wherePivot('follower', $uid)->first();
    }

    /**
     * 关注或取消关注
     * @param $ids
     * @return array
     */
    public function followToggle($ids)
    {
        $ids = is_array($ids) ? : [$ids];
        return $this->follower()->toggle($ids);
    }
}
