<?php
    
use Vibius\Facade\Facade;
use Vibius\Facade\Interfaces\FacadeInterface;

class config extends Facade implements FacadeInterface{
    
    public static function getFacadeIdentifier(){
        return new \Vibius\ConfigResolver\ConfigResolver;
    }

}
