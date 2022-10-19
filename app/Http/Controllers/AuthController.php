<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator,Redirect,Response;
Use App\User;
Use App\VerifyUser;
use App\Mail\VerifyMail;
use App\Profile;
use App\Models\Petitions\PetitionForm;
use App\Models\Petitions\Document;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationMove;
use App\Models\Petitions\AttachmentMove;
use App\Models\Petitions\Qualification;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\LlbCollege;
use App\Models\Petitions\LstCollege;
use App\Models\Petitions\Firm;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Session;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function advocateRegistration()
    {
        return view('auth.advocate-register');
    }

    public function resetPassword()
    {
        return view('auth.reset-password');
    }


    public function postResetPassword(Request $request)
    {
        request()->validate([
        'email' => 'required',
        ]);

        // check if email exists

        $checkEmail = User::where("email", $request->input('email'))->first();

          if ($checkEmail) {
            //echo "Email ipo";exit();
            return redirect()->intended('auth/dashboard');
          }else{
            return redirect()->back()->withErrors('Email does not exist!');
          }

    }

    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
        // Authentication passed... check if verified

        $verified = User::where("email", $request->input('email'))->first();
        $value = $verified->verified;

          if ($value > 0) {
            //check user role
            $user = Auth::user();
            $role = $user->getRoleNames()->first();

            //check user if is a petitioner

            $petitioner = Auth::user()->petitioner;

            if($petitioner > 0){
                return redirect()->intended('auth/advocate-profile');
            }else{
              return redirect()->intended('auth/dashboard');
            }
          }else{
            return Redirect::to("login")->withErrors('You need to confirm your account, please check your email');
          }
        }
        return Redirect::to("login")->with('warning','You have entered invalid username or password');
    }

    public function AdvocatePostRegistration(Request $request)
    {
        request()->validate([
        'username' => 'required',
        'email' => 'required|email|unique:users',
        'phone_number' => 'required',
        'password' => 'required|min:6',
        ]);

        $data = $request->all();

        $check = $this->create($data);

        return Redirect::to("login")->with('success','We have sent you an activation link, please check your email.');
    }

    public function get_dashboard()
    {
      if(Auth::check()){
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $qualification = Qualification::where('user_id', $user_id)->first();
        $attachment = Document::where('user_id', $user_id)->first();
        $llb = LlbCollege::where('user_id', $user_id)->first();
        $lst = LstCollege::where('user_id', $user_id)->first();
        $experience = WorkExperience::where('user_id', $user_id)->first();
        $progress = ApplicationMove::where('user_id', $user_id)->first();
        $petition_form = PetitionForm::where('user_id', $user_id)->first();
        //dd($progress);exit;
        return view('management.dashboard', [
          'profile' => $profile,
          'progress' => $progress,
          'qualification' => $qualification,
          'experience' => $experience,
          'llb' => $llb,
          'lst' => $lst,
          'attachment' => $attachment,
          'petition_form' => $petition_form,
        ]);
      }
      return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    public function advocate_profile()
    {
      if(Auth::check()){
        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $qualification = Qualification::where('user_id', $user_id)->first();
        $attachment = Document::where('user_id', $user_id)->first();
        $llb = LlbCollege::where('user_id', $user_id)->first();
        $lst = LstCollege::where('user_id', $user_id)->first();
        $experience = WorkExperience::where('user_id', $user_id)->first();
        $progress = ApplicationMove::where('user_id', $user_id)->first();
        $petition_form = PetitionForm::where('user_id', $user_id)->first();
        //dd($progress);exit;
        return view('advocates.profile.dashboard', [
          'profile' => $profile,
          'progress' => $progress,
          'qualification' => $qualification,
          'experience' => $experience,
          'llb' => $llb,
          'lst' => $lst,
          'attachment' => $attachment,
          'petition_form' => $petition_form,
        ]);
      }
      return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

	public function create(array $data)
	{
    $petitioner = 1;
    $uuid = Str::uuid();
    $active = "false";
    $accnt_non_expired = "true";
    $accnt_non_locked = "true";
    $credential_non_expired = "true";
    $enabled = "true";
    $passwd_reset_requested = "true";
    $reset_passwd = "false";
    $role = "ADVOCATE";
	  $user = User::create([
	    'username' => $data['username'],
        'full_name' => $data['username'],
	    'email' => $data['email'],
        'phone_number' => $data['phone_number'],
        'active' => $active,
        'uid' => $uuid,
        'account_non_expired' => $accnt_non_expired,
        'account_non_locked' => $accnt_non_locked,
        'credentials_non_expired' => $credential_non_expired,
        'enabled' => $enabled,
        'password_reset_request' => $passwd_reset_requested,
        'reset_password' => $reset_passwd,
        'petitioner' => $petitioner,
	    'password' => Hash::make($data['password'])
	  ]);

    if($user->wasRecentlyCreated){
      $user->assignRole($role);

    // Send user verification email
    $verifyUser = VerifyUser::create([
      'user_id' => $user->id,
      'token' => sha1(time())
    ]);
    \Mail::to($user->email)->send(new VerifyMail($user));
    return $user;
    }

	}

	public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }


    public function verifyUser($token)
    {
      $date = date('y-m-d h:i:s');
      $verifyUser = VerifyUser::where('token', $token)->first();
      if(isset($verifyUser) ){
        $user = $verifyUser->user;
        if(!$user->verified) {
          $verifyUser->user->verified = 1;
          $verifyUser->user->email_verified_at = $date;
          $verifyUser->user->save();

          $status = "Your e-mail is verified. You can now login.";
        } else {
          $status = "Your account is already verified. You can now login.";
        }
      } else {
        return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
      }
      return redirect('/login')->with('success', $status);
    }

    // ****** Restricting User Access for Un-Verified Users******
    public function authenticated(Request $request, $user)
    {
      if (!$user->verified) {
        auth()->logout();
        return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
      }
      return redirect()->intended($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
      $this->guard()->logout();
      return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }
}
