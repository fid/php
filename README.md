# FID Library for PHP

#### Generate

generate($vendorKey, $appKey, $type, $indicator, $vendorSecret, $dataLocation);

```php
Fid::generate('VEN', 'AP', 'MI', SystemIndicator::ENTITY, null, Location::US_CENTRAL1_B);
```

#### Verify

verify($fid, $secret)

```php
Fid::verify("EVENAPMI-IPQOOI74=-USC1B-07I9I9H", "secr3t")
```

#### Describe

describe($fid)

```php
Fid::describe("EVENAPMI-IPQOOI74=-USC1B-07I9I9H")
```

Describe returns a description object (FidDescription)
