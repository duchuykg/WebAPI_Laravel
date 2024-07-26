<?php

namespace App\Repositories;

use Exception;
use App\Models\User;
use App\Constants\ModelName;
use App\Repositories\Contracts\IRepository;

class RepositoryFactory 
{
    public static function create($type) : IRepository {
        switch ($type){
            case ModelName::CATEGORY: 
                return new CategoryRepository(); 
            case ModelName::USER: 
                return new UserRepository();  
            case ModelName::POST: 
                return new PostRepository();       
            default:
                throw new Exception("Error " . $type . " Repository"); 
        }
    }
}