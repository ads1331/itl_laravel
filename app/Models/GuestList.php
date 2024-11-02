<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestList extends Model
{
    use HasFactory;

    protected $fillable = ['id_guest', 'id_table', 'is_present'];

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'id_guest');
    }

    public function table()
    {
        return $this->belongsTo(Table::class, 'id_table');
    }
}

