<?php

namespace Plinthify\Localytics\Push\Target;

class Broadcast extends TargetObject implements TargetInterface {

  public function getTargetValue() {
    // 'broadcast' api target has no data to return.
    return NULL;
  }

}
