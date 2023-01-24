<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StringStorage extends Model
{
    use HasFactory;

    protected $fillable = ['inputed_string', 'language'];

}
