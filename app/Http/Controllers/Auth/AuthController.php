<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use Facebook;
use App\Participant;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    protected $redirectPath = '/';
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function facebookLogin(Request $request, $offline = null)
    {
        if ($offline) {
            $facebook_id = '129795977365516';
            $name = 'Offline User';
            $gender = 'male';
        } else {
            $fb = new Facebook\Facebook([
              'app_id' => config('services.facebook.client_id'),
              'app_secret' => config('services.facebook.client_secret'),
              'default_graph_version' => 'v2.5',
              'default_access_token' => $request->input('access_token'),
            ]);

            try {
              $response = $fb->get('/me?fields=id,name,gender,email');
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                return response('Graph returned an error: ' . $e->getMessage(), 500);
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                return response('Facebook SDK returned an error: ' . $e->getMessage(), 500);
            }

            $user        = $response->getGraphUser();
            $facebook_id = $user->getId();
            $name        = $user->getName();
            $gender      = $user->getProperty('gender');
        }

        $participant = Participant::where('facebook_id', $facebook_id)->first();

        if ( $participant ) {
            session(['participantId' => $participant->id]);
            return response()->json(['alreadyExists' => true]);
        }

        $participant = new Participant;
        $participant->name        = $name;
        $participant->facebook_id = $facebook_id;
        $participant->gender      = $gender;

        session(['participant' => $participant]);
        return response()->json(['alreadyExists' => false]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
