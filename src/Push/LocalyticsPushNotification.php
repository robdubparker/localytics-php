<?php

namespace Plinthify\Localytics\Push;

use Plinthify\Localytics\API\LocalyticsAccountBase;
use Plinthify\Localytics\Push\Message\LocalyticsMessage;
use Plinthify\Localytics\Push\Message\LocalyticsMessages;

class LocalyticsPushNotification extends LocalyticsAccountBase implements LocalyticsPushInterface {

  protected $target_type;
  protected $request_id;
  protected $campaign_key;
  /**
   * @var LocalyticsMessage object
   */
  protected $messages;
  protected $account;
  protected $app_id;
  /**
   * @var string
   */
  protected $uri = 'https://messaging.localytics.com/v2/push/';

  /**
   * @param object $account
   * @param object $messages
   * @param string $target_type
   * @param string $app_id
   * @param string $request_id
   * @param string $campaign_key
   */
  public function __construct(LocalyticsAccountBase $account, LocalyticsMessages $messages, $target_type, $app_id, $request_id = NULL, $campaign_key = NULL) {
    parent::__construct($account->api_key, $account->api_secret);
    $this->messages = $messages->getMessages();
    $this->target_type = $target_type;
    $this->request_id = $request_id;
    $this->campaign_key = $campaign_key;
    $this->account = $account;
    $this->app_id = $app_id;
  }

  /**
   * Send one or many push notification messages.
   */
  public function pushMessages() {

    $data = [
      'target_type' => $this->target_type,
      'messages' => $this->messages,
    ];

    // Only include 'campaign_id' if it has a value.
    if (!empty($this->campaign_key)) {
      $data['campaign_key'] = $this->campaign_key;
    }

    // Only include 'request_id' if it has a value.
    if(!empty($this->request_id)) {
      $data['request_id'] = $this->request_id;
    }

    $payload = json_encode($data);

    $uri = rtrim($this->uri, '/') . '/' . $this->app_id;
    $headers  = [
      'Content-Type: application/json',
      'Content-Length: ' . strlen($payload),
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); //timeout after 10 seconds
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$this->api_key:$this->api_secret");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, 1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec ($ch);
    $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
    curl_close ($ch);

    return array(
      'response' => $result,
      'data' => $data,
      'code' => $status_code,
    );
  }

  public function getUri() {
    return $this->uri;
  }

  public function setUri($uri) {
    $this->uri = $uri;
  }

  public function getAppId(){
    return $this->app_id;
  }

  public function setAppId($id){
    $this->app_id = $id;
  }

  public function getMessages(){
    return $this->messages;
  }

  public function setMessages(LocalyticsMessages $messages){
    $this->messages = $messages;
  }

  public function getRequestId(){
    return $this->request_id;
  }

  public function setRequestId($request_id){
    $this->request_id = $request_id;
  }

  public function getCampaignKey(){
    return $this->getCampaignKey();
  }

  public function setTargetType($target_type){
    $this->target_type = $target_type;
  }

  public function getTargetType(){
    return $this->getTargetType();
  }

  public function setCampaignKey($campaign_key){
    $this->campaign_key = $campaign_key;
  }

  public function pushMessage() {
    return $this->pushMessages();
  }

}
