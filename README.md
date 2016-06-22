# FID Library for PHP

#### Generate

generate($vendorKey,$appKey,$type,(SystemIndicator) $indicator, $vendorSecret, $dataLocation);

```php
Fid::generate('VEN', 'AP', 'MI', SystemIndicator::ENTITY, null, Location::US_CENTRAL1_B);
```

#### Verify

verify($fid, $secret)

```php
Fid::verify("IPIH7MI2=-EABCCDEF-MISCR-V669VFQ", "secr3t")
```

#### Describe

describe($fid)

```php
Fid::describe("IPIH7MI2=-EABCCDEF-MISCR-V669VFQ")
```

Describe returns a description object (FidDescription)
