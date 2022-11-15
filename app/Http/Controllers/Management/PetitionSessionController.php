<?php

namespace App\Http\Controllers\Management;

use App\Models\Masterdata\PetitionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Profile;

class PetitionSessionController extends Controller
{
    /**
     * get a listing of petition sessions.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $sessions = PetitionSession::orderBy('open_date')->get();
            return view('management.masterdata.petition_session.index', [
                'profile' => $profile,
                'sessions' => $sessions,
            ]);
        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add a new petition session
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_session(Request $request)
    {

        if(Auth::check()){

            $this->validate($request, [
                'open_date' => 'required',
                'close_date' => 'required',
                'admission_date' => 'required',
            ]);

            $uuid = Str::uuid();

            $session = new PetitionSession();
            $session->open_date = $request->input('open_date');
            $session->close_date = $request->input('close_date');
            $session->admission_date = $request->input('admission_date');
            $session->uid = $uuid;
            $session->active = "true";
            //dd($session);exit;
            $session->save();

            return back()->with('success', 'Petition Session added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * edit petition session
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function edit_session(Request $request, $id)
    {

        if(Auth::check()){

            try {

                $session = PetitionSession::findOrFail($id);

                $this->validate($request, [
                    'open_date' => 'required',
                    'close_date' => 'required',
                    'admission_date' => 'required',
                ]);

                $session->open_date = $request->input('open_date');
                $session->close_date = $request->input('close_date');
                $session->admission_date = $request->input('admission_date');
                //dd($session);exit;
                $session->save();

                return back()->with('success', 'Petition Session edited successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'Petition Session not edited');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * delete user permission
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function delete_permission(Request $request, $id)
    {
        if(Auth::check()){

            try {
                $permission = Permission::findOrFail($id);
                $permission->delete();

                return back()->with('success', 'User permission deleted successfully');

            } catch (\Throwable $th) {

                return back()->with('warning', 'User permission not deleted');
            }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


}

