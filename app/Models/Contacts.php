<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Contacts extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $fillable = [
        'user_id',
        'contact_id'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'contact_id');
    }
}
