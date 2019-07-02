<?php
  include "src/lib.php";
  $test = $Object->clone();
  $test->test = function($self){echo "Hello " . $self->name;};
  $test->name = "John";
  $test->test();

  $testb = $test->clone();
  $testb->test = function($self){echo "Salut " . $self->name;};
  $testb->test();

  $Range = $Object->clone();
  $Range->max = 10;
  $Range->min = 0;
  $Range->include = function($self, $value)
  {
    return ($self->max > $value) && ($self->min <= $value);
  };
  if ($Range->include(5))
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
  $ran = $Range->make(0, 100);
  if ($ran->include(5))
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
