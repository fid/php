<?php
namespace Fid\Php\Definitions;

class SystemIndicator
{
  const ENTITY = 'E';
  const LOG = 'L';
  const CACHE = 'C';
  const MEMORY = 'M';
  const META_DATA = 'A';
  const CONFIGURATION = 'F';
  const TIME_SERIES = 'T';
  const RELATIONSHIP = 'R';
  const NOTE = 'N';
  const FILE_DATA = 'D';

  public static function validate($indicator)
  {
    return strlen($indicator) === 1 && in_array(
      $indicator,
      [
        static::ENTITY,
        static::LOG,
        static::CACHE,
        static::MEMORY,
        static::META_DATA,
        static::CONFIGURATION,
        static::TIME_SERIES,
        static::RELATIONSHIP,
        static::NOTE,
        static::FILE_DATA,
      ]
    );
  }
}
