<?php
namespace Fid\Tests\Php\Helpers;

use Fid\Php\Helpers\Base36TimeKey;

class Base36TimeKeyTest extends \PHPUnit_Framework_TestCase
{
  public function testGenerate()
  {
    Base36TimeKey::generate(123456789);
    Base36TimeKey::generate(microtime(true));
    Base36TimeKey::generate();
    for($x = 0; $x < 10; $x++)
    {
      $found = [];
      $limit = 100;
      for($i = 0; $i < $limit; $i++)
      {
        $found[] = Base36TimeKey::generate() . "\n";
        usleep(1000);
      }
      $generated = count($found);
      $unique = count(array_unique($found));

      $this->assertLessThan(1, $generated - $unique);
    }
  }

  public function testTimestamp()
  {
    $key = Base36TimeKey::generate(123456789);
    $this->assertEquals(123456789, floor(Base36TimeKey::getMsTime($key)));

    for($x = 0; $x < 10; $x++)
    {
      $limit = 7000;
      for($i = 0; $i < $limit; $i++)
      {
        $microtime = microtime(true);
        $key = Base36TimeKey::generate($microtime);
        $this->assertEquals(
          floor((string)$microtime),
          floor((string)Base36TimeKey::getMsTime($key))
        );
      }
    }
  }
}
