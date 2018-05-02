<?php

namespace Plinthify\Localytics\Push\Message;

class LocalyticsMessages implements LocalyticsMessageInterface {

  protected $messages;

  public function __construct() {
    $this->messages = array();
  }
  function addMessage (LocalyticsMessage $message) {
    $this->messages[] = $message->getMessage();
  }
  function getMessages() {
    return $this->messages;
  }
}