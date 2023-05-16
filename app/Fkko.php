<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Fkko extends Model
{
    use HasFactory;
    //use SoftDeletes;
    protected $table = 'fkko';
    protected $guarded = false;
    //protected $fillable = ['block', 'code', 'name'];
}
