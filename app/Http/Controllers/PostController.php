<?php

namespace App\Http\Controllers;

use Exception;
use App\Constants\ModelName;
use Illuminate\Http\Request;
use App\Services\ServiceFactory;
use App\Exceptions\NotFoundException;
use App\Utilities\Traits\ResponseAPI;
use App\Exceptions\InvalidArgumentException;
class PostController extends Controller
{
    use ResponseAPI;

    // private CategoryService $postsService;
    private $postsService;
    public function __construct()
    {
        $this->postsService = ServiceFactory::create(ModelName::POST);
    }
    public function index(){
        return $this->sendGetSuccess($this->postsService->getAll());
    }

    public function show($id)
    {
        try {
            $post = $this->postsService->getById($id);
            return $this->sendGetSuccess($post);
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
            $post = $this->postsService->create($data);
            return $this->sendUpdateSuccess($post);
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
            $this->postsService->update($id, $data);

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

    public function destroy($id)
    {
        try {
            $this->postsService->delete($id);
            return $this->sendDeleteSuccess();
        } catch (NotFoundException $e) {
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }
    }

}
