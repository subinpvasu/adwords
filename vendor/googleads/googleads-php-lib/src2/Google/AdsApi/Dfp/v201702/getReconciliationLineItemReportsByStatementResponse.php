<?php

namespace Google\AdsApi\Dfp\v201702;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class getReconciliationLineItemReportsByStatementResponse
{

    /**
     * @var \Google\AdsApi\Dfp\v201702\ReconciliationLineItemReportPage $rval
     */
    protected $rval = null;

    /**
     * @param \Google\AdsApi\Dfp\v201702\ReconciliationLineItemReportPage $rval
     */
    public function __construct($rval = null)
    {
      $this->rval = $rval;
    }

    /**
     * @return \Google\AdsApi\Dfp\v201702\ReconciliationLineItemReportPage
     */
    public function getRval()
    {
      return $this->rval;
    }

    /**
     * @param \Google\AdsApi\Dfp\v201702\ReconciliationLineItemReportPage $rval
     * @return \Google\AdsApi\Dfp\v201702\getReconciliationLineItemReportsByStatementResponse
     */
    public function setRval($rval)
    {
      $this->rval = $rval;
      return $this;
    }

}
