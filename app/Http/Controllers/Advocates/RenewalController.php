<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
use App\Models\Advocate\Advocate;
use App\Models\Masterdata\RenewalBatch;
use App\Models\Advocate\RenewalHistory;
use App\Models\Petitions\PetitionForm;
use App\Models\Petitions\Document;
use App\Models\Petitions\Application;
use App\Models\Petitions\ApplicationMove;
use App\Models\Petitions\AttachmentMove;
use App\Models\Petitions\ProfileContact;
use App\Models\Petitions\Qualification;
use App\Models\Petitions\WorkExperience;
use App\Models\Petitions\LlbCollege;
use App\Models\Petitions\LstCollege;
use App\Models\Petitions\Firm;
use App\Models\Petitions\FirmRequestConfirmation;
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use App\Profile;
use App\User;
use App\Mail\VerifyFirm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class RenewalController extends Controller
{

    /**
     * get renewal index page
     * @return \Illuminate\Http\Response
     */
    public function get_index()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //dd($profile);exit;

            $profile_id = Profile::where('user_id', $user_id)->first()->id;

            // Check for renew year
            $renew_year = RenewalBatch::where('active', 'true')->first()->year;
            $current_year = date('Y');
            $paid_year = Advocate::where('profile_id', $profile_id)->first()->paid_year;

            // Check seniority of the advocate
            $date = date('Y-m-d');
            $admission_date = Advocate::where('profile_id', $profile_id)->first()->admission;
            $diff = abs(strtotime($date) - strtotime($admission_date));
            $seniority = floor($diff / (365*60*60*24));

            // Identify Fee structure
            $notary_fee = 40000;
            if($seniority <= 5){
                $practising_fee = 50000;
                $pc_fee_id = 3;
            }else{
                $practising_fee = 100000;
                $pc_fee_id = 4;
            }
            $penalty = 0.5*$practising_fee;
            $penalty_fee_id = 6;
            $notary_fee_id = 2;

            // Check first, second and end deadlines from active renewal batch
            $first_deadline = RenewalBatch::where('active', 'true')->first()->first_deadline;
            $second_deadline = RenewalBatch::where('active', 'true')->first()->second_deadline;
            $end_date = RenewalBatch::where('active', 'true')->first()->end_date;


            if($paid_year < $renew_year){
                // Calculate year difference between advocate paid year and renewal year
                $year_diff = $renew_year - $paid_year;

                if($year_diff > 1){
                    //echo "una malimbikizo";exit;

                    if($date <= $first_deadline){
                        echo "Renew out of Time with penalties and accumulation plus current renewal without penalty ";exit;
                    }elseif ($date <= $end_date){
                        //echo "Renew out of Time with penalties and accumulation plus current renewal with penalty";exit;

                        return view('advocates.renewal.outoftime_with_penalty', [
                            'petition_form' => $petition_form,
                            'profile' => $profile,
                            'progress' => $progress,
                            'qualification' => $qualification,
                            'attachment' => $attachment,
                            'llb' => $llb,
                            'lst' => $lst,
                            'experience' => $experience,
                            'renew_year' => $renew_year,
                        ]);
                    }
                }else{
                    //echo "hauna malimbikizo";exit;

                    if($date <= $first_deadline){
                        echo "Apply for pc";exit;
                    }elseif ($date <= $second_deadline){
                        echo "Apply for pc with penalty";exit;
                    }elseif ($date <= $end_date){
                        //echo "Renew out of Time with penalty";exit;

                        //Check if already applied out of tme
                        $app_type = "PERMIT_RENEWAL";

                        if(RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->exists()){
                            $renew_history = RenewalHistory::where('year', $renew_year)->where('profile_id', $profile_id)->select('application_id')->get();
                        }else{
                            $renew_history = "No data";
                        }

                        if($renew_history != "No data") {


                            if (Application::whereIn('id', $renew_history)->where('type', $app_type)->exists()) {
                                $application_status = Application::whereIn('id', $renew_history)->where('type', $app_type)->first()->status;
                            } else {
                                $application_status = "No data";
                            }

                        }
                        //echo $application_status;exit;

                        // Create bill Items
                        $pc_fee_amount = $practising_fee;
                        $nc_fee_amount = $notary_fee;
                        $penalty_amount = $penalty;
                        $total = $pc_fee_amount+$nc_fee_amount+$penalty_amount;

                        return view('advocates.renewal.renew_outoftime', [
                            'petition_form' => $petition_form,
                            'profile' => $profile,
                            'profile_id' => $profile_id,
                            'progress' => $progress,
                            'qualification' => $qualification,
                            'attachment' => $attachment,
                            'llb' => $llb,
                            'lst' => $lst,
                            'experience' => $experience,
                            'renew_year' => $renew_year,
                            'application_status' => $application_status,
                            'pc_fee_amount' => $pc_fee_amount,
                            'nc_fee_amount' => $nc_fee_amount,
                            'penalty_amount' => $penalty_amount,
                            'total' => $total,
                        ]);
                    }
                }
            }else{

                return view('advocates.renewal.index', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'experience' => $experience,
                    'renew_year' => $renew_year,
                ]);

            }



        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

}
