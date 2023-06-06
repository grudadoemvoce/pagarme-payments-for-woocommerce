<?php
/*
 * PagarmeCoreApiLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace PagarmeCoreApiLib\Models;

use JsonSerializable;

/**
 * @todo Write general description for this model
 */
class GetSellerResponse implements JsonSerializable
{
    /**
     * Identification
     * @required
     * @var string $id public property
     */
    public $id;

    /**
     * @todo Write general description for this property
     * @required
     * @var string $name public property
     */
    public $name;

    /**
     * @todo Write general description for this property
     * @required
     * @var string $code public property
     */
    public $code;

    /**
     * @todo Write general description for this property
     * @required
     * @var string $document public property
     */
    public $document;

    /**
     * Description
     * @required
     * @var string $description public property
     */
    public $description;

    /**
     * Status
     * @required
     * @maps Status
     * @var string $status public property
     */
    public $status;

    /**
     * Creation date
     * @required
     * @maps CreatedAt
     * @var string $createdAt public property
     */
    public $createdAt;

    /**
     * Updated date
     * @required
     * @maps UpdatedAt
     * @var string $updatedAt public property
     */
    public $updatedAt;

    /**
     * Address
     * @required
     * @maps Address
     * @var \PagarmeCoreApiLib\Models\GetAddressResponse $address public property
     */
    public $address;

    /**
     * Metadata
     * @required
     * @maps Metadata
     * @var array $metadata public property
     */
    public $metadata;

    /**
     * Deleted date
     * @maps DeletedAt
     * @var string|null $deletedAt public property
     */
    public $deletedAt;

    /**
     * Constructor to set initial or default values of member properties
     * @param string             $id          Initialization value for $this->id
     * @param string             $name        Initialization value for $this->name
     * @param string             $code        Initialization value for $this->code
     * @param string             $document    Initialization value for $this->document
     * @param string             $description Initialization value for $this->description
     * @param string             $status      Initialization value for $this->status
     * @param string             $createdAt   Initialization value for $this->createdAt
     * @param string             $updatedAt   Initialization value for $this->updatedAt
     * @param GetAddressResponse $address     Initialization value for $this->address
     * @param array              $metadata    Initialization value for $this->metadata
     * @param string             $deletedAt   Initialization value for $this->deletedAt
     */
    public function __construct()
    {
        if (11 == func_num_args()) {
            $this->id          = func_get_arg(0);
            $this->name        = func_get_arg(1);
            $this->code        = func_get_arg(2);
            $this->document    = func_get_arg(3);
            $this->description = func_get_arg(4);
            $this->status      = func_get_arg(5);
            $this->createdAt   = func_get_arg(6);
            $this->updatedAt   = func_get_arg(7);
            $this->address     = func_get_arg(8);
            $this->metadata    = func_get_arg(9);
            $this->deletedAt   = func_get_arg(10);
        }
    }


    /**
     * Encode this object to JSON
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $json = array();
        $json['id']          = $this->id;
        $json['name']        = $this->name;
        $json['code']        = $this->code;
        $json['document']    = $this->document;
        $json['description'] = $this->description;
        $json['Status']      = $this->status;
        $json['CreatedAt']   = $this->createdAt;
        $json['UpdatedAt']   = $this->updatedAt;
        $json['Address']     = $this->address;
        $json['Metadata']    = $this->metadata;
        $json['DeletedAt']   = $this->deletedAt;

        return $json;
    }
}
