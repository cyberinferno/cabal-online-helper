Cabal Online helper classes
============================
[![Build Status](https://travis-ci.org/cyberinferno/cabal-online-helper.png)](https://travis-ci.org/cyberinferno/cabal-online-helper)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/badges/quality-score.png)](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/)
[![Code Coverage](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/badges/coverage.png)](https://scrutinizer-ci.com/g/cyberinferno/cabal-online-helper/)
[![Maintainability](https://api.codeclimate.com/v1/badges/8e70f19e4d9b5cb1af0f/maintainability)](https://codeclimate.com/github/cyberinferno/cabal-online-helper/maintainability)

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
$item = new cyberinferno\Cabal\Helpers\ItemCode(45); // Here we initialise with item code of Training Katana
$item->setAccountBinding(); // Setting the item to be account bound
// $item->setCharacterBinding(); // Setting the item to be character bound
// $item->setCharacterBindingOnUsage(); // Setting the item to be character bound on usage
$item->setGrade(10); // Setting item to be grade 10
// This will return the final item code for Account bound Training Katana +10
$generatedItemCode = $item->generate();

// Item option generator
// A 4 slotted item
$itemOption = new cyberinferno\Cabal\Helpers\ItemOption(4);
// 1 slot Max crit/HP steal
$itemOption->setSlotOption('C');
// 1 sword amp
$itemOption->setSlotOption(8);
// 1 HP/DEF
$itemOption->setSlotOption(1);
// 1 DEF/ATT RATE
$itemOption->setSlotOption(2);
// This will return integer value of the item option i.e integer value of 0x4211181C
$generatedItemOption = $itemOption->generate();

// A 3 slotted item with 1 craft option
$myClass = new cyberinferno\Cabal\Helpers\ItemOption(3, 1);
// All skill amp with max craft
$myClass->setCraftOption('F', 'F');
// This will return hexadecimal string item option i.e '300000FF'
$generatedItemOption = $itemOption->generate(cyberinferno\Cabal\Helpers\ItemOption::OUTPUT_FORMAT_HEXADECIMAL);

// Extract item code
$extractedItemCode = cyberinferno\Cabal\Helpers\ItemCode::extract(123012);

// Extract item option
$extractedItemOption = cyberinferno\Cabal\Helpers\ItemOption::extract('300038ff');

// Decode binary item list
$decodedItems = cyberinferno\Cabal\Helpers\Character::DecodeBinaryItemList('0x690000000000000000000000000000000000');

// Remove slot option
// This will return 30001C18
$result = cyberinferno\Cabal\Helpers\ItemOption::removeSlotOption('30001C28', 8, cyberinferno\Cabal\Helpers\ItemOption::OUTPUT_FORMAT_HEXADECIMAL);
```

Running tests locally
----------------------
Clone the repo and install composer dependencies. Run the following command in the project directory

```
.\\vendor\\bin\\phpunit
```
