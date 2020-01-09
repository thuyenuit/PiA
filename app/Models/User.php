<?php

namespace App\Models;

use App\Mail\SimpleEmailSender;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $reset_password_url = url(route('password.reset', $token, false));
        $params = array(
            'reset_password_url' => $reset_password_url,
            'name' => $this->name
        );
        $sender = new SimpleEmailSender(__('email.auth.reset.subject'), 'emails.auth.reset', $params, null);
        Mail::to($this->email)->send($sender);
    }

    public function member()
    {
        return $this->hasOne('App\Models\Member');
    }

    public function groups_users()
    {
        return $this->hasMany('App\Models\GroupUser');
    }
}
