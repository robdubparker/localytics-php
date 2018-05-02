<?php

namespace Plinthify\Localytics\Push\Message;

class AndroidMessage extends LocalyticsMessage {

  protected $priority;

  protected $extra;

  /**
   * @var (optional, string) - specifies the channel for the notification.
   * Defaults to localytics_channel.
   */
  protected $ll_channel;

  /**
   * @var (optional, string) - specifies the deeplink url. This requires SDK v4+ and
   * deep linking is properly setup. Ensure the particular scheme/URL is
   * registered and handled within your app.
   */
  protected $ll_deep_link_url;

  /**
   * @var (optional, string) - specifies the url of the rich media attachment.
   * This requires SDK v4+ and proper rich push support.
   */
  protected $ll_attachment_url;

  protected $destinationType;
  protected $destinationId;
  

  public function __construct() {
    parent::__construct();
    $this->extra = new \stdClass();
  }

  public function setPriority($priority) {
    if (in_array($priority, array('high', 'normal'))) {
      $this->priority = $priority;
    }
  }

  public function getPriority() {
    return $this->priority;
  }

  public function setLlChannel($ll_channel) {
    $this->extra->ll_channel = $ll_channel;
    unset($this->ll_channel);
  }

  public function getLlChannel() {
    if (!empty($this->extra->ll_channel)) {
      return $this->extra->ll_channel;
    }
    return NULL;
  }

  public function setLlDeepLinkUrl($url){
    $this->extra->ll_deep_link_url = $url;
    unset($this->ll_deep_link_url);
  }

  public function getLlDeepLinkUrl() {
    if (!empty($this->extra->ll_deep_link_url)) {
      return $this->extra->ll_deep_link_url;
    }
    return NULL;
  }

  public function getExtra() {
    return $this->extra;
  }

  public function setDestinationType($type) {
    $this->extra->destinationType = $type;
    unset($this->destinationType);
  }

  public function getDestinationType() {
    if (!empty($this->extra->destinationType)) {
      return $this->extra->destinationType;
    }
    return NULL;
  }

  public function setDestinationId($value) {
    $this->extra->destinationId = (string) $value;
    unset($this->destinationId);
  }

  public function getDestinationId() {
    if (!empty($this->extra->destinationId)) {
      return $this->extra->destinationId;
    }
    return NULL;
  }

  public function setLlAttachmentUrl($url) {
    $this->extra->ll_attachment_url = $url;
    unset($this->ll_attachment_url);
  }

  public function getLlAttachmentUrl() {
    if (!empty($this->extra->ll_attachment_url)) {
      return $this->extra->ll_attachment_url;
    }
    return NULL;
  }

  public function getPayload() {
    $payload = new \stdClass();
    foreach($this as $key => $data) {
      $method = 'get' . $this->getMethodName($key);
      if (method_exists($this, $method) && !empty($this->$method())) {
        $payload->$key = $this->$method();
      }
    }

    return $payload;
  }

}