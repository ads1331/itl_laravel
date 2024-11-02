<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_present'];

    public function guestLists()
    {
        return $this->hasMany(GuestList::class, 'id_guest');
    }
}