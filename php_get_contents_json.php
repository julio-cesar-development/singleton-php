<?php
  // Simple implementation without Singleton pattern

  // variables definition
  $token = 'bcb1d96f129d5526aeece4f6a18d356c';
  $api_url_city = "http://apiadvisor.climatempo.com.br/api/v1/locale/city?name=cURITIBA&state=PR&token=$token";

  // get city id
  $json_file_city = file_get_contents($api_url_city);
  $json_data = json_decode($json_file_city, true);
  $city_id = $json_data[0]['id'];

  // get data from selected city
  $api_url_weather = "http://apiadvisor.climatempo.com.br/api/v1/weather/locale/$city_id/current?token=$token";
  $json_file_city = file_get_contents($api_url_weather);
  $json_data = json_decode($json_file_city, true);

  // cerating object $event
  $event = (object) [
    'idCity' =>           $city_id,
    'name' =>             $json_data['name'],
    'state' =>            $json_data['state'],
    'country' =>          $json_data['country'],
    'temperature' =>      $json_data['data']['temperature'],
    'wind_direction' =>   $json_data['data']['wind_direction'],
    'wind_velocity' =>    $json_data['data']['wind_velocity'],
    'humidity' =>         $json_data['data']['humidity'],
    'condition' =>        $json_data['data']['condition'],
    'pressure' =>         $json_data['data']['pressure'],
    'icon' =>             $json_data['data']['icon'],
    'sensation' =>        $json_data['data']['sensation'],
    'date' =>             $json_data['data']['date'],
  ];

  var_dump($event);
?>
