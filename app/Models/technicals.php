<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class technicals extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name', 'created_at','updated_at'];
}
