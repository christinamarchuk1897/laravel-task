<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get user data.
     *
     * @return JsonResource
     */
    public function index()
    {
        return new UserResource(auth()->user());
    }

    /**
     * Get all user data.
     *
     * @return json
     */
    public function getAll()
    {
        try {

            $users = $this->userRepository->all();
            return response()->json(['users' => $users]);
        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Add user contact.
     * @param Request $request
     * @return json
     */
    public function add(Request $request)
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'contact_id' =>  $request->input('contact_id')
            ];
            $this->userRepository->addContact($data);

            return response()->json(['status' => 200]);

        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove user contact.
     * @param Request $request
     * @return json
     */
    public function remove(Request $request)
    {
        try {
            $data = [
                'user_id' => auth()->user()->id,
                'contact_id' =>  $request->input('contact_id')
            ];
            $this->userRepository->removeContact($data);

            return response()->json(['status' => 200]);

        } catch (\Exception $e) {
            return response()->json(['msg' => $e->getMessage()]);
        }
    }
}
