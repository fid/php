<?php
namespace Fid\Tests\Php\Definitions;

use Fid\Php\Definitions\Location;

class LocationTest extends \PHPUnit_Framework_TestCase
{
  public function testValidate()
  {
    $this->assertTrue(Location::validate(Location::US_CENTRAL1_B, true));
    $this->assertTrue(Location::validate(Location::US_CENTRAL1_B, false));
    $this->assertTrue(Location::validate('AKDBF', false));
    $this->assertTrue(Location::validate(Location::US_CENTRAL1_B, false));
    $this->assertFalse(Location::validate('USBC1', true));
  }
}
