<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="School System Application API",
     *      description="API documentation for the Lantern School System Application",
     *      @OA\Contact(
     *          email="danielokoronkwo90@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     *
     *
     * @OA\Tag(
     *     name="School System Application API",
     *     description="API Endpoints of School System Application API"
     * )
     */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
