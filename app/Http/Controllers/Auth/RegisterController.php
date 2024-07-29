<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// missing modal classes
use App\Titles;
use App\UserRoles;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
        // $this->middleware('guest');
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
            'FirstName' => ['required', 'string', 'max:255'],
            'SecondName' => ['required', 'string', 'max:255'],
            'UserName' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'PhoneNumber' => ['required', 'numeric', 'unique:users', 'digits:9'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'userrole' => ['required', 'integer'],
            'title' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'file' => ['nullable','mimes:png,jpeg,jpg','max:5000']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $obfuscator = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 25)), 0, 5);

        return User::create([
            'FirstName' => $data['FirstName'],
            'SecondName' => $data['SecondName'],
            'email' => $data['email'],
            'PhoneNumber' => $data['PhoneNumber'],
            'password' => Hash::make($data['password']),
            'UserRole' => $data['userrole'],
            'title' => $data['title'],
            'username' => $data['UserName'],
            'gender' => $data['gender'],
            'Obfuscator' => $obfuscator,
            'validity' => 1,
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Overridden to add file to user profile pic
        if($request->hasFile('file')){
            $file = new FileUploadController;
            $file->upload_pic($request, 'user', $user->Obfuscator);
        }

        // $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        $titles = Titles::orderBy('TitleName')->get();
        $userRoles = UserRoles::orderBy('RoleName')->get();
        return view('auth.register')->with(['titles' => $titles, 'userRoles' => $userRoles]);
    }



}
