<?php
require('./DatabaseConnection.php');

class EventModel {
  public $conn;
  private $table;

  public function __construct(){
    $database = new DatabaseConnection();
    $this->conn = $database->connect();
    $this->table = 'Event';
  }

  public function insertEvent($eventData) {
    if (empty($eventData)) {
      return false;
    }

    $query = "INSERT INTO
                {$this->table}
              (
                `idCity`,
                `name`,
                `state`,
                `country`,
                `temperature`,
                `wind_direction`,
                `wind_velocity`,
                `humidity`,
                `condition`,
                `pressure`,
                `icon`,
                `sensation`,
                `date`
              )
                VALUES
              (
                {$eventData->idCity},
                '{$eventData->name}',
                '{$eventData->state}',
                '{$eventData->country}',
                '{$eventData->temperature}',
                '{$eventData->wind_direction}',
                '{$eventData->wind_velocity}',
                '{$eventData->humidity}',
                '{$eventData->condition}',
                '{$eventData->pressure}',
                '{$eventData->icon}',
                '{$eventData->sensation}',
                '{$eventData->date}'
              )";

    $stmt = $this->conn->prepare($query);
    $result = $stmt->execute();
    return $result;
  }
}

?>
