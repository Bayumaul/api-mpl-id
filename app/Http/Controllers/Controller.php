<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Unofficial API Documentation for MPL Indonesia",
 *      description="Official documentation for the Unofficial API for MPL Indonesia. This API provides access to match schedules from MPL Indonesia.",
 *      @OA\Contact(
 *          email="bayu.maulanaikhsan123@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Server for Unofficial MPL Indonesia API"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($result = [], $code = 200)
    {
        $response = [
            'success' => true,
            'status' => $code,
            'data'    => $result,
        ];

        return response()->json($response, $code);
    }
}
