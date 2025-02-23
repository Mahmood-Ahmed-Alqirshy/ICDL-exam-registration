<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = ['name','type'];
    public $timestamps = false;
    use HasFactory;
}
