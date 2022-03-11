<?php

include_once("class.Logger.php");
include_once("class.Log.php");
include_once("class.pdofactory.php");

class postgresLoggerBackend extends Logger {
    public function __construct($urlData) {

        $dbName = ltrim($urlData["path"],'/');

        $strDSN = "pgsql:dbname=".$dbName.";host=".$urlData["host"].";port=".$urlData["port"];

        $this -> objPDO = PDOFactory::GetPDO($strDSN, $urlData["user"], $urlData["pass"], array());

        $this -> objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Postgres Log";
      }

      public function logData()
      {
        $objAddress = new Log($this -> objPDO);

        $objAddress->setMsg("logfile1")->Save();

        $objAddress1 = new Log($this -> objPDO);

        $objAddress1->setMsg("logfile2")->Save();

        $objAddress2 = new Log($this -> objPDO);

        $objAddress2->setMsg("logfile3")->Save();
      }
}
?>
