<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passphrase extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'passphrase', 'created_at', 'updated_at'];
}
