<?php
class conf {
  static private $_instance = null;
  static private $_name = null;
  static private $_file;
  private function __construct($name){
    $filename = CONF_DIR . $name . '.json';
    if(!is_file($filename)){
      if(!touch($filename)){
        $errorInfo = "can't create conf file $filename.\n";
        KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
        echo $errorInfo;exit;
      }
    }
    if(!is_readable($filename) || !is_writable($filename)){
      $errorInfo = "conf file $filename can't readable or writable.\n";
      KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
      echo $errorInfo;exit;
    }
    self::$_file = $filename;
    return true;
  }

  static public function instance($name){
    if(self::$_name == $name){
      if(self::$_instance == null){
        self::$_instance = new self($name);
      }
    } else {
      self::$_name = $name;
      self::$_instance = new self($name);
    }
    return self::$_instance;
  }

  public function get($key = null){
    $content = file_get_contents(self::$_file);
    $content = empty($content) ? array() : json_decode($content, true);
    if($key == null){
      return $content;
    }
    return isset($content[$key]) ? $content[$key] : null;
  }

  public function set($key, $val){
    $content = $this->get();
    $content[$key] = $val;
    $content = json_encode($content);
    return file_put_contents(self::$_file, $content) > 0;
  }

  public function put($data){
    if(empty($data)){
      return false;
    }
    $content = json_encode($data);
    return file_put_contents(self::$_file, $content) > 0;
  }
}