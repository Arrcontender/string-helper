<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StringStorage extends Model
{
    use HasFactory;

    public function getCheckedString()
    {
        return $this->hasOne('App\Models\CheckedStringStorage');
    }
}
