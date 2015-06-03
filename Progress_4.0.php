<?php

  class Progress {

    var $progress_bar_size = 30;
    var $progress_bar_cell = "=";

    var $label_action_description = "executando acao";

    var $data;
    var $data_count;
    var $action_counter = 0;
    var $progress_percentage;

    function __construct() {
    }

    function set_progress_bar_size($pbs) {
      $this->progress_bar_size = $pbs;
    }

    function set_progress_bar_cell($pbc) {
      $this->progress_bar_cell = $pbc;
    }

    function set_result($r) {
      $this->data = $r;
      $this->data_count = count($r);
    }

    function progress_bar() {
      $r = "[";
      $n_bars = (($this->progress_percentage * $this->progress_bar_size) / 100);
      for ($i = 0; $i <= $n_bars; $i++) $r .= $this->progress_bar_cell;
      for ($j = 0; $j < $this->progress_bar_size - $n_bars; $j++) $r .= " ";
      return $r . "]";
    }

    function progress() {
      $this->progress_percentage = number_format ((100 * $this->action_counter) / $this->data_count, 0);
      return $this->progress_bar() . " " . $this->progress_percentage . "% ";
    }

    function write_output() {
      echo "\r" . $this->progress() . " | " . $this->label_action_description. " " . $this->action_counter. " de " . $this->data_count;
    }

    function reset_counters() {
      $this->action_counter       = 0;
      $this->progress_percentage  = 0;
      echo PHP_EOL;
    }

    function exec() {
      foreach ($this->data as $evento) {
        ++$this->action_counter;
        $this->write_output();
      }
      $this->reset_counters();
    }

    // The end...
  }
