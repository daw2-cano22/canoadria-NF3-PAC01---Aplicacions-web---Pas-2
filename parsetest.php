<?php
$urls = [
    'http://www.example.com/',
    'http://www.example.com',
    'http://www.example.com/test/.jpg',
    'http://www.example.com/test/.',
    'https://anonymous:dCU7egW1A1L0a6pxU3qu9@www.example.com:8080/path/to/directory/file.jpeg?param1=foo&param2=bar&param3[1]=abc&param3[2]=def#anchor',
    'ftp://anonymous@ftp.example.com/pub/test.jpg',
    'file:///home/user/.config/test.config',
    'chrome://settings/passwords',
    'postgres://postgres:root@localhost:5432/db'
];

foreach ($urls as $url) {    
    try{
        $urlData = parse_url($url);
    
        if(!isset($urlData['scheme'])){
            throw new Exception("connection string log $connectionString");
        }
    
        @include_once('Logger/class.' . $urlData['scheme'] . 'LoggerBackend.php');
    
        $className = $urlData['scheme'] . 'LoggerBackend';
    
        if(!class_exists($className)){
            throw new Exception('No logging backend available for ' . $urlData['scheme']);
        }
    
        $objBack = new $className($urlData);

        $objBack -> logData();
        $objBack -> logMessage('testHOLA');
        echo "<br />";
        
    } catch (Exception $e){
        echo $e . "<br />";
    }
}
?>
