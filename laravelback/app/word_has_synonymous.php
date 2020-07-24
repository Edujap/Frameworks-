<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class word_has_synonymous extends  Model
{
    protected  $table ='word_has_synonymous';
    protected  $primaryKey ='id';
    protected  $fillable = ['id', 'word_id',  'sinonimo_id'];

}
