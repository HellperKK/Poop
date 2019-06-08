<?php
  include "src/lib.php";
  $test = $Object->clone();
  $test->test = function($self){echo "Hello " . $self->name->identity();};
  $test->name = $String->from("John");
  $test->test();

  $testb = $test->clone();
  $testb->test = function($self){echo "Salut " . $self->name->identity();};
  $testb->test();

  $Range = $Object->clone();
  $Range->max = $Int->from(10);
  $Range->min = $Int->from(0);
  $Range->include = function($self, $value)
  {
    $value = $value->identity();
    return ($self->max->identity() > $value) && ($self->min->identity() <= $value);
  };
  if ($Range->include($Int->from(5)))
  {
    echo "It is included !";
  }
  else
  {
    echo "It is not included !";
  }
  $Range->make = function($self, $min, $max)
  {
    $new = $self->clone();
    $new->min = $min;
    $new->max = $max;
    return $new;
  };
  $ran = $Range->make($Int->from(0), $Int->from(100));
  if ($ran->include($Int->from(5)))
  {
    echo "It is included !";
  }
  else
  {
    echo "It is not included !";
  }

  $Greeter = $Object->clone();
  $Greeter->greet = function($self)
  {
    echo "Hello " . $self->name . " !";
  };
  $Greeter->make = function($self, $name)
  {
    $inst = $self->clone();
    $inst->name = $name;
    return $inst;
  };
  $greet = $Greeter->make("world");
  $greet->greet();
?>
