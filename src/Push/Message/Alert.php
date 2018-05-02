<?php

namespace Plinthify\Localytics\Push\Message;

class Alert {
  
  protected $body;
  protected $title;
  protected $subtitle;

  public function __construct ($body = NULL) {
    $this->body = $body;
  }

  public function setBody($body) {
    $this->body = $body;
  }

  public function getBody() {
    return $this->body;
  }

  public function setTitle($title) {
    $this->title = $title;
  }

  public function getTitle() {
    return $this->title;
  }

  public function setSubtitle($subtitle) {
    $this->subtitle = $subtitle;
  }

  public function getSubtitle() {
    return $this->subtitle;
  }

  public function getPayload() {
    $payload = new \stdClass();
    if (!empty($this->getTitle())) {
      $payload->title = $this->getTitle();
    }
    if (!empty($this->getSubtitle())) {
      $payload->subtitle = $this->getSubtitle();
    }
    if (!empty($this->getBody())) {
      $payload->body = $this->getBody();
    }
    return $payload;
  }
  
}
