<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class synonymous extends  Model
{

    protected  $table ='sinonimo';
    protected  $primaryKey ='id';
    protected  $fillable = ['id', 'description'];
}
