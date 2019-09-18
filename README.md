# Cabal Online helper classes
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

Running tests
--------------
Post installation run the following command

```
.\\vendor\\bin\\phpunit
```