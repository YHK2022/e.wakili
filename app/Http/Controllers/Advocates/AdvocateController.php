<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use App\Models\Advocate\Advocate;
use App\Models\Petitions\PetitionEducation;
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
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class AdvocateController extends Controller
{

    /**
     * get a listing of advocates.
     * @return \Illuminate\Http\Response
     */
    public function get_index() {

        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();

            $cur_year = date('Y');

            //Count advocates base on their status

            $practising = "PRACTISING";
            $non_practising = "NON_PRACTISING";
            $suspended = "SUSPENDED";
            $retired = "RETIRED";
            $deceased = "DECEASED";
            $deferred = "DEFERRED";
            $non_profit = "NON_PROFIT";
            $struck_out = "STRUCK_OUT";

            $practising_count = Advocate::where('status','=',$practising)->count();
            $non_practising_count = Advocate::where('status','=',$non_practising)->count();
            $suspended_count = Advocate::where('status','=',$suspended)->count();
            $non_profit_count = Advocate::where('status','=',$non_profit)->count();
            $retired_count = Advocate::where('status','=',$retired)->count();
            $deferred_count = Advocate::where('status','=',$deferred)->count();
            $deceased_count = Advocate::where('status','=',$deceased)->count();
            $struck_out_count = Advocate::where('status','=',$struck_out)->count();
            $all_count = Advocate::all()->count();
            $all_advocates = Advocate::orderBy('roll_no')->get();

            //List advocates base on their status

            $advocates = Advocate::orderBy('roll_no')->get();

            //dd($all);exit;
            return view('management.advocate.index', [
                'advocates' => $advocates,
                'profile' => $profile,
                'practising_count' => $practising_count,
                'non_practising_count' => $non_practising_count,
                'suspended_count' => $suspended_count,
                'non_profit_count' => $non_profit_count,
                'retired_count' => $retired_count,
                'deferred_count' => $deferred_count,
                'deceased_count' => $deceased_count,
                'struck_out_count' => $struck_out_count,
                'all_count' => $all_count,
                'all_advocates' => $all_advocates,
                'cur_year' => $cur_year,
            ]);
        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * view advocate profile
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function view_profile(Request $request, $id)
    {

        if(Auth::check()){

                $user_id = Auth::user()->id;
                $profile = Profile::where('user_id', $user_id)->first();
                $cur_year = date('Y');

                $advocate = Advocate::where('uid', $id)->first();

                $profile_id = Advocate::where('uid', $id)->first()->profile_id;

                //check membership
                if(FirmMembership::where('profile_id', $profile_id)->exists()){
                    $since = FirmMembership::where('profile_id', $profile_id)->first()->since;
                    $firm_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_id;
                    $firm_branch_id = FirmMembership::where('profile_id', $profile_id)->first()->firm_branch_id;
                }else{
                    $since = "No data";
                    $firm_id = 0;
                    $firm_branch_id = 0;
                }

                //check firm
                if(Firm::where('id', $firm_id)->exists()){
                    $firms = Firm::where('id', $firm_id)->get();
                }else{
                    $firms = "No data";
                }


                //check personal info
                $personal_infos = Profile::where('id', $profile_id)->get();

                //check contact
                if(ProfileContact::where('profile_id', $profile_id)->exists()){
                    $contacts = ProfileContact::where('profile_id', $profile_id)->get();
                }else{
                    $contacts = "No data";
                }

                //check firm address / branch
                if(FirmAddress::where('id', $firm_branch_id)->exists()){
                    $firm_addresses = FirmAddress::where('id', $firm_branch_id)->get();
                }else{
                    $firm_addresses = "No data";
                }

                //check education
                if(PetitionEducation::where('profile_id', $profile_id)->exists()){
                    $educations = PetitionEducation::where('profile_id', $profile_id)->get();
                }else{
                    $educations = "No data";
                }

                //check experience
                if(WorkExperience::where('profile_id', $profile_id)->exists()){
                    $experiences = WorkExperience::where('profile_id', $profile_id)->get();
                }else{
                    $experiences = "No data";
                }

                //check applications
                $applications = Application::where('profile_id', $profile_id)->orderBy('submission_at')->get();


                return view('management.advocate.view', [
                    'profile' => $profile,
                    'advocate' => $advocate,
                    'cur_year' => $cur_year,
                    'firms' => $firms,
                    'firm_id' => $firm_id,
                    'since' => $since,
                    'personal_infos' => $personal_infos,
                    'contacts' => $contacts,
                    'firm_addresses' => $firm_addresses,
                    'educations' => $educations,
                    'experiences' => $experiences,
                    'firm_branch_id' => $firm_branch_id,
                    'applications' => $applications,
                ]);



        }
        return \Illuminate\Support\Facades\Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * AdvocateCategory live search
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function search_advocate(Request $request)
    {
        $search_val = $request->id;

        if (is_null($search_val))
        {

        return view('index');
        }
        else
        {
        $posts_data = Profile::where('fullname','LIKE',"%{$search_val}%")->get();

        $output = '';
        $modal = '';

        if (count($posts_data)>0) {

            $output = '<ul class="list-group" style="display: block; position: relative;">';

            foreach ($posts_data as $row){
                $register = url('public/show-advocate',$row->id);
                $image = url(asset('storage/files/'.$row->picture));
                $output .= '<li class="list-group-item">';
                $output .= '<a href="'."#profile".$row->id.'" data-id="'.$row->id.'" data-toggle="modal" data-target="'."#profile".$row->id.'" style="width:90%;font-size:15px;color:black;hover-color:white;">'.$row->fullname;
                $output .= '</a>';
                $output .= '<div class="modal inmodal fade" id="'."#profile".$row->id.'" tabindex="-1" role="dialog" aria-hidden="true">'.'<div class="modal-dialog">'.'<div class="modal-content">'.'<div class="modal-body">'.'<center>'.'<img src="'.$image.'" name="aboutme" width="140" height="140" border="0" class="img-circle">'.'<br/>'.'<h3 class="media-heading">'.$row->fullname.'</h3>'.'<span>'.'<strong>'."Roll Number:".'</strong>'.'</span>'.'<span class="btn btn-danger">'."NIL".'</span>'.'</center>'.'<hr>'.'<center>'.'<p class="btn btn-danger">'.'<strong>'."Practicing History".'</strong>'.'</p>'.'<br>'.'</center>'.'</div>'.'<div class="modal-footer">'.'<center>'.'<button type="button" class="btn btn-default" data-dismiss="modal">'."Close".'</button>'.'</center>'.'</div>'.'</div>'.'</div>'.'</div>';
                $output .= '</li>';
            }

            $output .= '</ul>';
        }
        else {
            $output .= '<li class="list-group-item">'.'<table>'.'<tr>'.'<td style="width:90%;font-size:15px;color:red;">'.'No AdvocateCategory match with search results, try again with valid input !'.'</td>'.'<td style="width:10%">'.'</td>'.'</tr>'.'</table>'.'</li>';
        }

        return $output;

      }



    }



}
