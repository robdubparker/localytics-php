# localytics-php
Localytics PHP SDK

# Example use:

```
// Wrapper object that will contain our messages.
$messages = new \Frequency\Localytics\Push\Message\LocalyticsMessages();

// Build Alert object data for message.
$alert = new \Frequency\Localytics\Push\Message\Alert();
// This field is required.
$alert->setBody('My body message');
$alert->setTitle('Here is my message title');
$alert->setSubtitle('Here is my message subtitle');

// We'll send to ios devices for this example.
$ios = new \Frequency\Localytics\Push\Message\IosMessage();
$ios->setCategory('myCategory');
$ios->setBadge(1);
$ios->setLlAttachmentUrl('https://example.com/attachment.jpg');
$ios->setLlDeepLinkUrl('https://someurl.com/deeplink');

// Build Target object for message.
$target_obj = new \Frequency\Localytics\Push\Target\TargetObject('audience_id', '1234');

// Build message object.
$message = new \Frequency\Localytics\Push\Message\LocalyticsMessage();
// set the message alert object.
$message->setAlert($alert);
// set the message target object
$message->setTarget($target_obj);
// Set the message ios object.
$message->setIos($device_obj);

// Add the message object.  If our target is 'customer_id', then we can add
// multiple message objects.  Otherwise Localytics limits this to one.
$messages->addMessage($message);

// Build our account object.
$account = new \Frequency\Localytics\API\LocalyticsAccountBase($api_key, $api_secret);
$app_id = 'some-app-id-12345';
// (Optional)
$request_id = 'some-unique-messageidentifier';
// (Optional)
$campaign_key = 'campaign_name';

// Build our Push Message object.
$push = new \Frequency\Localytics\Push\LocalyticsPushNotification($account, $messages, $target_obj->getType(), $app_id, $request_id, $campaign_key);

// Send Push Notification.
$response = $push->pushMessages();
```
