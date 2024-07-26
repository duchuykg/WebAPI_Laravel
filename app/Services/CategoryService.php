<?php

namespace App\Services;

use App\Validations\Rules;
use App\Constants\ModelName;
use App\Exceptions\NotFoundException;
use App\Utilities\Traits\ValidateAPI;
use App\Repositories\RepositoryFactory;
use App\Services\Contracts\ICategoryService;

class CategoryService implements ICategoryService
{
    use ValidateAPI;
    // protected CategoryRepository $categoryRepository;
    protected $categoryRepository;
    
    public function __construct(){
        $this->categoryRepository = RepositoryFactory::create(ModelName::CATEGORY);
    }

    public function getAll(){
        return $this->categoryRepository->getAll();
    }

    public function getById($id){
        $foundCategory = $this->categoryRepository->getById($id);

        if ($foundCategory) 
            return $foundCategory;
        else
            throw new NotFoundException();
    }

    public function create(array $data){        
        $this->validate($data, RULES::CATEGORY_RULE);
        return $this->categoryRepository->create($data);
    }

    public function update(int $id, array $data){
        $this->validate($data, RULES::CATEGORY_RULE);   
        return $this->categoryRepository->update($id, $data);
    }

    public function delete(int $id){
        return $this->categoryRepository->delete($id);
    }

}

