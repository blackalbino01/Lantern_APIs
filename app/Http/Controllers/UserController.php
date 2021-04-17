<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api',['except' => ['login','register']]);
    }

/**
     * @OA\Post(
     * path="api/auth/register",
     * summary="Sign Up",
     * description="Signup with name, email, password",
     * operationId="authLogin",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"name","email","password"},
     *      @OA\Property(property="name", type="string", description="new user's name", example="Hussaini Segun Chibuike"),
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=404,
     *    description="Wrong URL response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, Url not found check your spelling and try again.")
     *        ),
     *     ),
     *
     * @OA\Response(
     *    response=201,
     *    description="User created",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User successfully registered."),
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *       ),
     *    ),
     * )
     *
     */


    public function register(Request $request)
    {
      $validator = Validator::make($request->all(),
        [
        'name' => 'required|string|between:2,100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:6',
      ]);

      if($validator->fails()){
        return response()->json($validator->errors()->toJson(),400);
      }

      $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)]
      ));

      return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
      ],201);
    }

    /**
     * @OA\Post(
     * path="api/auth/login",
     * summary="Sign in",
     * description="Login with email, password",
     * operationId="authLogin",
     * tags={"Authentication"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass user credentials",
     *    @OA\JsonContent(
     *       required={"email","password"},
     *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
     *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
     *    ),
     * ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        ),
     *     ),
     *
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *         @OA\Property(property="access_token", type="string", readOnly="true", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTYxODY1OTIyNiwiZXhwIjoxNjE4NjYyODI2LCJuYmYiOjE2MTg2NTkyMjYsImp0aSI6ImltaDdQdG9HZzdoeWRBRjYiLCJzdWIiOjMsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.Lq7IJe-YNvuZjxmp-c-EKQj3RxncW8gpHpSt8dn7mfg"),
     *         @OA\Property(property="token_type", type="string", readOnly="true", example="bearer"),
     *         @OA\Property(property="expires_in", type="integer", readOnly="true", example="3600"),
     *         @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *       ),
     *    ),
     * )
     *
     */

    public function login(Request $request)
    {
      $validator = Validator::make($request->all(),
        [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

      if($validator->fails()){
        return response()->json($validator->errors(),422);
      }

      if (!$token = auth()->attempt($validator->validated())) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      return $this->respondWithToken($token);
    }

    /**
     * @OA\Get(
     *  path="api/auth/me/{id}",
     *  summary="Get Profile Information by id",
     *  description="Get currently authenticated user information",
     *  operationId="authFindUserById",
     *  tags={"Authentication"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *       ),
     *    ),
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     */

    public function me($id)
    {
        $user = auth()->user();

        return response()->json($user);
    }

     /**
     * @OA\Post(
     *  path="api/auth/logout",
     *  summary="Logout",
     *  description="Logout currently authenticated user",
     *  operationId="authLogout",
     *  tags={"Authentication"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="'User successfully signed out!!!"),
     *       ),
     *    ),
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     */

    public function logout(){
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out!!!']);
    }

    /**
     * @OA\Post(
     *  path="api/auth/refresh",
     *  summary="Request new token",
     *  description="Generate new token for the currently authenticated user and invalidate the old token",
     *  operationId="authrefresh",
     *  tags={"Authentication"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *         @OA\Property(property="access_token", type="string", readOnly="true", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC92MVwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MTYyMzcxMDEsImV4cCI6MTYxNjI0MDcwMSwibmJmIjoxNjE2MjM3MTAxLCJqdGkiOiJrSngzSlRzRGlhT0h1ckNKIiwic3ViIjoyMSwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.pLUchLOEGmIv2Ns120sEZBuJj57YnAJEJuCFsuvXK4A"),
     *         @OA\Property(property="token_type", type="string", readOnly="true", example="bearer"),
     *         @OA\Property(property="expires_in", type="integer", readOnly="true", example="3600"),
     *         @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *       ),
     *    ),
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     */
    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * @OA\Patch(
     *  path="api/auth/update/{id}",
     *  summary="Update by Id",
     *  description="Currently authenticated user can update their details in the Database",
     *  operationId="authUpdate",
     *  tags={"Authentication"},
     *  security={ {"bearer": {} }},
     *
     * @OA\Response(
     *     response=200,
     *     description="Success",
     * @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="'User updated successfully!"),
     *       @OA\Property(property="user", type="object", ref="#/components/schemas/User"),
     *       ),
     *    ),
     *
     * @OA\Response(
     *    response=401,
     *    description="Returns when user is not authenticated",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Unauthorized"),
     *    ),
     *  ),
     *
     * )
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->update($request->all());

        return Response()->json([
            'message' => 'User successfully updated!',
            'updated' => $user
        ]);
    }

    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60,
        'user' => auth()->user()
      ]);
    }
}
