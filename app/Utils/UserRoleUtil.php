<?php
namespace App\Utils;

use App\Helpers\ApplicationConstant;

class UserRoleUtil
{
  public static function getMyRoles()
  {
    return \Auth::guard('web')->user()->placePics;
  }
  
  public static function isOrganizationAdmin()
  {
    $roles = \Auth::guard('web')->user()->placePics;
    $myPlace = \Auth::guard('web')->user()->place;
    if($roles->isEmpty())
      return false;
    $myRole = $roles[0];
    if($myRole->role != "organization_admin")
      return false;

    return $myRole;
  }

  public static function isAreaAdmin()
  {
    $roles = \Auth::guard('web')->user()->placePics;
    $myPlace = \Auth::guard('web')->user()->place;
    if($roles->isEmpty())
      return false;
    $myRole = $roles[0];
    if($myRole->role != "sekda")
      return false;

    return $myRole;
  }
  
  public static function isSekda()
  {
    $roles = \Auth::guard('web')->user()->placePics;
    $myPlace = \Auth::guard('web')->user()->place;
    if($roles->isEmpty())
      return false;
    $myRole = $roles[0];
    if($myRole->role != "sekcet")
      return false;

    return $myRole;
  }
  
  public static function isNoRole()
  {
    $roles = \Auth::guard('web')->user()->placePics;
      
    return count($roles) == 0;
  }
}