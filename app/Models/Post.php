<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'image',
        'game_id',
        'user_id'
    ];

    public function post_of_game(){
        return $this->belongsTo('App\Models\Game', 'game_id');
    }
    public function post_by_user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function voted_by(){
        return $this->belongsToMany('App\Models\User', 'vote', 'post_id', 'user_id') ->withPivot('vote_choice');
    }
    public function hascomments(){
        return $this->hasMany('App\Models\Comment');
    }
}
