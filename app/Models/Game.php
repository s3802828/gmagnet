<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'ageLimit',
        'description',
        'logo',
        'banner',
        'admin'
    ];

    public function gametags(){
        return $this->belongsToMany('App\Models\Tag', 'game_tag', 'game_id', 'tag_id');
    }
    public function admin(){
        return $this->belongsTo('App\Models\User', 'admin');
    }
    public function rated_by(){
        return $this->belongsToMany('App\Models\User', 'rate', 'game_id', 'user_id')->withPivot('value','rate_comment','created_at');
    }
    public function members(){
        return $this->belongsToMany('App\Models\User', 'user_game', 'game_id', 'user_id');
    }
    public function gameposts(){
        return $this->hasMany('App\Models\Post');
    }
}
