<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['content'];

    // 一条微博属于一个用户，采用一对一关联
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
