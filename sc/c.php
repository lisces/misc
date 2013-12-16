<?php
class c {
  private $argv;
  public function __construct($argv){
    $this->argv = $argv;
    $this->init();
  }

  public function init(){
    $cmd = "sudo echo 'test' > /dev/null";
    exec($cmd, $res, $rc);
    print_r($res);exit;
  }
}
new c($argv);