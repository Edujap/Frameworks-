<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class word_has_significance extends Model
{
    protected  $table ='word_has_significance';
    protected  $primaryKey ='id';
    protected  $fillable = ['id', 'word_id',  'meaning_id'];


}
