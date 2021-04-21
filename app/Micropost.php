<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    //
    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function favoriter()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'microposts_id', 'user_id')->withTimestamps();
    }
    
    public function loadfavoriteCounts()
    {
        $this->loadCount(['favoritings', 'favoriters']);
    }
}
