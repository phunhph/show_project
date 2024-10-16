<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technical_projects extends Model
{
    use HasFactory;
    protected $fillable = ['projects_id', 'technicals_id'];

    public function technical()
    {
        return $this->hasOne(technicals::class, 'id', 'technicals_id');
    }
}
