<?php
namespace Fid\Php\Helpers;

class Base36TimeKey
{
  public static function generate($time = null)
  {
    if($time === null)
    {
      $time = microtime(true);
    }

    if($time < 100000000000)
    {
      if(floor((string)$time) !== ceil((string)$time))
      {
        list($ts, $ms) = explode('.', (string)$time);
        $time = $ts . substr(str_pad($ms, 3, '0', STR_PAD_RIGHT), 0, 3);
      }
      else
      {
        $time .= mt_rand(100, 999);
      }
    }

    $time = floor($time);

    $return = base_convert(str_pad($time, 13, '0', STR_PAD_LEFT), 10, 36);
    return str_pad(strtoupper($return), 9, '0', STR_PAD_LEFT);
  }

  public static function getMsTime($timeKey)
  {
    $time = base_convert(rtrim($timeKey, '='), 36, 10);
    return substr_replace($time, '.', -3, 0);
  }
}
