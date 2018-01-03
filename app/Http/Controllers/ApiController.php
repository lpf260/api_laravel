<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    protected $status_code = 200;

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param int $status_code
     */
    public function setStatusCode($status_code)
    {
        $this->status_code = $status_code;
        return $this;
    }


    public function response($data)
    {
        return \Response::json($data,$this->getStatusCode());
    }

    public function responseNotFound($message = 'Not Found Message')
    {
        return $this->responseError($message);
    }

    private function responseError($message)
    {
        return $this->response([
            'status'    => 'failed',
            'error'     => [
                'code'      => $this->getStatusCode(),
                'message'   => $message
            ]
        ]);
    }
}
