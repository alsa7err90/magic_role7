<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magrole extends Model
{
    protected $fillable = ['name','slug'];
    public function magpermissions()
    {
        return $this->belongsToMany(Magpermission::class);
    }

    public function magsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function hasPermission( ... $Permissions )
    {
        foreach ($Permissions as $Permission)
        {
            if ($this->magpermissions->contains('slug', $Permission))
            {
                return true;
            }
        }
        return false;
    } // end hasPermission

}
