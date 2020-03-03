<?php
  include "src/lib.php";
  // lots of tests here

  // test of inheritance
  $test = Instance::object()->clone();
  $test->test = function($self){echo "Hello " . $self->name;};
  $test->name = "John";
  $test->test();

  $testb = $test->clone();
  $testb->test = function($self){echo "Salut " . $self->name;};
  $testb->test();

  // making a range
  $Range = Instance::object()->clone();
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

  // alloing it to generate ranges
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

  // same thing with a greeter
  $Greeter = Instance::object()->clone();
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

  // tests for __isset, __unset, __toString and __invoke
  var_export(isset($greet->name));
  var_export(isset($greet->forename));

  unset($greet->name);
  var_export(isset($greet->name));

  $greet->toString = function($self)
  {
    return "I can be displayed !";
  };

  echo $greet;
  echo $Greeter; //returns an empty string by default

  $greet->call = function($self)
  {
    echo "I can be called !";
  };

  $greet();
?>
