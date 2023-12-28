<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'address', 'phone'];

    public function menus(){
        return $this->hasMany(Menu::class);
    }

}
