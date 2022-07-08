<?php

namespace System\Database\Traits;

trait HasMethodCaller
{

  private $allMethods = ['create', 'update', 'delete', 'deleteBySlug', 'find', 'findBySlug', 'all', 'total', 'save', 'where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate', 'count'];
  private $allowedMethods = ['create', 'update', 'delete', 'deleteBySlug', 'find', 'findBySlug', 'all', 'total', 'save', 'where', 'whereOr', 'whereIn', 'whereNull', 'whereNotNull', 'limit', 'orderBy', 'get', 'paginate', 'count'];

  public function __call($method, $args)
  {
    return $this->methodCaller($this, $method, $args);
  }

  public static function __callStatic($method, $args)
  {
    $className = get_called_class();
    $instance = new $className;
    return $instance->methodCaller($instance, $method, $args);
  }

  private function methodCaller($object, $method, $args)
  {
    $suffix = 'Method';
    $methodName = $method . $suffix;
    if (in_array($method, $this->allowedMethods)) {
      return call_user_func_array(array($object, $methodName), $args);
    }
  }
  protected function setAllowedMethods($array)
  {
    $this->allowedMethods = $array;
  }
}
