<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billed extends Model
{
    use HasFactory;
    protected $fillable = [
        'billed',
        'paid',
        'billing_date',
    ];

    //record link user
    public function user()
    {
        return $this->belongTo(User::class);
    }

    //record link post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
