<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmailContract
{
//    加载使用 MustVerifyEmail trait，打开 vendor/laravel/framework/src/Illuminate/Auth/MustVerifyEmail.php 文件，可以看到以下三个方法：
//
//    hasVerifiedEmail() 检测用户 Email 是否已认证；
//    markEmailAsVerified() 将用户标示为已认证；
//    sendEmailVerificationNotification() 发送 Email 认证的消息通知，触发邮件的发送。
//    得益于 PHP 的 trait 功能，User 模型在 use 以后，即可使用以上三个方法。
    use MustVerifyEmailTrait;

    use Notifiable {
        notify as protected laravelNotify;
    }
    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }

        // 只有数据库类型通知才需提醒，直接发送 Email 或者其他的都 Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }


    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
