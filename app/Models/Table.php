<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = ['num', 'description', 'max_guests'];

    public function guests()
    {
        return $this->hasMany(GuestList::class, 'id_table');
    }
}

