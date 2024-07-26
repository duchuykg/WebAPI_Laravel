<?php

namespace App\Services;

use Exception;
use App\Constants\ModelName;
use App\Services\Contracts\IService;

class ServiceFactory 
{
    public static function create(string $type) : IService {
        switch ($type){
            case ModelName::CATEGORY: 
                return new CategoryService(); 
            case ModelName::USER: 
                return new UserService();  
            case ModelName::POST: 
                return new PostService();    
            default:
                throw new Exception("Error " . $type . " Service"); 
        }
    }
}