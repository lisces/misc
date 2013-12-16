<?php
class lang {
  static private $_instance;
  static private $_name;
  static private $_file;
  private $bind;
  private $isbind;
  private function __construct($name){
    if(!is_dir(LANG_DIR) || !is_readable(LANG_DIR)){
      $errorInfo = LANG_DIR . " not exists or can't readable.\n";
      KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
      echo $errorInfo;exit;
    }
    $filename = LANG_DIR . $name . '.json';
    if(!is_file($filename)){
      if(!touch($filename)){
        $errorInfo = "can't create lang file $filename.\n";
        KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
        echo $errorInfo;exit;
      }
    }
    if(!is_readable($filename) || !is_writable($filename)){
      $errorInfo = "lang file $filename can't readable or writable.\n";
      KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
      echo $errorInfo;exit;
    }
    self::$_name = $name;
    self::$_file = $filename;
    return true;
  }

  static public function instance(){
    $name = conf::instance('system')->get('lang');
    $name = $name == null ? 'en' : $name;
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

  public function build($data){
    $files = $this->_all();
    foreach($files as $lang){
      if(!isset($data[$lang])){
        echo "can't found language " . $lang . " in data.\n";
        exit;
      }
    }
    foreach($files as $lang){
      $filename = LANG_DIR . $lang . '.json';
      if(!is_file($filename)){
        if(!touch($filename)){
          echo "can't create $lang lang file.\n";
        }
      }
      $content = file_get_contents($filename);
      $content = empty($content) ? array() : json_decode($content, true);
      $content[] = $data[$lang];
      $content = json_encode($content);
      if(file_put_contents($filename, $content) < 1){
        echo "can't put data to " . $lang . " file.\n";
        exit;
      }
    }
    return true;
  }

  public function show($key, $newline = true){
    $lang = $this->get($key);
    $lang = $newline ? $lang . "\n" : $lang;
    echo $lang;
  }

  public function get($key){
    $content = file_get_contents(self::$_file);
    $content = empty($content) ? array() : json_decode($content, true);
    $lang = isset($content[$key]) ? $content[$key] : null;
    if($this->isbind){
      foreach($this->bind as $k => $v){
        $lang = strtr($lang, array('$'.$k => $v));
      }
    }
    return $lang;
  }

  public function bind($data){
    $this->isbind = true;
    $this->bind = $data;
    return $this;
  }

  private function _all(){
    $files = array();
    foreach(glob(LANG_DIR . '*.json') as $filename){
      $filearr = explode(DIRECTORY_SEPARATOR, $filename);
      $filename = $filearr[count($filearr) - 1];
      $files[] = substr($filename, 0, -5);
    }
    return $files;
  }
}