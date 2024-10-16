<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_domains extends Model
{
    use HasFactory;
    protected $fillable = ['projects_id', 'domains_id'];

    public function domain()
    {
        return $this->hasOne(domains::class, 'id', 'domains_id');
    }


    public function project()
    {
        return $this->hasMany(projects::class, 'id', 'projects_id');
    }
}
