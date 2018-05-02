<?php

namespace Plinthify\Localytics\Push\Target;

use Plinthify\Localytics\Push\Message\LocalyticsMessageInterface;

class TargetObject implements TargetInterface {

  public $target;
  protected $type;
  protected $data;

  public function __construct($type, $data) {
    $this->type = $type;
    $this->data = $data;
  }

  public function getTargetValue() {
    $targets = array (
      'audience_id' => 'Audience',
      'customer_id' => 'Customer',
      'profile' => 'Profile',
      'broadcast' => 'Broadcast',
    );
    $type = $this->type;
    $target_classname = "\\Plinthify\\Localytics\\Push\\Target\\$targets[$type]";

    if (class_exists($target_classname)) {
      $target = new $target_classname($type, $this->data);
      $this->target = $target->getTargetValue();
      return $this->target;
    }
    return NULL;
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function getType() {
    return $this->type;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function getData() {
    $this->data;
  }

}