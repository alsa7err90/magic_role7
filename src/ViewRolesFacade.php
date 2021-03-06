<?php
namespace alsa7err90\magic_roles;

use Illuminate\Support\Facades\Facade;

class ViewRolesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ViewRoles';
    }
}
