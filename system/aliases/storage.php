<?php
    
use Vibius\Facade\Facade;
use Vibius\Facade\Interfaces\FacadeInterface;

class storage extends Facade implements FacadeInterface{
    
    public static function getFacadeIdentifier(){
        return new PlaceHolderClass;
    }

}
