<?php
/*
 * PagarmeCoreApiLib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace PagarmeCoreApiLib\Models;

use JsonSerializable;
use PagarmeCoreApiLib\Utils\DateTimeHelper;

/**
 * @todo Write general description for this model
 */
class CreateTransactionReportFileRequest implements JsonSerializable
{
    /**
     * @todo Write general description for this property
     * @required
     * @var string $name public property
     */
    public $name;

    /**
     * @todo Write general description for this property
     * @maps start_at
     * @factory \PagarmeCoreApiLib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $startAt public property
     */
    public $startAt;

    /**
     * @todo Write general description for this property
     * @maps end_at
     * @var string|null $endAt public property
     */
    public $endAt;

    /**
     * Constructor to set initial or default values of member properties
     * @param string    $name    Initialization value for $this->name
     * @param \DateTime $startAt Initialization value for $this->startAt
     * @param string    $endAt   Initialization value for $this->endAt
     */
    public function __construct()
    {
        if (3 == func_num_args()) {
            $this->name    = func_get_arg(0);
            $this->startAt = func_get_arg(1);
            $this->endAt   = func_get_arg(2);
        }
    }


    /**
     * Encode this object to JSON
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $json = array();
        $json['name']     = $this->name;
        $json['start_at'] = isset($this->startAt) ?
            DateTimeHelper::toRfc3339DateTime($this->startAt) : null;
        $json['end_at']   = $this->endAt;

        return $json;
    }
}
