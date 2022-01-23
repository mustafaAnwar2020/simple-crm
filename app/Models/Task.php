<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','description','user_id','project_id','deadline','status'];
    protected $table = ['tasks'];
    public CONST status = ['open','blocked','in progress','pending','cancelled','completed'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
}
