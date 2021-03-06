<?php
namespace alsa7err90\magic_role7;

use App\Magrole;
use App\User;
use Illuminate\Support\Facades\Auth;
// use Auth;
class ViewRoles
{
    public static function test(){
        echo "Wonderful that it works successfully";
    }

    public function has_role(){
        $name_role = Auth::user()->roles[0]->name;
        return $name_role;
    }

    public function is_has_role($mag_role) :bool
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return ($user->hasRole($mag_role)) ?? false;
    }

    public function is_has_permission($mag_permission) :bool
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        foreach ($user->roles as $role){
           $id_role = $role->id  ;
        }
        $mag_role = Magrole::findOrFail($id_role);
        return ($mag_role->hasPermission($mag_permission)) ?? false;
    }

}
