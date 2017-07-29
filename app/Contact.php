<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $fillable = [
		'name',
		'gender',
		'code',
		'company',
		'title',
		'mobile',
		'tel',
		'fax',
		'mail',
		'im',
		'address',
    	'remark'
    ];

    protected $primaryKey = "id";
}
