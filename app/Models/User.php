<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class User extends Authenticatable implements MustVerifyEmailContract
{
//    加载使用 MustVerifyEmail trait，打开 vendor/laravel/framework/src/Illuminate/Auth/MustVerifyEmail.php 文件，可以看到以下三个方法：
//
//    hasVerifiedEmail() 检测用户 Email 是否已认证；
//    markEmailAsVerified() 将用户标示为已认证；
//    sendEmailVerificationNotification() 发送 Email 认证的消息通知，触发邮件的发送。
//    得益于 PHP 的 trait 功能，User 模型在 use 以后，即可使用以上三个方法。
    use Notifiable, MustVerifyEmailTrait;

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
}
