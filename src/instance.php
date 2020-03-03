<?php
  /**
   * Classe qui definit une instance
   */
  class Instance
  {
    private static $object = null;

    public $prototype;
    public $slots;

    private function __construct($prototype)
    {
      $this->prototype = $prototype;
      $this->slots = [];
    }

    function object()
    {
      if (! isset(self::$object))
      {
        $object = new Instance(null);
        self::$object = $object;
      }
      return self::$object;
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
      return $this->slots[$name] = $value;
    }

    function __isset($name)
    {
      try 
      {
        $this->look_for($name);
        return true;
      } 
      catch (\Throwable $th)
      {
        return false;
      }
    }

    function __unset($name)
    {
      unset($this->slots[$name]);
    }

    function __toString()
    {
      try 
      {
        return $this->toString();
      } 
      catch (\Throwable $th) 
      {
        return "";
      }
    }

    function __invoke(...$args)
    {
      $this->call(...$args);
    }

    function look_for($name)
    {
      if (isset($this->slots[$name]))
      {
        return $this->slots[$name];
      }
      else
      {
        $inst = $this->prototype;
        while (isset($inst) && (! isset($inst->slots[$name])))
        {
          $inst = $inst->prototype;
        }
        if (isset($inst->slots[$name]))
        {
          return $inst->slots[$name];
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
