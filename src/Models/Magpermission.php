<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magpermission extends Model
{
    protected $fillable = ['name','slug'];
    public function magroles()
    {
        return $this->belongsToMany(Magrole::class);
    }



}
