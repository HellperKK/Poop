# Poop
Poop (Php's Object Oriented Project) is an experiment for classless
object oriented programming.

It is highly inspired of javascript and python and also IO.

# How to use
## Create an instance

You create an instance by cloning another one, like the Object instance
```
include "src/lib.php";
$Range = $Object->clone();
```

Making this will allow range to inherit form all of Object's attributes.

## Add attributes and methods
Then you can add attributes and methods like this. Like in python, a method's
first agrument must reference the instance itself so there is no more `this`
keyword.

```
$Range = $Object->clone();
$Range->max = 10;
$Range->min = 0;
$Range->include = function($self, $value)
{
  return ($self->max > $value) && ($self->min <= $value);
};
```

In fact, min, max and include are not really attributes of the instance but
stored inside an attribute named `slots` that contains an array of every
attribute of the instance.

So getting a value or calling a method is in fact done using ghost methods
and attributes with the special methods `__get` and `__call`. This make
possible to search not only in the instance's slots but also in the slots on its
prototype in chain until there is not more parent instance, which allow for
inheritance.

## Generating instances
Making one range is fine, but it can be more efficient to use inheritance to generate different ranges.

```
$Range->make = function($self, $min, $max)
{
  $new = $self->clone();
  $new->min = $min;
  $new->max = $max;
  return $new;
};
```
With `$Range->make` we can now create new ranges with the same behaviour as
`$Range`.
