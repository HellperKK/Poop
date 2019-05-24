<?php
  include "../src/lib.php";
  $test = new Instance(Null);
  $test->test = function($self, $name){echo "Hello " . $name;};
  $test->test("John");

  $testb = $test->clone();
  $testb->test("Paul");

  $testd = $testb->clone();
  $testd->test("Paul");

  $testc = new Instance(Null);
  $testc->test = $test->test;
  $testc->test("Jacques");
?>
