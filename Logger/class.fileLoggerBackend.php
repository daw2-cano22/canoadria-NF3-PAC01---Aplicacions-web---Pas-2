<?php

include_once("class.Logger.php");

class fileLoggerBackend extends Logger {
  //Note: private constructor.  Class uses the singleton pattern
  public function __construct() {
    
    //This is pseudo code that fetches a hash of configuration information
    //Implementation of this is left to the reader, but should hopefully
    //be quite straight-forward.
    $this -> cfg = new Config();

    $this -> CargarFichero();
  }


  public function CargarFichero(){
	  

    /* If the config establishes a level, use that level,
       otherwise, default to INFO
    */
    $this->logLevel = $this -> cfg->getConfigLevel();
	$this->logFile = $this -> cfg->getConfigFile();
	echo "file: ".$this->logFile."<br>";

    //We must specify a log file in the config
    if(!(isset($this->logFile) && strlen($this->logFile)) ) {
      throw new Exception('No log file path was specified in the system configuration.');
    }
     
    $this->confile = @fopen($this->logFile, 'a+');
    
    if(!is_resource($this->confile)) {
      throw new Exception("The log file does not exist: ".$this -> logFile. ' or could not be opened. Check file permissions.');
    }
  }

  public function logData(){
    fwrite($this->confile, "logfile1\r\n");
    fwrite($this->confile, "logfile2\r\n");
    fwrite($this->confile, "logfile3\r\n");
  }
}
?>
