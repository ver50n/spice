<?php
namespace App\Utils;

use App\Helpers\ApplicationConstant;
use App\Utils\StringUtil;

class PatternCodeUtil
{
  public static function generate($pattern, $latestIncrement = null)
  {
    $pattern = StringUtil::replacePhpFunction($pattern);
    preg_match_all("/\|([^\]]*)\|/", $pattern, $matches);

    if($latestIncrement !== null) {
      $len =  $matches[1];
      $increment = str_pad(strval($latestIncrement), $len[0], "0", STR_PAD_LEFT);
      $pattern = str_replace($matches[0], $increment, $pattern);
    }

    return $pattern;
  }

  public static function increase($serviceId, $latestIncrement)
  {
    $service = \App\Models\Service::find($serviceId);
    $service->latest_increment = $latestIncrement;
    $service->save();
  }

  

  public static function dailyReset()
  {
    \App\Models\Service::update(['latest_increment' => 0]);
  }

}