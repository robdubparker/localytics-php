<?php

namespace Plinthify\Localytics\Exports;

class Audience extends LocalyticsExportBase {
  
  public $audience_id;
  public $type;
  
  public function __construct($api_key, $api_secret) {
    parent::__construct($api_key, $api_secret);
  }

  public function getAudience(){
    return $this->makeRequest();
  }

  public function setAudienceType($type) {
    $this->type = $type;
  }

  public function getAudienceType() {
    return $this->type;
  }

  public function setAudienceId($audience_id) {
    $this->audience_id = $audience_id;
  }

  public function getAudienceId() {
    return $this->audience_id;
  }

  public function makeRequest() {
    $uri = rtrim($this->uri, '/');
    if (!empty($this->getAudienceId()) && !empty($this->getAudienceType())) {
      $this->uri = $uri . '/' . $this->getAudienceId() . '/' . $this->getAudienceType();
    }

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