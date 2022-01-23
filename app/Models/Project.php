<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','description','user_id','client_id','deadline',
    'status'];


    protected $table = 'projects';


    public const status = ['open','canceled', 'in progress', 'blocked', 'completed'];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
}
