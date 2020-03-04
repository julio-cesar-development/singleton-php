<?php
require('./Singleton.php');
require('./HttpHandler.php');
require('./EventModel.php');

class EventSingleton extends Singleton {
  public static $token;
  private static $json_data_city_id;
  private static $city_id;
  private static $json_data_weather;
  private static $event;
  private static $api_url = 'http://apiadvisor.climatempo.com.br/api/v1';

  public static function setToken(string $token) : void {
    self::$token = $token;
  }

  public static function getCityId(string $city, string $state) : int {
    $token = self::$token;
    // Get city id
    self::$json_data_city_id = HttpHandler::doRequest(self::$api_url . "/locale/city?name=${city}&state=${state}&token=${token}");

    self::$city_id = !empty(self::$json_data_city_id) && !empty(self::$json_data_city_id[0]) && !empty(self::$json_data_city_id[0]['id']) ?
    self::$json_data_city_id[0]['id'] : 0;
    // Returns the id from $city
    return intval(self::$city_id);
  }

  public static function getWeatherByCityId(int $city_id) : object {
    if (empty($city_id)) {
      return (object) [];
    }

    $token = self::$token;
    // Get data from selected city
    self::$json_data_weather = HttpHandler::doRequest(self::$api_url . "/weather/locale/${city_id}/current?token=${token}");

    // Creating object $event
    self::$event = (object) [
      'idCity' =>         $city_id,
      'name' =>           self::$json_data_weather['name'],
      'state' =>          self::$json_data_weather['state'],
      'country' =>        self::$json_data_weather['country'],
      'temperature' =>    self::$json_data_weather['data']['temperature'],
      'wind_direction' => self::$json_data_weather['data']['wind_direction'],
      'wind_velocity' =>  self::$json_data_weather['data']['wind_velocity'],
      'humidity' =>       self::$json_data_weather['data']['humidity'],
      'condition' =>      self::$json_data_weather['data']['condition'],
      'pressure' =>       self::$json_data_weather['data']['pressure'],
      'icon' =>           self::$json_data_weather['data']['icon'],
      'sensation' =>      self::$json_data_weather['data']['sensation'],
      'date' =>           self::$json_data_weather['data']['date'],
    ];

    return (object) self::$event;
  }

  public static function humanReadableResponse($event_data) : void {
    $city = trim($event_data->name);
    $state = trim($event_data->state);
    $country = trim($event_data->country);
    $condition = trim(strtolower($event_data->condition));

    print_r("Na cidade de {$city} no estado {$state} - {$country}, o clima é {$condition}, fazendo {$event_data->temperature} ºC com sensação térmica de {$event_data->sensation} ºC");
  }
}

// Set the static Token of Event Class
$token = !empty($_ENV['token']) ? $_ENV['token'] : 'bcb1d96f129d5526aeece4f6a18d356c';
EventSingleton::setToken($token);

// Instanciate class Event with getInstance, to use the Singleton pattern
$event = EventSingleton::getInstance();

// Get the ID from city CURITIBA
$city_id = EventSingleton::getCityId('CURITIBA', 'PR');
var_dump($city_id);

// Get the data object with respective weather for CURITIBA
$event_data = EventSingleton::getWeatherByCityId($city_id);

// Print the result data
var_dump($event_data);

// call the human readable method
EventSingleton::humanReadableResponse($event_data);

// Saving to DB
$model = new EventModel();
$insert = $model->insertEvent($event_data);

?>
