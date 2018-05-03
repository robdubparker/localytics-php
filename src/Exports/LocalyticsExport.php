<?php

namespace Plinthify\Localytics\Exports;

use Plinthify\Localytics\API\LocalyticsAccountBase;
use Plinthify\Localytics\Export\LocalyticsExportInterface;

abstract class LocalyticsExport extends LocalyticsAccountBase implements LocalyticsExportInterface {
  /**
   * @var string
   */
  public $uri = 'https://api.localytics.com/v1/exports/';

  public function getExport() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->uri);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout after 30 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$this->api_key:$this->api_secret");
    $result = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_close ($ch);

    return array (
      'data' => json_decode($result),
      'code' => $status_code,
    );
  }

}
