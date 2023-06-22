<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "description",
        "img"
    ];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }

    public function getFood(){
        $food = Food::where('id', $id)->get();
    }
}
