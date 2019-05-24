<?php
  include "instance.php";
  $Object = new Instance(null);
  $Object->identity = function($self)
    {
      return $self;
    };

  $Primitive = $Object->clone();
  $Primitive->identity = function($self)
    {
      return $self->value;
    };
  $Primitive->from = function($self, $chaine)
    {
      $val = $self->clone();
      $val->value = $chaine;
      return $val;
    };

  $String = $Primitive->clone();
  $Int = $Primitive->clone();

?>
