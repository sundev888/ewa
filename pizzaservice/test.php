<?php

try {

 echo (testt);
//  require_once unbedingt, sont bricht ab
// include '';  kann, falls kaputt, geht trzdem weiter
} catch (Exception $e) {
  echo "test";
}

echo <<<html

html;

?>
