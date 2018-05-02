<?php

namespace Plinthify\Localytics\Push;

use Plinthify\Localytics\Push\Message\LocalyticsMessages;

interface LocalyticsPushInterface {

  public function getMessages();

  public function setMessages(LocalyticsMessages $messages);

  public function getRequestId();

  public function setRequestId($request_id);

  public function getTargetType();

  public function setTargetType($target_type);

  public function getCampaignKey();

  public function setCampaignKey($campaign_key);

  public function pushMessage();

}
