<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class projects extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','slug','description', 'deploy_link', 'level_id','added_by','views','is_active', 'created_at','updated_at'];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function level(){
        return $this->hasOne(level::class, 'id', 'level_id');
    }

    public function technical(){
        return $this->hasMany(technical_projects::class, 'projects_id', 'id');
    }

    public function domain(){
        return $this->hasOne(project_domains::class, 'projects_id', 'id');
    }

    public function domains(){
        return $this->hasMany(project_domains::class, 'projects_id', 'id');
    }


    public function domains_belong()
    {
        return $this->belongsToMany(domains::class, 'project_domains', 'projects_id', 'domains_id');
    }

    public function images(){
        return $this->hasMany(images::class, 'projects_id', 'id');
    }
}
