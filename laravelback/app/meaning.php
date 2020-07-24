<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
class meaning extends  Model
{
    protected  $table ='meaning';
    protected  $primaryKey ='id';
    protected  $fillable = ['id', 'meaning_text'];
}
