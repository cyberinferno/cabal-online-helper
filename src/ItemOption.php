<?php

namespace cyberinferno\Cabal\Helpers;

use cyberinferno\Cabal\Helpers\Exceptions\InvalidCraftLevelException;
use cyberinferno\Cabal\Helpers\Exceptions\InvalidOptionException;
use cyberinferno\Cabal\Helpers\Exceptions\MaxOptionException;
use cyberinferno\Cabal\Helpers\Exceptions\OptionLimitException;

/**
 * Class ItemOption
 *
 * Contains methods helpful to generate item option
 *
 * @package cyberinferno\Cabal\Helpers
 * @author Karthik P
 */
class ItemOption
{
    const MAX_OPTIONS = 4;

    const MIN_SLOTS = 0;
    const MAX_SLOTS = 4;

    const MIN_CRAFTS = 0;
    const MAX_CRAFTS = 3;

    const OUTPUT_FORMAT_INTEGER = 'int';
    const OUTPUT_FORMAT_HEXADECIMAL = 'hex';

    /**
     * @var int Max number of slots the generated item option will have
     */
    protected $_slots;
    /**
     * @var array
     */
    protected $_slotOptions = [];
    /**
     * @var int Max number of crafts the generated item option will have
     */
    protected $_crafts;
    /**
     * @var array
     */
    protected $_craftOptions = [];
    /**
     * @var array
     */
    protected $_availableCraftLevels = ['9', 'A', 'B', 'C', 'D', 'E', 'F'];
    /**
     * @var array
     */
    protected $_availableOptions = [
        '1', '2', '3', '4', '5',
        '6', '7', '8', '9', 'A',
        'B', 'C', 'D', 'E', 'F'
    ];

    /**
     * ItemOption constructor.
     * @param int $slots
     * @param int $crafts
     * @throws \cyberinferno\Cabal\Helpers\Exceptions\MaxOptionException
     */
    public function __construct($slots = 0, $crafts = 0)
    {
        if ($slots < self::MIN_SLOTS) {
            $slots = self::MIN_SLOTS;
        }
        if ($slots > self::MAX_SLOTS) {
            $slots = self::MAX_SLOTS;
        }
        if ($crafts < self::MIN_CRAFTS) {
            $crafts = self::MIN_CRAFTS;
        }
        if ($crafts > self::MAX_CRAFTS) {
            $crafts = self::MAX_CRAFTS;
        }
        if ($slots + $crafts > self::MAX_OPTIONS) {
            throw new MaxOptionException('Maximum number of options cannot exceed ' . self::MAX_OPTIONS);
        }
        $this->_slots = $slots;
        $this->_crafts = $crafts;
    }

    /**
     * Returns the number of slots in the option
     *
     * @return int
     */
    public function getSlots()
    {
        return $this->_slots;
    }

    /**
     * Returns the number of crafts in the option
     *
     * @return int
     */
    public function getCrafts()
    {
        return $this->_crafts;
    }

    /**
     * Returns slot options
     *
     * @return array
     */
    public function getSlotOptions()
    {
        return $this->_slotOptions;
    }

    /**
     * Sets a slot option
     *
     * @param string $option
     * @return ItemOption
     * @throws InvalidOptionException
     * @throws OptionLimitException
     */
    public function setSlotOption($option)
    {
        if (!in_array(strval($option), $this->_availableOptions)) {
            throw new InvalidOptionException();
        }
        if (count($this->_slotOptions) == $this->_slots) {
            throw new OptionLimitException('Slot option cannot exceed ' . $this->_slots);
        }
        $this->_slotOptions[] = ['option' => (string)$option];
        return $this;
    }

    /**
     * Returns craft options
     *
     * @return array
     */
    public function getCraftOptions()
    {
        return $this->_craftOptions;
    }

    /**
     * Sets a craft option
     *
     * @param string $craftLevel
     * @param string $option
     * @return ItemOption
     * @throws InvalidCraftLevelException
     * @throws InvalidOptionException
     * @throws OptionLimitException
     */
    public function setCraftOption($craftLevel, $option)
    {
        if (!in_array(strval($craftLevel), $this->_availableCraftLevels)) {
            throw new InvalidCraftLevelException();
        }
        if (!in_array(strval($option), $this->_availableOptions)) {
            throw new InvalidOptionException();
        }
        if (count($this->_craftOptions) == $this->_crafts) {
            throw new OptionLimitException('Craft option cannot exceed ' . $this->_crafts);
        }
        $this->_craftOptions[] = [
            'craftLevel' => (string)$craftLevel,
            'option' => (string)$option
        ];
        return $this;
    }

    /**
     * Returns the generated item option based upon the criteria set
     *
     * @param string $format
     * @return string|int
     */
    public function generate($format = self::OUTPUT_FORMAT_INTEGER)
    {
        $optionString = '';
        $slotsToFillArray = [];
        // Craft options should be at the end of the hex string hence we start prepending all craft options to output
        foreach ($this->_craftOptions as $craftOption) {
            $optionString = $craftOption['craftLevel'] . $craftOption['option'] . $optionString;
        }
        // We calculate slots to fill based upon slot options
        foreach ($this->_slotOptions as $slotOption) {
            if (isset($slotsToFillArray[$slotOption['option']])) {
                // Item cannot have 4 set of same options
                if ($slotsToFillArray[$slotOption['option']] == 3) {
                    continue;
                }
                $slotsToFillArray[$slotOption['option']]++;
            } else {
                $slotsToFillArray[$slotOption['option']] = 1;
            }
        }
        // Sorting slots to fill array to make sure multiple slot options stay in the end
        arsort($slotsToFillArray, SORT_NUMERIC);
        // Build the output with slot options
        foreach ($slotsToFillArray as $option => $fill) {
            if (strlen($optionString) == 7) {
                // Means we prematurely reached the end due to wrong options being set hence go out of the loop
                break;
            }
            if (strlen($optionString) == 6) {
                // Ignore slots to fill value
                $optionString = $option . $optionString;
            } else {
                $optionString = $fill . $option . $optionString;
            }
        }
        if (strlen($optionString) < 7) {
            // Fill the output with 0s if there are empty slots
            $optionString = str_repeat('0', 7 - strlen($optionString)) . $optionString;
        }
        if ($format != self::OUTPUT_FORMAT_INTEGER) {
            return $this->_slots . $optionString;
        }
        return hexdec($this->_slots . $optionString);
    }

    /**
     * Extracts item options details from generated item option
     *
     * @param int|string $generatedItemOption
     * @return array
     */
    public static function extract($generatedItemOption)
    {
        if (is_int($generatedItemOption)) {
            $generatedItemOption = dechex($generatedItemOption);
        }
        if (strlen($generatedItemOption) < 8) {
            $generatedItemOption = str_repeat('0', 8 - strlen($generatedItemOption)) . $generatedItemOption;
        }
        $generatedItemOption = strtoupper($generatedItemOption);
        if (hexdec($generatedItemOption) > hexdec('4FFFFFFF')) {
            // Invalid generated option hence return default values
            return [
                'slots' => 0,
                'crafts' => 0,
                'slotOptions' => [],
                'craftOptions' => []
            ];
        }
        $craftOptions = [];
        $slotOptions = [];
        // Extract last 3 options
        for ($i = 1; $i <= 3; $i++) {
            $currentOption = substr($generatedItemOption, -1 * ($i * 2), 2);
            if (in_array($currentOption[0], ['9', 'A', 'B', 'C', 'D', 'E', 'F'])) {
                $craftOptions[] = [
                    'craftLevel' => $currentOption[0],
                    'craftOption' => $currentOption[1]
                ];
            } else {
                for ($j = 1; $j <= (int)$currentOption[0]; $j++) {
                    if ($currentOption[1] == '0') {
                        continue;
                    }
                    $slotOptions[] = [
                        'slotOption' => $currentOption[1]
                    ];
                }
            }
        }
        if ($generatedItemOption[1] != '0') {
            $slotOptions[] = [
                'slotOption' => $generatedItemOption[1]
            ];
        }
        return [
            'slots' => (int)$generatedItemOption[0],
            'crafts' => count($craftOptions),
            'slotOptions' => $slotOptions,
            'craftOptions' => $craftOptions
        ];
    }
}