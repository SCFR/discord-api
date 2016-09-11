<?php namespace SCFRDiscord\helper;
  class APIReturn {
    public static function message($msg = "OK", $error = false) {
      return array(
        "msg" => $error ? $error : $msg,
        "error" => $error ? true : false,
      );
    }

    public static function try_function($callable, $args = null) {
      $error = $return = null;
      try{$return = call_user_func($callable, $args);}
      catch(\Exception $e) {$error = $e->getMessage();}
      finally{
        return SELF::message($return, $error);
      }
    }
  }
?>
