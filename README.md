# tefps-clients-php

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require tefps/clients-bundle "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new TefpsClientsBundle\TefpsClientsBundle(),
        );

        // ...
    }

    // ...
}
```


TefpsTvClient - Usage
=====================

```php
<?php

use TefpsClientsBundle\Tv\TefpsTvClient;
use TefpsClientsBundle\Auth\OAuth2HttpClient;

// ...

$client = new TefpsTvClient(new OAuth2HttpClient(
        'http://tefps-directory-host:port',
        'clientId',
        'clientSecret'),
        'http://tefps-tv-host:port'
      );

$tv = $client->fetchTv("cityId", "tvId");

}
```
