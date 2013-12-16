<?php
spl_autoload_register(function($classname){
  if(class_exists($classname)){
    return true;
  }
  $classarr = explode('_', $classname);
  if(count($classarr) == 1){
    if($classname == ucfirst($classname)){ //lib
      $filename = LIB_DIR . $classname . DIRECTORY_SEPARATOR . $classname . '.php';
    } else { //core
      $filename = CORE_DIR . $classname . '.php';
    }
  } else {
    unset($classarr[count($classarr) - 1]);
    $classfile = implode('_', $classarr);
    $filename = APP_DIR . $classfile . '.php';
  }
  if(is_file($filename)){
    return require($filename);
  } else {
    $errorInfo = lang::instance()->bind(array('classname' => $classname))->get(2);
    KLogger::instance(LOG_DIR, 'error')->logError($errorInfo);
    echo $errorInfo . "\n";exit;
  }
});