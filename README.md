# Gaggle

Gaggle is an overly simplistic, insecure, and very feature-incomplete email
library for creating a raw email messages.

# Usage

You're best bet is to check the tests/examples to see usage, as I'm awful at
documentation. In all honesty, you should use a better email lib for anything
you want to take seriously.

# Installation

Install the [Packagist archive](https://packagist.org/packages/henderjon/gaggle)
using [Composer](http://getcomposer.org/). I will *generally* respect
[Semantic Versioning](http://semver.org/). Learn about how Composer
does [versions](https://getcomposer.org/doc/01-basic-usage.md#package-versions).

*Note the absense of v1.0*

```
{
	"require" : {
		"henderjon/gaggle": "dev-master"
	}
}
```

# License

See LICENSE.md for the [BSD-3-Clause](http://opensource.org/licenses/BSD-3-Clause) license.

# TODO

There is no security or safety features of any kind. These might not be a bad idea to add.

There are no transport layers. I built this to be used with AWS SES::SendRawEmail(). Someday
when I have time, I might try to build this out enough to use a different protocol (e.g. SMTP).

[![Build Status](https://travis-ci.org/henderjon/gaggle.svg?branch=master)](https://travis-ci.org/henderjon/gaggle)



