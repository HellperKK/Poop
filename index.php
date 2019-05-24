<?php
  include "src/instance.php";
  $test = new Instance(Null);
  $test->test = function($self, $name){echo "Hello " . $name;};
  $test->test("John");

  $testb = new Instance($test);
  $testb->test("Paul");

  $testc = new Instance(Null);
  $testc->test = $test->test;
  $testc->test("Jacques");
?>
