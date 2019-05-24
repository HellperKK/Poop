<?php
  include "src/lib.php";
  $test = $Object->clone();
  $test->test = function($self, $name){echo "Hello " . $name;};
  $test->test($String->from("John"));

  $Range = $Object->clone();
  $Range->max = 10;
  $Range->min = 0;
  $Range->include = function($self, $value)
    {
      return ($self->max > $value) && ($self->min <= $value);
    };
  if ($Range->include($Int->from(5)))
  {
    echo "It is included !";
  }
  else
  {
    echo "It is not included !";
  }
?>
