<?php

namespace Plinthify\Localytics\Exports;

use Plinthify\Localytics\API\LocalyticsAccountBase;

class LocalyticsExportBase extends LocalyticsAccountBase {
  /**
   * @var string
   */
  public $uri = 'https://api.localytics.com/v1/exports/audiences';

  public function __construct($api_key, $api_secret) {
    parent::__construct($api_key, $api_secret);
  }

}
