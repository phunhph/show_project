<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_users extends Model
{
    use HasFactory;
    protected $fillable = ['projects_id','author_id'];
    public function users()
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }
}
