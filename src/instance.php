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
      array_unshift($args, $this);
      if (isset($this->$name))
      {
        ($this->$name)(...$args);
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
          ($inst->$name)(...$args);
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
