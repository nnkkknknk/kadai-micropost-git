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
        return $this->belongsToMany(User::class, 'favorites', 'microposts_id', 'user_id')->withTimestamps();
    }
    
    public function loadfavoriteCounts()
    {
        $this->loadCount(['favoritings', 'favoriters']);
    }
    
    /**
     * お気に入り機能の実装
     */
    
    /**
     * このユーザが所有する投稿。（ Micropostモデルとの関係を定義）
     */
   

    /**
     * このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
     */
    // public function favoritings()
    // {
    //     return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
    // }

    /**
     * このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）
     

     * return $this->belongsToMany(相手のmodel名, '自分のtable名', '相手のid', '自分のid')->withTimestamps();
     * これで2つのテーブル要素を連結
     */
     
    
    
    
    
    
    /**
     * $userIdで指定されたユーザをフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function favorite($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_favoriting($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->favoritings()->attach($userId);
            return true;
        }
    }

    /**
     * $userIdで指定されたユーザをアンフォローする。
     *
     * @param  int  $userId
     * @return bool
     */
    public function unfavorite($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_favoriting($userId);
        // 対象が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->favoritings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    /**
     * 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
     *
     * @param  int  $userId
     * @return bool
     */
    public function is_favoriting($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->favoritings()->where('micropost_id', $userId)->exists();
    }

    
    

}
