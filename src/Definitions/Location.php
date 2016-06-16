<?php
namespace Fid\Php\Definitions;

class Location
{
  const MULTI_REGION = 'MULTI';
  const UNKNOWN_REGION = 'MISCR';

  /** Google Zones */
  const US_CENTRAL1_A = 'USC1A';
  const US_CENTRAL1_B = 'USC1B';
  const US_CENTRAL1_C = 'USC1C';
  const US_CENTRAL1_F = 'USC1F';

  const US_EAST1_B = 'USE1B';
  const US_EAST1_C = 'USE1C';
  const US_EAST1_D = 'USE1D';

  const ASIA_EAST1_A = 'ASE1A';
  const ASIA_EAST1_B = 'ASE1B';
  const ASIA_EAST1_C = 'ASE1C';

  const EUROPE_WEST1_B = 'EUW1B';
  const EUROPE_WEST1_C = 'EUW1C';
  const EUROPE_WEST1_D = 'EUW1D';

  /** AWS Zones */

  const US_EAST_1 = 'USEA1';
  const US_WEST_1 = 'USWE1';
  const US_WEST_2 = 'USWE2';

  const EU_WEST_1 = 'EUWE1';
  const EU_CENTRAL_1 = 'EUCE1';

  const AP_SOUTHEAST_1 = 'APSE1';
  const AP_SOUTHEAST_2 = 'APSE2';
  const AP_NORTHEAST_1 = 'APNE1';
  const AP_NORTHEAST_2 = 'APNE2';

  const SA_EAST_1 = 'SAEA1';

  public static function validate($location, $strict = false)
  {
    return strlen($location) === 5 && (!$strict || in_array(
        $location,
        [
          static::MULTI_REGION,
          static::UNKNOWN_REGION,
          static::US_CENTRAL1_A,
          static::US_CENTRAL1_B,
          static::US_CENTRAL1_C,
          static::US_CENTRAL1_F,
          static::US_EAST1_B,
          static::US_EAST1_C,
          static::US_EAST1_D,
          static::ASIA_EAST1_A,
          static::ASIA_EAST1_B,
          static::ASIA_EAST1_C,
          static::EUROPE_WEST1_B,
          static::EUROPE_WEST1_C,
          static::EUROPE_WEST1_D,
          static::US_EAST_1,
          static::US_WEST_1,
          static::US_WEST_2,
          static::EU_WEST_1,
          static::EU_CENTRAL_1,
          static::AP_SOUTHEAST_1,
          static::AP_SOUTHEAST_2,
          static::AP_NORTHEAST_1,
          static::AP_NORTHEAST_2,
          static::SA_EAST_1,
        ]
      ));
  }
}
