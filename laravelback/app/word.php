<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class word extends  Model
{
    protected  $table ='word';
    protected  $primaryKey ='id';
    protected  $fillable = ['id', 'word_text',  'tech_term','firs_letter'];



}
