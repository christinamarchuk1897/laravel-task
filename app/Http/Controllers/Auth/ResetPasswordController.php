<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;
use App\Http\Requests\ResetPasswordRequest;
use App\Repositories\User\UserRepository;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
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
     * Reset password.
     *
     * @param  ResetPasswordRequest  $request
     * @return json
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $userResetPass = DB::table('password_resets')->where([
          'token' => $request->token
        ])->first();

        if(!$userResetPass){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = $this->userRepository->getUserByEmail($userResetPass->email);
        $updated = $this->userRepository->update($user->id, ['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['token' => $request->token])->delete();

        return response()->json(['msg' => 'success']);
    }
}
