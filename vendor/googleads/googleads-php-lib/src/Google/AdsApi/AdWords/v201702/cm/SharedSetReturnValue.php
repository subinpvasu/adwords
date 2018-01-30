<?php

namespace Google\AdsApi\AdWords\v201702\cm;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class SharedSetReturnValue extends \Google\AdsApi\AdWords\v201702\cm\ListReturnValue
{

    /**
     * @var \Google\AdsApi\AdWords\v201702\cm\SharedSet[] $value
     */
    protected $value = null;

    /**
     * @param string $ListReturnValueType
     * @param \Google\AdsApi\AdWords\v201702\cm\SharedSet[] $value
     */
    public function __construct($ListReturnValueType = null, array $value = null)
    {
      parent::__construct($ListReturnValueType);
      $this->value = $value;
    }

    /**
     * @return \Google\AdsApi\AdWords\v201702\cm\SharedSet[]
     */
    public function getValue()
    {
      return $this->value;
    }

    /**
     * @param \Google\AdsApi\AdWords\v201702\cm\SharedSet[] $value
     * @return \Google\AdsApi\AdWords\v201702\cm\SharedSetReturnValue
     */
    public function setValue(array $value)
    {
      $this->value = $value;
      return $this;
    }

}
