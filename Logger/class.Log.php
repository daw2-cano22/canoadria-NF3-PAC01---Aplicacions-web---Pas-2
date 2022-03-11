<?php

include_once("abstract.databoundobject.php");

class Log extends DataBoundObject {

        protected $Msg;

        protected function DefineTableName() {
                return('logs');
        }

        protected function DefineRelationMap() {
                return(array("id" => "ID", "msg" => "Msg"));
        }
}
?>
