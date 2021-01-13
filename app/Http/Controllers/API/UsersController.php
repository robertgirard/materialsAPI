<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum')->only('show');
    }


    public function show( Request $request )
    {

        //return $request;
        return response()->json( $request->user(), 200 );
    }

}