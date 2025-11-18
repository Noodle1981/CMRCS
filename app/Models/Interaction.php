<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'type', 'notes', 'interactable_id', 'interactable_type'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function interactable() {
        return $this->morphTo();
    }
}
