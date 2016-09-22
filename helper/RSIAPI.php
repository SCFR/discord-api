<?php namespace SCFRDiscord\helper;
  class RSIAPI {
    public static function get_latest_org_info($target, $end_date = 0, $target_2 = 1) {
      require_once(dirname(__FILE__)."/../../../../API/RSI/sc_api/database_layer/DBInterface.php");

      if($end_date === 0) $end_date = time();
      $db = new \thalos_api\DBInterface();
      $db->Connect();
      return self::httpsIze($db->RebuildHistory(\thalos_api\TableDirectory::RSIOrgsInfoTable, $target, $end_date)[0]);
    }

    private static function httpsIze($data) {
      foreach($data as &$val) {
        if(strpos($val, "http://robertsspaceindustries") === 0) $val = str_replace("http://robertsspaceindustries", "https://robertsspaceindustries", $val);
      }
      return $data;
    }

  }
?>
