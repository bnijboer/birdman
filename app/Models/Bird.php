<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bird extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function colors() {
        return $this->belongsToMany(Color::class);
    }
    
    public function shapes() {
        return $this->belongsToMany(Shape::class);
    }
    
    public function habitats() {
        return $this->belongsToMany(Habitat::class);
    }
}
