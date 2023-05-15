<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = ['message', 'contact_id', 'user_id', 'read'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
