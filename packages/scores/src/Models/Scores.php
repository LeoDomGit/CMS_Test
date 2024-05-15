<?php

namespace Leo\Scores;

use Illuminate\Database\Eloquent\Model;

class Scores extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idUser','score'
    ];
}