<?php

namespace cyberinferno\Cabal\Helpers;

/**
 * Class ItemCode
 *
 * Contains methods helpful to generate item code
 *
 * @package cyberinferno\Cabal\Helpers
 * @author Karthik P
 */
class ItemCode
{
    const ITEM_GRADE_CONSTANT = 8192;
    const ITEM_BIND_ACCOUNT_CONSTANT = 4096;
    const ITEM_BIND_CHARACTER_CONSTANT = 524288;
    const ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT = 1572864;

    const MAX_BASE_ITEM_CODE = 4095;
    const MAX_GENERATED_ITEM_CODE = 1699839;

    const MIN_GRADE = 0;
    const MAX_GRADE = 15;

    /**
     * @var int
     */
    protected $_itemCode;
    protected $_itemGrade = 0;
    protected $_itemBinding = 0;

    /**
     * Item constructor.
     *
     * @param $itemCode
     */
    public function __construct($itemCode)
    {
        $this->_itemCode = $itemCode;
    }

    /**
     * Returns the item code
     *
     * @return int
     */
    public function getItemCode()
    {
        return $this->_itemCode;
    }

    /**
     * Returns the current grade of the item
     *
     * @return int
     */
    public function getGrade()
    {
        return $this->_itemGrade;
    }

    /**
     * Sets the grade of the item to generated
     *
     * @param int $value
     * @return ItemCode $this
     */
    public function setGrade($value)
    {
        $value = (int)$value;
        if ($value < self::MIN_GRADE) {
            $value = self::MIN_GRADE;
        }
        if ($value > self::MAX_GRADE) {
            $value = self::MAX_GRADE;
        }
        $this->_itemGrade = $value;
        return $this;
    }

    /**
     * Returns current item binding
     *
     * @return int
     */
    public function getBinding()
    {
        return $this->_itemBinding;
    }

    /**
     * Sets the item binding to account
     *
     * @return ItemCode $this
     */
    public function setAccountBinding()
    {
        $this->_itemBinding = self::ITEM_BIND_ACCOUNT_CONSTANT;
        return $this;
    }

    /**
     * Sets the item binding to character
     *
     * @return ItemCode $this
     */
    public function setCharacterBinding()
    {
        $this->_itemBinding = self::ITEM_BIND_CHARACTER_CONSTANT;
        return $this;
    }

    /**
     * Sets the item binding to character binding on usage
     *
     * @return ItemCode $this
     */
    public function setCharacterBindingOnUsage()
    {
        $this->_itemBinding = self::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT;
        return $this;
    }

    /**
     * Removes the item binding
     *
     * @return ItemCode $this
     */
    public function setNoBinding()
    {
        $this->_itemBinding = 0;
        return $this;
    }

    /**
     * Returns the generated item code based up on the criteria set
     *
     * @return int
     */
    public function generate()
    {
        return $this->_itemCode + $this->_itemBinding + $this->_itemGrade * self::ITEM_GRADE_CONSTANT;
    }

    /**
     * Extracts information from the final generated item code
     *
     * @return array
     */
    public function extract()
    {
        // We cannot extract data if either of these conditions are met hence return the input item code itself
        if ($this->_itemCode > self::MAX_GENERATED_ITEM_CODE || $this->_itemCode <= self::MAX_BASE_ITEM_CODE) {
            return [
                'itemCode' => $this->_itemCode,
                'binding' => 0,
                'grade' => 0
            ];
        }
        $binding = 0;
        // Find the binding constant
        if ($this->_itemCode > self::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT) {
            $binding = self::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT;
        } else if ($this->_itemCode > self::ITEM_BIND_CHARACTER_CONSTANT) {
            $binding = self::ITEM_BIND_CHARACTER_CONSTANT;
        }
        // Subtract the binding constant
        $itemCode = $this->_itemCode - $binding;
        $grade = 0;
        // Subtract grade constant until base item code has been reached
        while ($itemCode > self::ITEM_GRADE_CONSTANT) {
            $grade++;
            $itemCode -= self::ITEM_GRADE_CONSTANT;
        }
        // After grade subtraction if item code exceeds account binding constant then it is account bound item
        if ($itemCode > self::ITEM_BIND_ACCOUNT_CONSTANT) {
            $itemCode -= self::ITEM_BIND_ACCOUNT_CONSTANT;
            $binding = self::ITEM_BIND_ACCOUNT_CONSTANT;
        }
        return [
            'itemCode' => $itemCode,
            'binding' => $binding,
            'grade' => $grade
        ];
    }
}