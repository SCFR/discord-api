<?php namespace SCFRDiscord\helper;
  class APIReturn {
    public static function message($msg = "OK", $error = false) {
      return array(
        "msg" => $error ? $error : $msg,
        "error" => $error ? true : false,
      );
    }
  }
?>
