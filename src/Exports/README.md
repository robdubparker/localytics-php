# Example EXPORT use for Audience info:

```
// Build our account object.
$account = new \Plinthify\Localytics\API\LocalyticsAccountBase($api_key, $api_secret);

$audiences = new \Plinthify\Localytics\Exports\AudienceExports($account);
// Will return results for all available audiences.
$export1 = $audiences->getExport();

$audiences = new \Plinthify\Localytics\Exports\AudienceExports($account, 'idfa', '1234');
// Will return idfa results in JSON format for specific audience id.
$export2 = $audiences->getExport();

```