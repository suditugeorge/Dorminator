<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class UserAdmin extends Model
{
	public $timestamps = false;
    protected $table = 'user_admin';
    protected $primaryKey = 'user_type_id';

}