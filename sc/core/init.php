<?php
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