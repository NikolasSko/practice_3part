<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [

            'lastname',
            'firstname',
            'patronymic',
            'gender',
            'age',
            'place',
            'job',
            'img',
    ];

}
