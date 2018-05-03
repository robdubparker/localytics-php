<?php

namespace Plinthify\Localytics\Push\Message;

use Plinthify\Localytics\Push\Target\TargetObject;

class LocalyticsMessage extends LocalyticsMessages {

  protected $target;
  protected $alert;
  protected $ios;
  protected $android;

  public function __construct() {
    parent::__construct();
    $this->alert = new Alert();
  }

  function getAlert() {
    return $this->alert;
  }

  function setAlert(Alert $alert) {
    $this->alert = $alert->getPayload();
  }
  
  function getIos() {
    return $this->ios;
  }

  function setIos(IosMessage $ios) {
    $this->ios = $ios->getPayload();
  }
  
  function getAndroid() {
    return $this->android;
  }

  function setAndroid(AndroidMessage $android) {
    $this->android = $android->getPayload();
  }
  
  function getTarget() {
    return $this->target;
  }

  function setTarget(TargetObject $target) {
    $this->target = $target->getTargetValue();
  }
  
  function getMethodName($key) {
    if (strpos($key, '_') !== FALSE) {
      $parts = explode('_', $key);
      $methods = array();
      foreach($parts as $part) {
        $methods[] = ucwords($part);
      }
      return implode('', $methods);
    }
    return $key;
  }

  /**
   * @return array
   */
  function getMessage() {

    // TODO: Implement getPayload() method.
    $payload = new \stdClass();
    
    if (!empty($this->getTarget())) {
      $payload->target = $this->getTarget();
    }

    if (!empty($this->getAndroid())) {
      $payload->android = $this->getAndroid();
    }

    if (!empty($this->getIos())) {
      $payload->ios = $this->getIos();
    }

    if (!empty($this->getAlert())) {
      $payload->alert = $this->getAlert();
    }

    return $payload;
  }

}
