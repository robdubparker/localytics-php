<?php

namespace Plinthify\Localytics\Push\Target;

class Audience extends TargetObject implements TargetInterface {

  public $target;

  public function __construct($target_type, $data){
    parent::__construct($target_type, $data);
  }

  public function getTargetValue() {
    // needs an integer specifically.
    return (int) $this->data;
  }

}