<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Titles;
use App\UserRoles;
use App\AuditTrail;

// Hash class
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersController extends Controller
{

    public function __construct() {
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audit_action = 'View List of All System Users';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        //
        $users = User::orderby('id', 'desc')->with(['user_role','user_title', 'pic'])->withTrashed()->get();
        $active_users = User::orderby('id', 'desc')->where('validity', '!=', 0)->count();
        $pending_deletion = User::onlyTrashed()->count();
        $block_users = User::where('validity', 0)->count();

        // print_r($block_users); exit;
        return view('users.index')->with(['users' => $users, 'pending_deletion' => $pending_deletion, 'blocked_users' => $block_users, 'active_users' => $active_users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return redirect('#');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return redirect('#');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($obfuscator)
    {
        //
        $audit_action = 'Viewed a user Profile';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $user = User::where('Obfuscator', $obfuscator)->with(['user_role','user_title', 'pic'])->withTrashed()->get();

        if(count($user) > 0){
            return view('users.show')->with('user', $user);
            exit;
        }

        return redirect('/staff');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($obfuscator)
    {
        //
        $titles = Titles::orderBy('id', 'asc')->get();
        $userRoles = UserRoles::orderBy('id', 'desc')->get();
        $user = User::where('Obfuscator', $obfuscator)->with(['user_role','user_title'])->withTrashed()->get();

        if(count($user) > 0){
            return view('users.edit')->with(['user' => $user, 'titles' => $titles, 'userRoles' => $userRoles]);
            exit;
        }

        return redirect('/staff');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $obfuscator)
    {
        $audit_action = 'Edited a System User Details';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        //function for storing the updated results
        $this->validate($request, [
            'FirstName' => ['required', 'string', 'max:255'],
            'SecondName' => ['required', 'string', 'max:255'],
            'userrole' => ['required', 'integer'],
            'title' => ['required', 'integer'],
            'gender' => ['required', 'string'],
            'file' => ['nullable','mimes:png,jpeg,jpg','max:1000'],
            // 'PhoneNumber' => ['required', 'unique:users', 'digits:9'],
        ]);

        $file = new FileUploadController;
        $file->upload_pic($request, 'user', $obfuscator);
            
        // print_r($request->input()); echo '<br><br>';
        $user = User::withTrashed()->where('Obfuscator', $obfuscator)->get();

        $user = User::withTrashed()->find($user[0]->id);
        // print_r($user); exit;

        if ($request->input('password') != '') {
            $this->validate($request, [
                'password' => ['string', 'min:8', 'confirmed']
            ]);
            $password = bcrypt($request->input('password'));
            $user->password = $password;
        }
        
        if ($request->input('email') != $user->email) {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
            $user->email = $request->input('email');
        }
        
        if ($request->input('UserName') != $user->username) {
            $this->validate($request, [
                'UserName' => ['required', 'string', 'max:255', 'unique:users'],
            ]);
            $user->username = $request->input('UserName');
        }
        
        if ($request->input('PhoneNumber') != $user->PhoneNumber) {
            $this->validate($request, [
                'PhoneNumber' => ['required', 'unique:users', 'digits:9'],
            ]);
            $user->PhoneNumber = $request->input('PhoneNumber');
        }

        $user->FirstName = $request->input('FirstName');
        $user->SecondName = $request->input('SecondName');
        $user->UserRole = $request->input('userrole');
        $user->title = $request->input('title');
        $user->gender = $request->input('gender');

        $user->save();

            return redirect('/staff/'.$user->Obfuscator)->with('success', 'User has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($obfuscator)
    {
        $audit_action = 'Deleted a System User';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $user_to_delete = User::where('Obfuscator', $obfuscator)->get();
        $user_to_delete = User::find($user_to_delete[0]->id);
        //get the user that deleted this user's account
        $user_that_deleted = auth()->user()->Obfuscator;
        
        $user_to_delete->deleted_by = $user_that_deleted;
        $user_to_delete->validity = 0;
        $user_to_delete->save();
        
        $user_to_delete->delete();
        
        return redirect('/staff')->with('error', 'User has been deleted succefully');
    }

    public function restore($obfuscator)
    {
        $audit_action = 'Restored a System User Account';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $user_to_restore = User::where('Obfuscator', $obfuscator)->onlyTrashed()->get();
        // print_r($user_to_restore); exit;
        $user_restoring = auth()->user()->Obfuscator;
        
        if($user_restoring === $user_to_restore[0]->deleted_by){
            return redirect('/staff/'.$user_to_restore[0]->Obfuscator)->with('error', 'Please contact another administrator to restore this account');
            exit;
        }
        
        $user_to_restore = User::onlyTrashed()->find($user_to_restore[0]->id);

        $user_to_restore->deleted_by = 'NULL';
        $user_to_restore->validity = 1;
        $user_to_restore->save();

        $user_to_restore->restore();

        return redirect('/staff')->with('success', 'User has been restored successfully');
    }
    
    public function permanentely_delete($obfuscator)
    {
        $audit_action = 'Permanentely Removed a System User';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $user_to_destroy = User::where('Obfuscator', $obfuscator)->onlyTrashed()->get();
        // print_r($user_to_destroy); exit;
        $user_destroying= auth()->user()->Obfuscator;
        
        if($user_destroying === $user_to_destroy[0]->deleted_by){
            return redirect('/staff/'.$user_to_destroy[0]->Obfuscator)->with('error', 'Please contact another administrator to remove this account');
            exit;
        }

        $user_to_destroy = User::onlyTrashed()->find($user_to_destroy[0]->id);

        $user_to_destroy->forceDelete();

        return redirect('/staff')->with('success', 'User has been removed successfully');
    }

    public function block_user($obfuscator,$firstname,$lastname)
    {
        $audit_action = 'Blocked a System User';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $user = User::where(['Obfuscator' => $obfuscator, 'FirstName' => $firstname, 'SecondName' => $lastname])->get();

        $user_blocking = auth()->user()->Obfuscator;
        if (count($user) > 0) {
             $user= User::find($user[0]->id);
             $user->validity = 0;
             $user->deleted_by = $user_blocking;
             $user->save();
             
             return redirect('/staff/'.$obfuscator)->with('success', 'User has been blocked');
             exit;
        }

        return redirect('/staff');
        exit;

        return 0;
    }
    
    public function unblock_user($obfuscator,$firstname,$lastname)
    {
        $audit_action = 'UnBloked a System User';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $user = User::where(['Obfuscator' => $obfuscator, 'FirstName' => $firstname, 'SecondName' => $lastname])->get();

        $user_blocking = auth()->user()->Obfuscator;
        if (count($user) > 0) {
             $user= User::find($user[0]->id);
             $user->validity = 1;
             $user->deleted_by = $user_blocking;
             $user->save();

             return redirect('/staff/'.$obfuscator)->with('success', 'User has been unblocked');
             exit;
        }

        return redirect('/staff');
        exit;
    }

    public function getChangePassword()
    {
        return view('auth.change_password');
    }

    public function postChangePassword(Request $request)
    {

        $audit_action = 'Changed their password';
        $audit_user_id = auth()->user()->id;

        // Audit this action
        $audit_trail = new AuditTrail();

        $audit_trail->action = $audit_action;
        $audit_trail->user_id = $audit_user_id;

        $audit_trail->save();

        $validatedData = $request->validate([
            'old-password' => 'required|string',
            'password' => 'required|string|min:8',
            'password-confirm' => 'required|string|min:8|same:password',
        ]);

        if (!(Hash::check($request->get('old-password'), auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your old password is incorrect. Please try again.");
        }

        if (strcmp($request->get('old-password'), $request->get('password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
            // return redirect()->back()->withInput()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }


        //Change Password
        $vendor = Auth::user();
        $vendor->password = bcrypt($request->get('password'));
        $vendor->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }

    // public function download()
    // {
    //     return Excel::download(new UsersExport, 'users.pdf');
    // }
}
