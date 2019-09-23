# Cabal Online helper classes
[![Build Status](https://travis-ci.org/cyberinferno/cabal-online-helper.png)](https://travis-ci.org/cyberinferno/cabal-online-helper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/badges/quality-score.png)](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/)
[![Code Coverage](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/badges/coverage.png)](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/)

Cabal Online helper classes to faciliate building of cabal server tools using PHP

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require cyberinferno/cabal-online-helper
```

or add

```json
"cyberinferno/cabal-online-helper": "*"
```

to the require section of your composer.json.

Include the autoloader to load the classes in places you want to use the classes

```php
require 'vendor/autoload.php';
```

Running tests locally
----------------------
Clone the repo and install composer dependencies. Run the following command in the project directory

```
.\\vendor\\bin\\phpunit
```
