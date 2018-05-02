<?php

namespace Plinthify\Localytics\Push\Message;

class IosMessage extends LocalyticsMessage {

  /**
   * @var (optional, string) - specifies the sound file in the app bundle or in 
   * the Library/Sounds folder of the app’s data container. If the sound file 
   * doesn’t exist or default is specified as the value, the default alert sound 
   * is played.
   */
  protected $sound;
  /**
   * @var (optional, int) - specifies the unread badge number to display upon 
   * delivery.
   */
  protected $badge;
  /**
   * @var (optional, string) - specifies the category of actions (interactive push) 
   * to display to the user upon delivery.
   */
  protected $category;
  /**
   * @var (optional, boolean) - True by default. Localytics utilizes 
   * content-available to enhance performance reports.
   */
  protected $content_available;
  /**
   * @var (optional, boolean) - False by default. Setting it to true allows the 
   * alert to trigger Notification Extensions.
   */
  protected $mutable_content;

  /**
   * @var \stdClass
   * wrapper variable
   */
  protected $extra;

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

  /**
   * @var (optional, string) - specifies the media type (.png, .gif etc.) of
   * the rich media attachment.
   */
  protected $ll_attachment_type;

  protected $destinationType;
  protected $destinationId;

  /**
   * @var (optional, object) - key/value pairs to pass to the application in the 
   * push payload.
   *  -- ll_deep_link_url (optional, string) - specifies the deeplink url. 
   *     This requires SDK v4+ and deep linking is properly setup. Ensure the 
   *     particular scheme/URL is registered and handled within your app.
   *  -- ll_attachment_url (optional, string) - specifies the url of the rich 
   *     media attachment. This requires SDK v4+ and proper rich push support.
   *  -- ll_attachment_type (optional, string) - specifies the media type 
   *     (.png, .gif etc.)
   */
  
  public function __construct() {
    parent::__construct();
    $this->extra = new \stdClass();
  }

  public function setLlDeepLinkUrl($url) {
    $this->extra->ll_deep_link_url = $url;
    unset($this->ll_deep_link_url);
  }

  public function getLlDeepLinkUrl() {
    if (!empty($this->extra->ll_deep_link_url)) {
      return $this->extra->ll_deep_link_url;
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

  public function setLlAttachmentType($type) {
    $this->extra->ll_attachment_type = $type;
    unset($this->ll_attachment_type);
  }

  public function getLlAttachmentType() {
    if (!empty($this->extra->ll_attachment_type)) {
      return $this->extra->ll_attachment_type;
    }
    return NULL;
  }

  public function getExtra() {
    return $this->extra;
  }

  public function setSound($sound) {
    $this->sound = $sound;
  }

  public function getSound() {
    return $this->sound;
  }

  public function setBadge($badge = FALSE) {
    $this->badge = $badge;
  }

  public function getBadge() {
    return $this->badge;
  }

  public function setCategory($category) {
    $this->category = $category;
  }

  public function getCategory() {
    return $this->category;
  }

  public function setContentAvailable($available) {
    $this->content_available = $available;
  }

  public function getContentAvailable() {
    return $this->content_available;
  }

  public function setMutableContent($mutable) {
    $this->mutable_content = $mutable;
  }

  public function getMutableContent() {
    return $this->mutable_content;
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
