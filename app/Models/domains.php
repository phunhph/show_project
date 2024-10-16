<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class domains extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','is_active', 'created_at','updated_at'];

    public function projects()
    {
        return $this->belongsToMany(projects::class, 'project_domains', 'domains_id', 'projects_id');
    }
}
