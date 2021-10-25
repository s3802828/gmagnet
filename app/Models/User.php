<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $incrementing = false;
    protected $fillable = [
        'id',
        'username',
        'name',
        'gender',
        'dob',
        'password',
        'location',
        'avatar',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    public function gameJoined(){
        return $this-> belongsToMany('App\Models\Game','user_game', 'user_id', 'game_id');
    }
    public function vote_post(){
        return $this->belongsToMany('App\Models\Post', 'vote', 'user_id', 'post_id') ->withPivot('vote_choice');
    }
    public function has_comment(){
        return $this->hasMany('App\Models\Comment');
    }
    public function has_post(){
        return $this->hasMany('App\Models\Post');
    }
    public function rate_game(){
        return $this->belongsToMany('App\Models\Game', 'rate', 'user_id', 'game_id')->withPivot('value','rate_comment');
    }
    public function admin_of(){
        return $this->hasMany('App\Models\Game', 'admin');
    }
}
