<?php

  require_once("./Progress.php");


  $p = new Progress();

  $a = [];

  for ($i=0; $i < 3000; $i++) {
    $a[] = $i;
  }

  $p->set_result($a);
  $p->set_progress_bar_cell("+");

  echo "FAZENDO A COISA AQUI" . PHP_EOL;
  $p->exec();

  echo "FAZENDO A OUTRA COISA AQUI" . PHP_EOL;
  $p->exec();
