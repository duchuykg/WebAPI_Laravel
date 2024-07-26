<?php

namespace App\Http\Controllers;

use Exception;
use App\Constants\ModelName;
use Illuminate\Http\Request;
use App\Services\ServiceFactory;
use App\Exceptions\NotFoundException;
use App\Utilities\Traits\ResponseAPI;
use App\Services\Contracts\IUserService;
use App\Exceptions\InvalidArgumentException;

class UserController extends Controller
{
    use ResponseAPI;
    /**
     * @var IUserService
     */
    private $usersService;
    // private IUserService $usersService;
    public function __construct()
    {
        $this->usersService = ServiceFactory::create(ModelName::USER);
    }
    // public function __construct(IUserService $usersService)
    // {
    //     $this->usersService = $usersService;
    // }
    public function index(){
        return $this->sendGetSuccess($this->usersService->getAll());
    }

    public function show($id)
    {
        try {
            $user = $this->usersService->getById($id);
            return $this->sendGetSuccess($user);
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
            $user = $this->usersService->create($data);
            return $this->sendUpdateSuccess($user);
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
            $this->usersService->update($id, $data);

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
            $this->usersService->delete($id);
            return $this->sendDeleteSuccess();
        } catch (NotFoundException $e) {
            return $this->sendError($e->getCode(), $e->getMessage());
        } catch (Exception $e){
            return $this->sendError(500, 'Internal Server Error');
        }
    }
   
}
