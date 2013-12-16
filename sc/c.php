<?php
define('NOW', time());
define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_DIR',  ROOT_DIR . 'app'  . DIRECTORY_SEPARATOR);
define('CONF_DIR', ROOT_DIR . 'conf' . DIRECTORY_SEPARATOR);
define('CORE_DIR', ROOT_DIR . 'core' . DIRECTORY_SEPARATOR);
define('LANG_DIR', ROOT_DIR . 'lang' . DIRECTORY_SEPARATOR);
define('LIB_DIR',  ROOT_DIR . 'lib'  . DIRECTORY_SEPARATOR);
define('LOG_DIR',  ROOT_DIR . 'log'  . DIRECTORY_SEPARATOR);

require(CORE_DIR . 'load.php');

class c {
  public function __construct(){
    $this->_sudo();
    $this->_init();
    $this->_ps();
    for($i=0;;$i++){
      $this->start();
    }
  }

  private function _sudo(){
    $cmd = "sudo echo 'test' > /dev/null";
    exec($cmd, $res, $rc);
    return true;
  }

  private function _init(){
    if(!is_dir(LOG_DIR)){
      if(!touch(LOG_DIR)){
        $errorInfo = lang::instance()->bind(array('logdir' => LOG_DIR))->get(0);
        KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
        echo $errorInfo . "\n";exit;
      }
    }
    if(!is_writable(LOG_DIR)){
      $errorInfo = lang::instance()->bind(array('logdir' => LOG_DIR))->get(1);
      KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
      echo $errorInfo . "\n";exit;
    }
    return true;
  }

  private function _ps(){
    $cmd = 'ps aux | grep c.php';
    exec($cmd, $res, $rc);
    print_r($res);
  }

  public function start(){

  }
}
new c();