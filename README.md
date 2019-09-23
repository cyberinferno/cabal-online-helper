Cabal Online helper classes
============================
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

Basic Usage
-----------
```php
<?php
require 'vendor/autoload.php';

// Encoding character style
$gender = 2; // Male
$aura = 12; // Lightning aura
$hair = 4; // Hair style 4
$hairColor = 0; // Hair color 0
$face = 1; // Face style 1
$classRank = 20; // Class rank 20
$class = 5; // Force Shielder class
// This will return 159908261
$encodedStyle = cyberinferno\Cabal\Helpers\Character::EncodeStyle($gender,$aura,$hair,$hairColor,$face,$classRank,$class);

// Decoding character style
// This will return ['gender' => 2, 'aura' => 12, 'hair' => 4, 'hairColor' => 0, 'face' => 1, 'classRank' => 20, 'class' => 5]
$decodedStyleArray = cyberinferno\Cabal\Helpers\Character::DecodeStyle(159908261);

// Listing game constants
// This will return [1 => 'Warrior', 2 => 'Blader', 3 => 'Wizard', 4 => 'Force Archer', 5 => 'Force Shielder', 6 => 'Force Blader']
$classList = cyberinferno\Cabal\Helpers\GameConstants::listClasses();

// Item code generator
// Initialise Item class with item code
$item = new cyberinferno\Cabal\Helpers\Item(45); // Here we initialise with item code of Training Katana
$item->setAccountBinding(); // Setting the item to be account bound
// $item->setCharacterBinding(); // Setting the item to be character bound
// $item->setCharacterBindingOnUsage(); // Setting the item to be character bound on usage
$item->setGrade(10); // Setting item to be grade 10
// This will return the final item code for Account bound Training Katana +10
$generatedItemCode = $item->generateItemCode();
```

Running tests locally
----------------------
Clone the repo and install composer dependencies. Run the following command in the project directory

```
.\\vendor\\bin\\phpunit
```
