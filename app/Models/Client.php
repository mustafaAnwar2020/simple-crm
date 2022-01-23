<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['contact_name','contact_phone','contact_email','company_name','company_address','company_zip',
    'company_vat'];
    protected $table = 'clients';
}
