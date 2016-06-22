<?php
namespace Fid\Php;

use Fid\Php\Helpers\Base36TimeKey;

class FidDescription
{
  private $indicator;
  private $vendor;
  private $app;
  private $type;
  private $location;
  private $timeKey;
  private $random;
  private $verify;
  private $timestamp;
  private $timestampMs;

  public function __construct($fid)
  {
    $fid = strtoupper($fid);
    $this->timeKey = substr($fid, 9, 9);
    $this->indicator = substr($fid, 0, 1);
    $this->vendor = substr($fid, 1, 3);
    $this->app = substr($fid, 4, 2);
    $this->type = substr($fid, 6, 2);
    $this->location = substr($fid, 19, 5);
    $this->random = substr($fid, 25, 7);
    $this->verify = substr($fid, 31, 1);

    $ts = Base36TimeKey::getMsTime($this->timeKey);
    $this->timestampMs = $ts * 1000;
    $this->timestamp = floor($ts);
  }

  /**
   * @return mixed
   */
  public function getIndicator()
  {
    return $this->indicator;
  }

  /**
   * @return mixed
   */
  public function getVendor()
  {
    return $this->vendor;
  }

  /**
   * @return mixed
   */
  public function getApp()
  {
    return $this->app;
  }

  /**
   * @return mixed
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * @return mixed
   */
  public function getLocation()
  {
    return $this->location;
  }

  /**
   * @return mixed
   */
  public function getTimeKey()
  {
    return $this->timeKey;
  }

  /**
   * @return mixed
   */
  public function getRandom()
  {
    return $this->random;
  }

  /**
   * @return mixed
   */
  public function getTimestamp()
  {
    return $this->timestamp;
  }

  /**
   * @return mixed
   */
  public function getTimestampMs()
  {
    return $this->timestampMs;
  }

}
