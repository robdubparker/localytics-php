<?php

namespace Plinthify\Localytics\Exports;

use Plinthify\Localytics\API\LocalyticsAccountBase;
use Plinthify\Localytics\Export\LocalyticsExportInterface;

class ProfileExport extends LocalyticsExport implements LocalyticsExportInterface{

  /**
   * @var integer
   */
  public $profile_id;
  /**
   * @var string
   * @options
   *   'profile': Export of entire Profile set
   *   'profile_changes': Export of changes since last request
   */
  public $profile_type;

  public function __construct(LocalyticsAccountBase $account, $type = 'profile', $id) {
    parent::__construct($account);
    $this->uri = rtrim($this->uri, '/') . '/profiles';
    if (!empty($type) && !empty($id)) {
      $this->profile_id = $id;
      $this->profile_type = $type;
      $this->uri = $this->uri . '/' . $id . '/' . $type;
    }
  }

}