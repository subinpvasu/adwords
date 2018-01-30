<?php

namespace Google\AdsApi\AdWords\v201708\cm;


/**
 * This file was generated from WSDL. DO NOT EDIT.
 */
class BatchJobService extends \Google\AdsApi\Common\AdsSoapClient
{

    /**
     * @var array $classmap The defined classes
     */
    private static $classmap = array (
      'AuthenticationError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\AuthenticationError',
      'AuthorizationError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\AuthorizationError',
      'BatchJobError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\BatchJobError',
      'BatchJobProcessingError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\BatchJobProcessingError',
      'ClientTermsError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\ClientTermsError',
      'DateRange' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\DateRange',
      'DistinctError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\DistinctError',
      'FieldPathElement' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\FieldPathElement',
      'IdError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\IdError',
      'InternalApiError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\InternalApiError',
      'NotEmptyError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\NotEmptyError',
      'OperationAccessDenied' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\OperationAccessDenied',
      'OperatorError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\OperatorError',
      'OrderBy' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\OrderBy',
      'Paging' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\Paging',
      'Predicate' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\Predicate',
      'ProgressStats' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\ProgressStats',
      'QuotaCheckError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\QuotaCheckError',
      'RangeError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\RangeError',
      'RateExceededError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\RateExceededError',
      'ReadOnlyError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\ReadOnlyError',
      'RejectedError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\RejectedError',
      'RequestError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\RequestError',
      'RequiredError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\RequiredError',
      'SelectorError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\SelectorError',
      'SizeLimitError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\SizeLimitError',
      'SoapHeader' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\SoapHeader',
      'SoapResponseHeader' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\SoapResponseHeader',
      'StringFormatError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\StringFormatError',
      'StringLengthError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\StringLengthError',
      'TemporaryUrl' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\TemporaryUrl',
      'DatabaseError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\DatabaseError',
      'ApiError' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\ApiError',
      'ApiException' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\ApiException',
      'ApplicationException' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\ApplicationException',
      'BatchJob' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\BatchJob',
      'BatchJobOperation' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\BatchJobOperation',
      'BatchJobPage' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\BatchJobPage',
      'BatchJobReturnValue' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\BatchJobReturnValue',
      'ListReturnValue' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\ListReturnValue',
      'Operation' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\Operation',
      'Page' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\Page',
      'Selector' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\Selector',
      'getResponse' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\getResponse',
      'mutateResponse' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\mutateResponse',
      'queryResponse' => 'Google\\AdsApi\\AdWords\\v201708\\cm\\queryResponse',
    );

    /**
     * @param array $options A array of config values
     * @param string $wsdl The wsdl file to use
     */
    public function __construct(array $options = array(),
                $wsdl = 'https://adwords.google.com/api/adwords/cm/v201708/BatchJobService?wsdl')
    {
      foreach (self::$classmap as $key => $value) {
        if (!isset($options['classmap'][$key])) {
          $options['classmap'][$key] = $value;
        }
      }
      $options = array_merge(array (
      'features' => 1,
    ), $options);
      parent::__construct($wsdl, $options);
    }

    /**
     * Query the status of existing {@code BatchJob}s.
     *
     * @param \Google\AdsApi\AdWords\v201708\cm\Selector $selector
     * @return \Google\AdsApi\AdWords\v201708\cm\BatchJobPage
     * @throws \Google\AdsApi\AdWords\v201708\cm\ApiException
     */
    public function get(\Google\AdsApi\AdWords\v201708\cm\Selector $selector)
    {
      return $this->__soapCall('get', array(array('selector' => $selector)))->getRval();
    }

    /**
     * Creates or updates a {@code BatchJob}.
     *
     * <p class="note"><b>Note:</b> {@link BatchJobOperation} does not support the
     * {@code REMOVE} operator. It is not necessary to remove BatchJobs.
     *
     * @param \Google\AdsApi\AdWords\v201708\cm\BatchJobOperation[] $operations
     * @return \Google\AdsApi\AdWords\v201708\cm\BatchJobReturnValue
     * @throws \Google\AdsApi\AdWords\v201708\cm\ApiException
     */
    public function mutate(array $operations)
    {
      return $this->__soapCall('mutate', array(array('operations' => $operations)))->getRval();
    }

    /**
     * Returns the list of {@code BatchJob}s that match the query.
     *
     * batchjob information.
     *
     * @param string $query
     * @return \Google\AdsApi\AdWords\v201708\cm\BatchJobPage
     * @throws \Google\AdsApi\AdWords\v201708\cm\ApiException
     */
    public function query($query)
    {
      return $this->__soapCall('query', array(array('query' => $query)))->getRval();
    }

}
