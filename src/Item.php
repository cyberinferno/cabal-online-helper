<?php

namespace cyberinferno\Cabal\Helpers;

/**
 * Class Item
 *
 * Contains methods helpful to generate item code as well as item option
 *
 * @package cyberinferno\Cabal\Helpers
 * @author Karthik P
 */
class Item
{
    const ITEM_GRADE_CONSTANT = 8192;
    const ITEM_BIND_ACCOUNT_CONSTANT = 4096;
    const ITEM_BIND_CHARACTER_CONSTANT = 524288;
    const ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT = 1572864;

    const MIN_GRADE = 0;
    const MAX_GRADE = 15;

    /**
     * @var int
     */
    protected $_itemCode;
    protected $_itemGrade = 0;
    protected $_itemBinding = 0;
    protected $_itemOption = 0;
    protected $_itemDuration = 0;

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
     * @return Item $this
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
     * @return Item $this
     */
    public function setAccountBinding()
    {
        $this->_itemBinding = self::ITEM_BIND_ACCOUNT_CONSTANT;
        return $this;
    }

    /**
     * Sets the item binding to character
     *
     * @return Item $this
     */
    public function setCharacterBinding()
    {
        $this->_itemBinding = self::ITEM_BIND_CHARACTER_CONSTANT;
        return $this;
    }

    /**
     * Sets the item binding to character binding on usage
     *
     * @return Item $this
     */
    public function setCharacterBindingOnUsage()
    {
        $this->_itemBinding = self::ITEM_BIND_CHARACTER_ON_USAGE_CONSTANT;
        return $this;
    }

    /**
     * Returns the generated item code based up on the criteria set
     *
     * @return int
     */
    public function generateItemCode()
    {
        return $this->_itemCode + $this->_itemBinding + $this->_itemGrade * self::ITEM_GRADE_CONSTANT;
    }
}