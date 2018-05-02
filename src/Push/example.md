Structure Example (Push Notification):
{
    "request_id":"1234­1234­1234­1234",
    "target_type":"customer_id",
    "messages":[
        {
            "target":"user123",
            "alert":"Use APRIL-123 on your next order for 20% off",
            "ios":{
                "sound":"default.wav",
                "badge":1
            }
        },
        {
            "target":"user456",
            "alert":"Use APRIL-456 on your next order for 10% off",
            "ios":{
                "sound":"default.wav",
                "badge":1
            }
        }

    ]
}

// build new message object.
$message = new \Plinthify\Localytics\Push\Message\LocalyticsMessage();

// (required) build Alert object data for message.
$alert = new \Plinthify\Localytics\Push\Message\Alert();
// This is required.
$alert->setBody('body message text.');
// optional title
$alert->setTitle('this is a title');
// optional subtitle
$alert->setSubtitle('this is my subtitle');
// adds the alert object to the message.
$message->setAlert($alert);

$target_type = 'audience_id';
$target_data = '12345';
// (required) Build Target object for message.
$target_obj = new \Plinthify\Localytics\Push\Target\TargetObject($target_type, $target_data);
// adds the required target object data to the message
$message->setTarget($target_obj);

// (optional) build ios-specific
$ios = new \Plinthify\Localytics\Push\Message\IosMessage();
// ios category name
$ios->setCategory('category name');
$ios->setBadge(1);

$message->setIos(new \Plinthify\Localytics\Push\Message\IosMessage());

