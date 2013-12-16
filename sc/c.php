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
require(CORE_DIR . 'init.php');

/**
class c {
  private $argv;
  public function __construct($argv){
    $this->argv = $argv;
    $this->_sudo();
  }

  private function _sudo(){
    $cmd = "sudo echo 'test' > /dev/null";
    exec($cmd, $res, $rc);
    return true;
  }
}
new c($argv);
**/