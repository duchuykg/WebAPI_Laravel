<?php

namespace App\Repositories;

use App\Models\Category;
use App\Exceptions\NotFoundException;
use App\Repositories\Contracts\ICategoryRepository;

class CategoryRepository implements ICategoryRepository
{

    public function getAll(){
        return Category::all();
    }

    public function getById($id){
        return Category::find($id); 
    }

    public function create(array $data){
        return Category::create($data);
    }
    
    public function update(int $id, array $data){
        $category = Category::find($id);
        if(!$category) throw new NotFoundException();

        return $category->update($data);
    }

    public function delete(int $id){
        $category = Category::find($id);
        if(!$category) throw new NotFoundException();

        return $category->delete();
    }
}

