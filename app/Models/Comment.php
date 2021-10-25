<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $primaryKey ='id';

    protected $fillable = [
        'post_id',
        'user_id',
        'comment_text'
    ];

    public function comment_of_post(){
        return $this-> belongsTo('App\Models\Post', 'post_id');
    }
    public function comment_by_user(){
        return $this-> belongsTo('App\Models\User', 'user_id');
    }
}
