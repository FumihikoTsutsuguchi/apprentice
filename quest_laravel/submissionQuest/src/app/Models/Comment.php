<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body'];

    // 記事とのリレーション
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}
