<?php

namespace Plinthify\Localytics\Push\Target;

interface ProfileCriteriaInterface extends TargetInterface {
  
  public function getKey();
  public function getScope();
  public function getType();
  public function getInnerOp();
  public function getOuterOp();
  public function getTargetValue($target_type, $data);

}