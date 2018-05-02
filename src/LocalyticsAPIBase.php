<?php

namespace Plinthify\Localytics\API;

class LocalyticsAccountBase {

  /**
   * @var string Current version of the SDK
   */
  const VERSION = '1.0.0';

  /**
   * @var string
   */
  public $api_key;
  /**
   * @var string
   */
  public $api_secret;

  public function __construct($api_key = NULL, $api_secret = NULL) {
    $this->api_key = $api_key;
    $this->api_secret = $api_secret;
  }
  
}