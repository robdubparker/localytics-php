<?php

namespace Plinthify\Localytics\Push\Target;

class Customer extends TargetObject implements TargetInterface {
  
  public function __construct($target_type, $data){
    parent::__construct($target_type, $data);
  }

  public function getTargetValue() {
    return $this->data;
  }

}