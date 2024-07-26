<?php

namespace App\Http\Controllers;

use Exception;
use App\Constants\ModelName;
use Illuminate\Http\Request;
use App\Services\ServiceFactory;
use App\Exceptions\NotFoundException;
use App\Utilities\Traits\ResponseAPI;
use App\Exceptions\InvalidArgumentException;
class CategoryController extends Controller
{
    use ResponseAPI;

    // private CategoryService $categoriesService;
    private $categoriesService;
    public function __construct()
    {
        $this->categoriesService = ServiceFactory::create(ModelName::CATEGORY);
    }
    public function index(){
        return $this->sendGetSuccess($this->categoriesService->getAll());
    }

    public function show($id)
    {
        try {
            $category = $this->categoriesService->getById($id);
            return $this->sendGetSuccess($category);
        } catch (NotFoundException $e) {
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $category = $this->categoriesService->create($data);
            return $this->sendUpdateSuccess($category);
        }
        catch (InvalidArgumentException $e){
            return $this->sendError($e->getCode(), $e->getMessage());
        }
        catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        try {
            $this->categoriesService->update($id, $data);

            return $this->sendUpdateSuccess($data);
        } catch (NotFoundException $e) {
            return $this->sendError($e->getCode(), $e->getMessage());
        } 
        catch (InvalidArgumentException $e){
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }
    }

    // public function updateOrCreate(Request $request)
    // {
    //     $data = $request->all();
    //     $id = $data['id'];

    //     try {
    //         $this->categoriesService->getById($id);
    //         $this->categoriesService->update($id, $data);
    //     } catch (NotFoundException $e) {
    //         $this->categoriesService->create($data);
    //     } catch (Exception $e){
    //         return $this->sendError(500, 'Internal Server Error');
    //     }

    //     // Validate the data
    //     $rules = [
    //         'name' => 'required', 
    //         'slug' => 'required',
    //     ];
    //     $validator = Validator::make($data, $rules);
    
    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->toArray();
            
    //         return $this->sendError(400, $errors);
    //     }

    //     try {
    //         $this->categoriesService->update($id, $data);
    //         return $this->sendUpdateSuccess($data);
    //     } catch (NotFoundException $e) {
    //         return $this->sendError($e->getCode(), $e->getMessage());
    //     } catch (Exception $e){
    //         return $this->sendError(500, 'Internal Server Error');
    //     }
    // }

    public function destroy($id)
    {
        try {
            $this->categoriesService->delete($id);
            return $this->sendDeleteSuccess();
        } catch (NotFoundException $e) {
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }
    }

}
