<?php
include "instance.php";
$Primitive = Instance::object()->clone();

$Primitive->from = function ($self, $value) {
  $val = $self->clone();
  $val->value = $value;
  return $val;
};

$String = $Primitive->clone();
$String->from = function ($self, string $value) {
  return ($self->prototype->from)($self, $value);
};

$Bool = $Primitive->clone();
$Bool->from = function ($self, bool $value) {
  return ($self->prototype->from)($self, $value);
};

$Int = $Primitive->clone();
$Int->from = function ($self, int $value) {
  return ($self->prototype->from)($self, $value);
};

$Float = $Primitive->clone();
$Float->from = function ($self, float $value) {
  return ($self->prototype->from)($self, $value);
};
