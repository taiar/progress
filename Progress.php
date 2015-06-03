<?php

  class Progress {

    private $progress_bar_size = 100;
    private $progress_bar_cell = "=";

    private $label_action_description = "executando acao";

    private $data;
    private $data_count;
    private $action_counter = 0;
    private $progress_percentage;

    public function __construct() {
    }

    public function set_progress_bar_size($pbs) {
      $this->progress_bar_size = $pbs;
    }

    public function set_progress_bar_cell($pbc) {
      $this->progress_bar_cell = $pbc;
    }

    public function set_result($r) {
      $this->data = $r;
      $this->data_count = count($r);
    }

    private function progress_bar() {
      $r = "[";
      $n_bars = (($this->progress_percentage * $this->progress_bar_size) / 100);
      for ($i = 0; $i <= $n_bars; $i++) $r .= $this->progress_bar_cell;
      for ($j = 0; $j < $this->progress_bar_size - $n_bars; $j++) $r .= " ";
      return $r . "]";
    }

    private function progress() {
      $this->progress_percentage = number_format ((100 * $this->action_counter) / $this->data_count, 0);
      return $this->progress_bar() . " {$this->progress_percentage}% ";
    }

    private function write_output() {
      echo "\r{$this->progress()} | {$this->label_action_description} {$this->action_counter} de {$this->data_count}";
    }

    private function reset_counters() {
      $this->action_counter       = 0;
      $this->progress_percentage  = 0;
      echo PHP_EOL;
    }

    public function exec() {
      foreach ($this->data as $evento) {
        ++$this->action_counter;
        $this->write_output();
      }
      $this->reset_counters();
    }

    // The end...
  }
