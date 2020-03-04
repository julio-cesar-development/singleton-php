<?php
class HttpHandler {
  public static function doRequest(string $url) {
    if (empty($url)) {
      return false;
    }
    $data = file_get_contents($url);
    if (empty($data)) {
      return false;
    }
    return json_decode($data, true);
  }
}

?>
