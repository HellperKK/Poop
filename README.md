# Poop
Poop (Php's Object Oriented Project) is an experiment for classless
object oriented programming.

It is highly inspired of javascript and python and also IO.

# How to use
## Create in instance

You create an instance by cloning another one, like the object instance
```
include "src/lib.php";
$Range = $Object->clone();
```

Then you can add attributes and methods like this. Like in python, a method's
first agrument must reference the instance itself so there is no more `this`
keyword.

```
$Range->max = 10;
$Range->min = 0;
$Range->include = function($self, $value)
{
  $value = $value->identity();
  return ($self->max > $value) && ($self->min <= $value);
};
```

Some already-defined instances are made to create instances like `$Int`, with the method from.

```
if ($Range->include($Int->from(5)))
{
  echo "It is included !";
}
else
{
  echo "It is not included !";
}
```
In fact, `$Int` is instance that can generate a wrapper to hold an int from php's
primitives. But you don't need to know where that int is located. Each Instance
has an `identity` method that return itself by default and that has been overriden in `$Int` to return the value it holds.
This is also true for strings, floats and booleans.
