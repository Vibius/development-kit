<?php
    
use Vibius\Facade\Facade;
use Vibius\Facade\Interfaces\FacadeInterface;

class container extends Facade implements FacadeInterface{
    
    public static function getFacadeIdentifier(){
        return new \Vibius\Container\Container;
    }

}
