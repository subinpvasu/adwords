<?php
/*
 *  Mail : subinpvasu@gmail.com
 *  Skype : subinpvasu 
 *  AdWords API integration
 */
namespace adwords;
require_once dirname(__DIR__).'/vendor/autoload.php';
use Google\AdsApi\AdWords\AdWordsServices;
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\Reporting\v201708\DownloadFormat;
use Google\AdsApi\AdWords\Reporting\v201708\ReportDefinition;
use Google\AdsApi\AdWords\Reporting\v201708\ReportDefinitionDateRangeType;
use Google\AdsApi\AdWords\Reporting\v201708\ReportDownloader;
use Google\AdsApi\AdWords\ReportSettings;
use Google\AdsApi\AdWords\ReportSettingsBuilder;
use Google\AdsApi\AdWords\v201708\cm\AdGroup;
use Google\AdsApi\AdWords\v201708\cm\AdGroupAd;
use Google\AdsApi\AdWords\v201708\cm\AdGroupAdOperation;
use Google\AdsApi\AdWords\v201708\cm\AdGroupAdService;
use Google\AdsApi\AdWords\v201708\cm\AdGroupAdStatus;
use Google\AdsApi\AdWords\v201708\cm\AdGroupCriterionOperation;
use Google\AdsApi\AdWords\v201708\cm\AdGroupCriterionService;
use Google\AdsApi\AdWords\v201708\cm\AdGroupOperation;
use Google\AdsApi\AdWords\v201708\cm\AdGroupService;
use Google\AdsApi\AdWords\v201708\cm\AdGroupStatus;
use Google\AdsApi\AdWords\v201708\cm\AdServingOptimizationStatus;
use Google\AdsApi\AdWords\v201708\cm\AdvertisingChannelType;
use Google\AdsApi\AdWords\v201708\cm\BiddableAdGroupCriterion;
use Google\AdsApi\AdWords\v201708\cm\BiddingStrategyConfiguration;
use Google\AdsApi\AdWords\v201708\cm\BiddingStrategyType;
use Google\AdsApi\AdWords\v201708\cm\Budget;
use Google\AdsApi\AdWords\v201708\cm\BudgetBudgetDeliveryMethod;
use Google\AdsApi\AdWords\v201708\cm\BudgetOperation;
use Google\AdsApi\AdWords\v201708\cm\BudgetService;
use Google\AdsApi\AdWords\v201708\cm\Campaign;
use Google\AdsApi\AdWords\v201708\cm\CampaignLabel;
use Google\AdsApi\AdWords\v201708\cm\CampaignLabelOperation;
use Google\AdsApi\AdWords\v201708\cm\CampaignOperation;
use Google\AdsApi\AdWords\v201708\cm\CampaignService;
use Google\AdsApi\AdWords\v201708\cm\CampaignStatus;
use Google\AdsApi\AdWords\v201708\cm\CpcBid;
use Google\AdsApi\AdWords\v201708\cm\CriterionType;
use Google\AdsApi\AdWords\v201708\cm\CriterionTypeGroup;
use Google\AdsApi\AdWords\v201708\cm\DateRange;
use Google\AdsApi\AdWords\v201708\cm\DateTimeRange;
use Google\AdsApi\AdWords\v201708\cm\Draft;
use Google\AdsApi\AdWords\v201708\cm\DraftOperation;
use Google\AdsApi\AdWords\v201708\cm\DraftService;
use Google\AdsApi\AdWords\v201708\cm\ExpandedTextAd;
use Google\AdsApi\AdWords\v201708\cm\Image;
use Google\AdsApi\AdWords\v201708\cm\Keyword;
use Google\AdsApi\AdWords\v201708\cm\Label;
use Google\AdsApi\AdWords\v201708\cm\LabelService;
use Google\AdsApi\AdWords\v201708\cm\MediaMediaType;
use Google\AdsApi\AdWords\v201708\cm\MediaService;
use Google\AdsApi\AdWords\v201708\cm\Money;
use Google\AdsApi\AdWords\v201708\cm\NetworkSetting;
use Google\AdsApi\AdWords\v201708\cm\Operator;
use Google\AdsApi\AdWords\v201708\cm\OrderBy;
use Google\AdsApi\AdWords\v201708\cm\Paging;
use Google\AdsApi\AdWords\v201708\cm\Predicate;
use Google\AdsApi\AdWords\v201708\cm\PredicateOperator;
use Google\AdsApi\AdWords\v201708\cm\ReportDefinitionReportType;
use Google\AdsApi\AdWords\v201708\cm\ResponsiveDisplayAd;
use Google\AdsApi\AdWords\v201708\cm\Selector;
use Google\AdsApi\AdWords\v201708\cm\SortOrder;
use Google\AdsApi\AdWords\v201708\cm\TargetingSetting;
use Google\AdsApi\AdWords\v201708\cm\TargetingSettingDetail;
use Google\AdsApi\AdWords\v201708\mcm\ManagedCustomer;
use Google\AdsApi\AdWords\v201708\mcm\ManagedCustomerOperation;
use Google\AdsApi\AdWords\v201708\mcm\ManagedCustomerService;
use Google\AdsApi\Common\Configuration;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\Dfp\v201708\DateRangeType;



class Advertising
{
    protected $config;
    protected $managerSession;
    protected $adwordsServices;
    protected $managerCustomerId;
    public $filePath;
    
    const PAGE_LIMIT = 500;

    public function __construct($config, $managerCustomerId)
    {
        $this->config = $config;
        $this->managerCustomerId = $managerCustomerId;
//        $this->filePath = sprintf('%s.csv',getcwd().'/sample_report'); 
    }

    public function createSession($clientCustomerId)
    {
        $config = new Configuration($this->config);

        $builder = new OAuth2TokenBuilder();
        $oAuth2Credential = $builder
            ->from($config)
            ->build();

        $rsb = new ReportSettingsBuilder();
        $rs = $rsb->includeZeroImpressions(true)->build();
//echo 'The Tokens - '.$oAuth2Credential.'|'.$clientCustomerId.'|'.$clientCustomerId.'|'.$this->config['OAUTH2']['developerToken'].'|'.$rs;
//exit();
        return (new AdWordsSessionBuilder())
            ->from($config)
            ->withOAuth2Credential($oAuth2Credential)
            ->withClientCustomerId($clientCustomerId)
            ->withDeveloperToken($this->config['OAUTH2']['developerToken'])
            ->withReportSettings($rs)
            ->build();
    }

    protected function getManagerSession()
    {
        if ($this->managerSession) {
            return $this->managerSession;
        }

        $this->managerSession = $this->createSession($this->managerCustomerId);
        return $this->managerSession;
    }

    /**
     * @return mixed
     */
    public function getAdwordsServices()
    {
        if (!$this->adwordsServices) {
            $this->adwordsServices = new AdWordsServices();
        }
        return $this->adwordsServices;
    }

     
    
    
  
  
  public function ModifyAccount(AdWordsServices $adWordsServices, AdWordsSession $session) {
    $campaignService = $adWordsServices->get($session, CampaignService::class);
    // Create selector.
    $selector = new Selector();
    $selector->setFields(['Id', 'Name','Status']);
    $selector->setOrdering([new OrderBy('Name', SortOrder::ASCENDING)]);
    $selector->setPaging(new Paging(0, \Credentials::$PAGE_LIMIT));
    $totalNumEntries = 0;
    
    do {
      // Make the get request.
      $page = $campaignService->get($selector);
      // Display results.
      if ($page->getEntries() !== null) {
        $totalNumEntries = $page->getTotalNumEntries();
        foreach ($page->getEntries() as $campaign) {
            
          if ((stristr($campaign->getName(), "apples")) || (stristr($campaign->getName(), "oranges")))
                    $this->UpdateCampaign($adWordsServices,$session, $campaign->getId(),1);
                else if ((stristr($campaign->getName(), "grapes")) || (stristr($campaign->getName(), "pears")))
                    $this->UpdateCampaign($adWordsServices,$session, $campaign->getId(), 0);
        }
      }
      // Advance the paging index.
      $selector->getPaging()->setStartIndex(
          $selector->getPaging()->getStartIndex() + \Credentials::$PAGE_LIMIT);
    } while ($selector->getPaging()->getStartIndex() < $totalNumEntries);
   
  }
  public function UpdateCampaign(AdWordsServices $adWordsServices, AdWordsSession $session, $campaignId, $campaignStatus)
  {
    $campaignService = $adWordsServices->get($session, CampaignService::class);
    $operations = [];
    // Create a campaign with PAUSED status.
    $campaign = new Campaign();
    $campaign->setId($campaignId);
    $campaignStatus==1?$campaign->setStatus(CampaignStatus::ENABLED):$campaign->setStatus(CampaignStatus::PAUSED);
    // Create a campaign operation and add it to the list.
    $operation = new CampaignOperation();
    $operation->setOperand($campaign);
    $operation->setOperator(Operator::SET);
    $operations[] = $operation;
    // Update the campaign on the server.
    $campaignService->mutate($operations);
    
  }
    
}
