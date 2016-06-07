<?php
require_once('lib/ext/vendor/autoload.php');

use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\DeviceParserAbstract;

class Client {
  private $sessionId;
  private $ipAddress;
  private $country;
  private $region;
  private $city;
  private $latitude;
  private $longitude;
  private $dd;
  private $isBot;
  private $userAgentPlain;
  private $userAgentDetails = array();

  function __construct($sessionId) {
    $this->sessionId = $sessionId;
    $this->setIpAddress();
    $this->setGeoLocation();
    $this->userAgentPlain = $_SERVER['HTTP_USER_AGENT'];
    $this->dd = new DeviceDetector($this->userAgentPlain);
    //TODO: fix cache
    //$this->dd->setCache(new Doctrine\Common\Cache\PhpFileCache($location.'tmp/'));
    $this->dd->parse();
    $this->isBot = $this->dd->isBot();

    if (!$this->isBot) {
      $this->setUserAgentDetails();
    }
  }

  public function isBot () {
    return $this->isBot;
  }

  public function getSessionId () {
    return $this->sessionId;
  }

  public function getIpAddressLong () {
    //The value looks something like: 1073732954
    $ipLong = sprintf("%u", ip2long($this->ipAddress));
    return $ipLong;
  }

  public function getIpAddress () {
    return $this->ipAddress;
  }

  public function getCountry () {
    return $this->country;
  }

  public function getRegion () {
    return $this->region;
  }

  public function getCity () {
    return $this->city;
  }

  public function getLatitude () {
    return $this->latitude;
  }

  public function getLongitude () {
    return $this->longitude;
  }

  public function getUserAgentPlain () {
    return $this->userAgentPlain;
  }

  public function getClientInfo () {
    return count($this->userAgentDetails)!==0 ? $this->userAgentDetails['client'] : null;
  }

  public function getOsInfo () {
    return count($this->userAgentDetails)!==0 ? $this->userAgentDetails['os'] : null;
  }

  public function getDeviceInfo () {
    return count($this->userAgentDetails)!==0 ? $this->userAgentDetails['device'] : null;
  }

  private function setIpAddress () {
    $ipAddress =  getenv('HTTP_CLIENT_IP')?:
                  getenv('HTTP_X_FORWARDED_FOR')?:
                  getenv('HTTP_X_FORWARDED')?:
                  getenv('HTTP_FORWARDED_FOR')?:
                  getenv('HTTP_FORWARDED')?:
                  getenv('REMOTE_ADDR');

    $isValid = filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    if (!$isValid) {
      $ipAddress = "0.0.0.0";
    }

    $this->ipAddress = $ipAddress;
  }

  private function setGeoLocation () {
    $geoDetails = json_decode(file_get_contents("http://ipinfo.io/".$this->ipAddress."/json"));
    // set geographical info
    $this->country = isset($geoDetails->country) ? $geoDetails->country : "XY";
    $this->region = isset($geoDetails->region) ? $geoDetails->region : "unknown";
    $this->city = isset($geoDetails->city) ? $geoDetails->city : "unknown";
    $coordinates = isset($geoDetails->loc) ? explode(',',$geoDetails->loc) : array (0,0);
    $this->latitude = $coordinates[0];
    $this->longitude = $coordinates[1];
  }

  private function setUserAgentDetails () {
    $clientInfo = $this->dd->getClient(); // holds information about browser, feed reader, media player, ...
    $osInfo = $this->dd->getOs();
    $deviceType = $this->dd->getDeviceName();
    $brandName = $this->dd->getBrandName();
    $model = $this->dd->getModel();
    $this->userAgentDetails = array (
      'client' => array (
            'type' => $clientInfo['type'],  // e.g. browser
            'name' => $clientInfo['name'],  // e.g. Chrome Mobile
            'version' => $clientInfo['version'], // e.g. 33.0.1750.136
            'engine' => $clientInfo['engine'], // e.g. Blink
      ),

      'os' => array (
          'name' => $osInfo['name'], // e.g. Android
          'version' => $osInfo['version'], // e.g. 4.4.2
      ),

      'device' => array (
          'type' => $deviceType, // e.g. smartphone
          'brand' => $brandName, // e.g. Google
          'model' => $model, // e.g. Nexus 4
      )
    );
  }


  // static functions

  public static function isKnown ($client) {
    $sql = "SELECT session_id, timestamp FROM client_connections WHERE session_id = '".$client->getSessionId()."' AND TIMESTAMPDIFF(HOUR,timestamp,NOW()) < 3";
    $res = DB::doQuery($sql);

    return $res!==null && $res->num_rows !== 0;
  }

  public static function save ($client) {
    if ($client->isBot()) { // bot client
      $sql = "INSERT INTO client_connections (session_id, ip_address, http_user_agent, is_bot) VALUES ('".$client->getSessionId()."', '".$client->getIpAddressLong()."', '".$client->getUserAgentPlain()."', TRUE)";
    } else { // normal client
      $clientInfo = $client->getClientInfo();
      $osInfo = $client->getOsInfo();
      $deviceInfo = $client->getDeviceInfo();
      $sql = "INSERT INTO client_connections (session_id, ip_address, country, region, city, latitude, longitude, http_user_agent, is_bot, client_type, client_name, client_version, client_engine, os_name, os_version, device_type, device_brand, device_model) VALUES ('".$client->getSessionId()."', '".$client->getIpAddress()."', '".$client->getCountry()."', '".$client->getRegion()."', '".$client->getCity()."', '".$client->getLatitude()."', '".$client->getLongitude()."', '".$client->getUserAgentPlain()."', FALSE, '".$clientInfo['type']."', '".$clientInfo['name']."', '".$clientInfo['version']."', '".$clientInfo['engine']."', '".$osInfo['name']."', '".$osInfo['version']."', '".$deviceInfo['type']."', '".$deviceInfo['brand']."', '".$deviceInfo['model']."')";
    }
    $res = DB::doQuery($sql);
    return isset($res) && $res !== null;
  }

}
