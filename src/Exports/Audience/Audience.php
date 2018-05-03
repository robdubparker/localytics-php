<?php

namespace Plinthify\Localytics\Exports;

use Plinthify\Localytics\API\LocalyticsAccountBase;
use Plinthify\Localytics\Export\LocalyticsExportInterface;

class AudienceExport extends LocalyticsExport implements LocalyticsExportInterface{

  /**
   * @var integer
   */
  public $audience_id;
  /**
   * @var string
   * @options
   *   'customer_id': Customer ID
   *   'email': Email Address
   *   'gaid': Google Advertising ID (GAID)
   *   'idfa': Apple Identifier for Advertising (IDFA)
   */
  public $audience_type;
  
  public function __construct(LocalyticsAccountBase $account, $type = NULL, $id = NULL) {
    parent::__construct($account);
    $this->uri = rtrim($this->uri, '/') . '/audiences';
    if (!empty($type) && !empty($id)) {
      $this->audience_id = $id;
      $this->audience_type = $type;
      $this->uri = $this->uri . '/' . $id . '/' . $type;
    }
  }
  
}