<?php

namespace App\Utilities\Traits;

trait ResponseAPI
{
    /**
     * Summary of send
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function send(bool $success, int $status, $data, string $message)
    {
        $response = [
            'success' => $success,
            'status' => $status,
            'message' => $message
        ];

        $response[$success ? 'data' : 'error'] = $data;
       
        return response()->json($response, $status);
    }

    /**
     * Send get success
     */
    public function sendLoginSuccess($data, string $message = "Login successfully" )
    {
        return $this->send(true, 200, $data, $message);
    }
    public function sendGetSuccess($data, string $message = "Get data successfully" )
    {
        return $this->send(true, 200, $data, $message);
    }

    public function sendCreateSuccess($data, string $message = "Create data successfully" )
    {
        return $this->send(true, 201, $data, $message);
    }

    public function sendUpdateSuccess($data, string $message = "Update data successfully" )
    {
        return $this->send(true, 200, $data, $message);
    }

    public function sendDeleteSuccess($data = null, string $message = "Delete data successfully" )
    {
        return $this->send(true, 200, $data, $message);
    }

    public function sendError(int $status, $error = null, string $message = "")
    {
        return $this->send(false, $status, $error, $message);
    }

}