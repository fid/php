<?php
namespace Fid\Tests\Php;

use Fid\Php\Definitions\Location;
use Fid\Php\Definitions\SystemIndicator;
use Fid\Php\Exceptions\FidGenerateException;
use Fid\Php\Fid;

class FidTest extends \PHPUnit_Framework_TestCase
{
  public function testGenerate()
  {
    $found = [];
    $limit = 1000;
    for($x = 0; $x <= 10; $x++)
    {
      //$start = microtime(true);
      for($i = 0; $i < $limit; $i++)
      {
        $found[] = Fid::generate('ABC', 'CD', 'EF');
      }
      //$finish = microtime(true);
      //echo round((($finish - $start) * 1000) / $limit, 4) . "ms per FID\n";
    }
    $generated = count($found);
    $this->assertEquals($generated, $limit * $x);

    $unique = count(array_unique($found));

    $this->assertLessThan(1, $generated - $unique);
  }

  public function testVendor()
  {
    $this->expectException(FidGenerateException::class);
    Fid::generate('AC', '', '');
  }

  public function testApp()
  {
    $this->expectException(FidGenerateException::class);
    Fid::generate('ACD', 'W', '');
  }

  public function testType()
  {
    $this->expectException(FidGenerateException::class);
    Fid::generate('ACD', 'WW', 'D');
  }

  public function testIndicator()
  {
    $this->expectException(FidGenerateException::class);
    Fid::generate('ACD', 'WW', 'DD', 'H');
  }

  public function testLocation()
  {
    $this->expectException(FidGenerateException::class);
    Fid::generate('ACD', 'WW', 'DD', SystemIndicator::ENTITY, null, 'USC1');
  }

  public function testVerify()
  {
    $secretFid = Fid::generate(
      'ABC',
      'DE',
      'FG',
      SystemIndicator::ENTITY,
      'TESTING123'
    );
    $this->assertTrue(Fid::verify($secretFid, 'TESTING123'));

    $wrongSecret = 0;
    $wrongSecret += Fid::verify($secretFid, 'TESTING433') ? 1 : 0;
    $wrongSecret += Fid::verify($secretFid, 'TESTf/erh') ? 1 : 0;
    $wrongSecret += Fid::verify($secretFid, 'Twefghrh') ? 1 : 0;

    $this->assertLessThan(2, $wrongSecret);

    $limit = 10000;
    for($i = 0; $i < $limit; $i++)
    {
      $this->assertTrue(Fid::verify(Fid::generate('ABC', 'DE', 'FG')));
    }
  }

  public function testDescribe()
  {
    $vendor = 'ABR';
    $app = 'BT';
    $type = 'FH';
    $indicator = SystemIndicator::CONFIGURATION;
    $location = Location::US_CENTRAL1_B;

    $time = time();
    $fid = Fid::generate($vendor, $app, $type, $indicator, null, $location);

    $describe = Fid::describe($fid);

    $this->assertEquals($vendor, $describe->getVendor());
    $this->assertEquals($app, $describe->getApp());
    $this->assertEquals($type, $describe->getType());
    $this->assertEquals($indicator, $describe->getIndicator());
    $this->assertEquals($location, $describe->getLocation());
    $this->assertTrue(strlen($describe->getTimeKey()) == 9);
    $this->assertTrue(strlen($describe->getRandom()) == 7);
    $this->assertTrue(($describe->getTimestampMs() / 1000) > ($time - 10));
    $this->assertTrue(($describe->getTimestampMs() / 1000) < ($time + 10));
    $this->assertTrue($describe->getTimestamp() > ($time - 10));
    $this->assertTrue($describe->getTimestamp() < ($time + 10));
  }
}
