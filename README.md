## PHP ISAN Number Validator

This piece of poorly written code may help you with validating and formatting ISAN Number. Or may not. I don't know, I'm a plumber, not a fortune-teller.

#### License:

> Copyright © 2016 github.com/WRonX  
This work is free. You can redistribute it and/or modify it under the terms of the Do What The Fuck You Want To Public License, Version 2, as published by Sam Hocevar. See http://www.wtfpl.net/ for more details.

#### Features:

* validating ISAN Number
* formatting ISAN Number
* ...
* PROFIT

#### Installation and configuration:

Just put it somewhere, OK?


#### Usage

Seriously...? OK, OK...

##### Validating ISAN Number
```php
use WRonX\IsanNumberValidator\IsanNumberValidator;
// ...
$isanNumber = '0000000160aa0004W00000000f';
$isNumberValid = IsanNumberValidator::validate($isanNumber);
```

##### Formatting ISAN Number
```php
use WRonX\IsanNumberValidator\IsanNumberValidator;
// ...
$isanNumber = '0000000160aa0004W00000000f';
$formattedIsanNumber = IsanNumberValidator::format($isanNumber);
```

#### Summary
Oh, come on, I spent enough time writing readme already...