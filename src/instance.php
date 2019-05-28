<?php
  /**
   * Classe qui definit une instance
   */
  class Instance
  {
    public $prototype;
    public $values;

    function __construct($prototype)
    {
      $this->prototype = $prototype;
      $this->values = [];
    }

    function __call($name, $args)
    {
      array_unshift($args, $this);

      $method = $this->look_for($name);
      return $method(...$args);
    }

    function __get($name)
    {
      return $this->look_for($name);
    }

    function __set($name, $value)
    {
      return $this->values[$name] = $value;
    }

    function look_for($name)
    {
      if (isset($this->values[$name]))
      {
        return $this->values[$name];
      }
      else
      {
        $inst = $this->prototype;
        while (isset($inst) && (! isset($inst->values[$name])))
        {
          $inst = $inst->prototype;
        }
        if (isset($inst->values[$name]))
        {
          return $inst->values[$name];
        }
        else
        {
          throw new Exception('Value not found -> ' . $name);
        }
      }
    }

    function clone()
    {
      return new Instance($this);
    }
  }

?>
