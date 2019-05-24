<?php
  /**
   * Classe qui definit une instance
   */
  class Instance
  {
    function __construct($prototype)
    {
      $this->prototype = $prototype;
    }

    function __call($name, $args)
    {
      foreach($args as $key => $val)
      {
        if ($val instanceof Instance)
        {
          $args[$key] = $val->identity();
        }
      }
      array_unshift($args, $this);
      if (isset($this->$name))
      {
        return ($this->$name)(...$args);
      }
      else
      {
        $inst = $this->prototype;
        while (isset($inst) && (! isset($inst->$name)))
        {
          $inst = $inst->prototype;
        }
        if (isset($inst->$name))
        {
          return ($inst->$name)(...$args);
        }
        else
        {
          throw new Exception('Method not found -> ' . $name);
        }
      }
    }

    function clone()
    {
      return new Instance($this);
    }
  }

?>
