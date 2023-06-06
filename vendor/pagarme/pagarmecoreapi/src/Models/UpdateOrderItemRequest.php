<?php
/*
 * PagarmeCoreApiLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace PagarmeCoreApiLib\Models;

use JsonSerializable;

/**
 *Update Order item Request
 */
class UpdateOrderItemRequest implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @required
     * @var integer $amount public property
     */
    public $amount;

    /**
     * @todo Write general description for this property
     * @required
     * @var string $description public property
     */
    public $description;

    /**
     * @todo Write general description for this property
     * @required
     * @var integer $quantity public property
     */
    public $quantity;

    /**
     * @todo Write general description for this property
     * @required
     * @var string $category public property
     */
    public $category;

    /**
     * Constructor to set initial or default values of member properties
     * @param integer $amount      Initialization value for $this->amount
     * @param string  $description Initialization value for $this->description
     * @param integer $quantity    Initialization value for $this->quantity
     * @param string  $category    Initialization value for $this->category
     */
    public function __construct()
    {
        if (4 == func_num_args()) {
            $this->amount      = func_get_arg(0);
            $this->description = func_get_arg(1);
            $this->quantity    = func_get_arg(2);
            $this->category    = func_get_arg(3);
        }
    }


    /**
     * Encode this object to JSON
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $json = array();
        $json['amount']      = $this->amount;
        $json['description'] = $this->description;
        $json['quantity']    = $this->quantity;
        $json['category']    = $this->category;

        return $json;
    }
}
