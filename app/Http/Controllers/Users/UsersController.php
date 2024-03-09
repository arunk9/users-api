<?php

namespace App\Http\Controllers\Users;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UsersController extends BaseController
{
    public function index(Request $request, UserRepository $userRepository)
    {
        $users = $userRepository->getUsers($request->all());
        return response()->json($users)->setStatusCode(200);
    }

    public function get($userId, UserRepository $userRepository)
    {
        try {
            $user = $userRepository->get($userId);
            return response()->json($user)->setStatusCode(200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(404);
        }
    }

    public function create(Request $request, UserRepository $userRepository)
    {
        // validate the incoming request params
        $this->validate($request, [
            'user_email' => 'required|email|unique:users, user_email',
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
        ]);

        try {
            // if validation is successful, save the user
            $user = $userRepository->create($request->only([
                'user_email',
                'first_name',
                'last_name'
            ]));

            return response()->json($user)->setStatusCode(200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(400);
        }
    }

    public function edit(Request $request, $userId, UserRepository $userRepository)
    {
        // validate the incoming request params
        $this->validate($request, [
            'user_email' => 'required|email|unique:users,user_email,'. $userId,
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
        ]);

        try {
            // if validation is successful, update the user
            $user = $userRepository->edit($userId, $request->only([
                'user_email',
                'first_name',
                'last_name'
            ]));

            return response()->json($user)->setStatusCode(201);
        } catch (NotFoundResourceException $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(400);
        }
    }

    public function delete($userId, UserRepository $userRepository)
    {
        try {
            // delete the user
            $userRepository->delete($userId);
            return response()->json(['success' => true])->setStatusCode(201);
        } catch (NotFoundResourceException $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(404);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(400);
        }
    }
}
