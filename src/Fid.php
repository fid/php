<?php
namespace Fid\Php;

use Fid\Php\Definitions\Location;
use Fid\Php\Definitions\SystemIndicator;
use Fid\Php\Exceptions\FidGenerateException;
use Fid\Php\Helpers\Base36TimeKey;

class Fid
{
  /**
   * Generate a new FID
   *
   * @param string $vendor Vendor Key
   * @param string $type
   * @param string $subType
   * @param string $indicator
   * @param null   $secret
   * @param string $location
   *
   * @throws FidGenerateException
   *
   * @return string FID
   */
  public static function generate(
    $vendor, $type, $subType, $indicator = SystemIndicator::ENTITY,
    $secret = null, $location = Location::UNKNOWN_REGION
  )
  {
    if(strlen($vendor) !== 3)
    {
      throw new FidGenerateException("Vendor Key must be 3 characters");
    }

    if(strlen($type) !== 2)
    {
      throw new FidGenerateException("FID Type must be 2 characters");
    }

    if(strlen($subType) !== 2)
    {
      throw new FidGenerateException("FID Sub Type must be 2 characters");
    }

    if(!SystemIndicator::validate($indicator))
    {
      throw new FidGenerateException("Invalid System Indicator");
    }

    if(!Location::validate($location))
    {
      throw new FidGenerateException("Invalid Data Location");
    }

    $random = '';
    $randCount = $secret === null ? 7 : 6;
    for($i = 0; $i < $randCount; $i++)
    {
      $random .= static::randomCharacter();
    }

    $fid = sprintf(
      "%s%s%s%s-%s-%s-%s",
      $indicator,
      $vendor,
      $type,
      $subType,
      Base36TimeKey::generate(),
      $location,
      $random
    );

    if($secret !== null)
    {
      $fid .= strtoupper(substr(md5($secret . $fid), 0, 1));
    }

    return $fid;
  }

  private static function randomCharacter()
  {
    return rand(1, 2) == 1 ? chr(rand(65, 90)) : rand(0, 9);
  }

  /**
   * Verify a FID
   *
   * @param      $fid
   * @param null $secret
   *
   * @return bool
   */
  public static function verify($fid, $secret = null)
  {
    $fid = strtoupper($fid);
    $verified = false;
    if(preg_match(
      "/[A-Z0-9=]{8}-[A-Z0-9=]{9}-[A-Z0-9=]{5}-[A-Z0-9=]{7}/",
      $fid
    ))
    {
      if($secret === null)
      {
        $verified = true;
      }
      else
      {
        $checksum = md5($secret . substr($fid, 0, -1));
        $checkone = strtoupper(substr($checksum, 0, 1));
        $verified = substr($fid, -1) == $checkone;
      }
    }
    return $verified;
  }

  /**
   * @param $fid
   *
   * @return FidDescription
   */
  public static function describe($fid)
  {
    return new FidDescription($fid);
  }
}
