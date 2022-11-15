<?php

namespace App\Http\Controllers\Advocates;

use App\Http\Controllers\Controller;
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

class PetitionController extends Controller
{
    /**
     * get profile registration form
     * @return \Illuminate\Http\Response
     */
    public function get_personal_detal_index(Request $request)
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
            return view('advocates.profile.personal_details', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * get qualification registration form
     * @return \Illuminate\Http\Response
     */
    public function get_qualification_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $qualification = Qualification::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //dd($profile);exit;
            return view('advocates.profile.qualification', [
                'petition_form' => $petition_form,
                'qualification' => $qualification,
                'profile' => $profile,
                'progress' => $progress,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * get attachments registration form
     * @return \Illuminate\Http\Response
     */
    public function get_attachment_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $qualification = Qualification::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->first();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            $attach_move = AttachmentMove::where('user_id', $user_id)->first();
            //dd($profile);exit;
            return view('advocates.profile.attachment', [
                'petition_form' => $petition_form,
                'qualification' => $qualification,
                'profile' => $profile,
                'progress' => $progress,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
                'attach_move' => $attach_move,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * add a new petitioner profile
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_profile(Request $request)
    {
        if(Auth::check()){

        $this->validate($request, [
            'title' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'nationality' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
        ]);

        $uuid = Str::uuid();

        $profile = new Profile();
        $profile->title = $request->input('title');
        $profile->fullname = $request->input('name');
        $profile->gender = $request->input('gender');
        $profile->dob = $request->input('dob');
        $profile->nationality = $request->input('nationality');
        $profile->id_type = $request->input('id_type');
        $profile->id_number = $request->input('id_number');
        $profile->user_id = Auth::user()->id;
        $profile->uid = $uuid;
        $profile->active = "true";
        //dd($profile);exit;
        $profile->save();

        //Insert petition forms values
        if($profile){
        $petition_form_one = 1;
        $form = new PetitionForm();
        $form->personal_detail = $petition_form_one;
        $form->user_id = Auth::user()->id;
        $form->profile_id = $profile->id;
        $form->save();

        $progress_value = 15;
        $progress = new ApplicationMove();
        $progress->appl_progress = $progress_value;
        $progress->user_id = Auth::user()->id;
        $progress->profile_id = $profile->id;
        $progress->save();

        }
        return back()->with('success', 'Personal info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * add a new petitioner qualification
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_qualification(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $profile_id = Profile::where('user_id', $user_id)->first()->id;
        $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
        $progress_form = 20;
        $new_progress = $progress + $progress_form;


        $this->validate($request, [
            'olevel' => 'required',
            'alevel' => 'required',
            'llb' => 'required',
            'lst' => 'required',
            'validation' => 'required',
        ]);

        $qualification = new Qualification();
        $qualification->o_level = $request->input('olevel');
        $qualification->a_level = $request->input('alevel');
        $qualification->llb = $request->input('llb');
        $qualification->lst = $request->input('lst');
        $qualification->names_validation = $request->input('validation');
        $qualification->user_id = Auth::user()->id;
        $qualification->profile_id = $profile_id;
        //dd($qualification);exit;
        $qualification->save();


        if($qualification){
         //Update petition forms values
        $qualification_form_value = 1;
        $qualification_form = DB::table('petition_forms')
                        ->where('user_id', $user_id)
                        ->update(['qualification' => $qualification_form_value]);
        //Update progress values
        $progress = DB::table('application_moves')
                        ->where('user_id', $user_id)
                        ->update(['appl_progress' => $new_progress]);

        //Save application information values
        $submitdate = date('Y-m-d H:i:s');
        $uuid = Str::uuid();
        $appl_type = "PETITION";
        $lst = $request->input('lst');
        if($lst == "Yes"){
            $qualification = "LAW SCHOOL";
        }

        if($lst == "No"){
            $qualification = "BAR";
        }
        $status = "NOT SUBMITTED";

        $application = new Application();
        $application->submission_at = $submitdate;
        $application->active = "true";
        $application->uid = $uuid;
        $application->type = $appl_type;
        $application->qualification = $qualification;
        $application->status = $status;
        $application->resubmission = "true";
        $application->un_reviewed = "0";
        $application->current_stage = "1";
        $application->profile_id = $profile_id;
        $application->workflow_process_id = "1";
        $application->actionstatus = "0";
        $application->stage = "0";
        //dd($application);exit;
        $application->save();

        }
        return back()->with('success', 'Education Qualifications added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * upload profile picture
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_profile_picture(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $application_id = Application::where('profile_id', $profile_id)->first()->id;
        $name = "Profile Picuture";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');
        $uuid = Str::uuid();

        //echo $application_id;exit;

         $this->validate($request, [
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

         if($request->hasFile('profile_picture')) {
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('profile_picture')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->uid = $uuid;
            $document->application_id = $application_id;
            $document->profile_id = $profile_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->auther = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                $attachment = new AttachmentMove;
                $attachment->user_id = $user_id;
                $attachment->profile_id = $profile_id;
                $attachment->application_id = $application_id;
                $attachment->profile_picture = $fileNameToStore;
                //dd($document);exit;
                $attachment->save();

                 //Update profile picture values
                $profile_picture = DB::table('profiles')
                        ->where('user_id', $user_id)
                        ->update(['picture' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Profile picture successfully added');

        }
    }

    /**
     * upload petition for admission and enrolment document
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_petition_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Petition for Admission and Enrollment";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'petition' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('petition')) {
            $filenameWithExt = $request->file('petition')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('petition')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('petition')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['petition' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Profile picture successfully added');

        }
    }

    /**
     * upload certificate of o level
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_csee_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Certificate of Secondary Education (CSEE)";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'csee' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('csee')) {
            $filenameWithExt = $request->file('csee')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('csee')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('csee')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['csee' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate of recognition necta
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_necta_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "NECTA Certificate of Recognition";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'necta' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('necta')) {
            $filenameWithExt = $request->file('necta')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('necta')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('necta')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['necta' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate of a level
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_acsee_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Advanced Certificate of Secondary Education";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'acsee' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('acsee')) {
            $filenameWithExt = $request->file('acsee')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('acsee')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('acsee')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['acsee' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate of recognition nacte
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_nacte_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "NACTE/NECTA Certificate of Recognition";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'nacte' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('nacte')) {
            $filenameWithExt = $request->file('nacte')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('nacte')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('nacte')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['nacte' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate for llb
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_llbcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "LLB Certificate";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'llbcert' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('llbcert')) {
            $filenameWithExt = $request->file('llbcert')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('llbcert')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('llbcert')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['llb_cert' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate for llb tanscript
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_llbtrans_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "LLB Transcript";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'llbtrans' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('llbtrans')) {
            $filenameWithExt = $request->file('llbtrans')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('llbtrans')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('llbtrans')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['llb_trans' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate of TCU recognition
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_tcu_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "TCU Certificate of Recognition";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'tcu' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('tcu')) {
            $filenameWithExt = $request->file('tcu')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('tcu')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('tcu')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['tcu' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate for lst
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_lstcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Post Graduate Diploma in Legal Practice from LST";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'lstcert' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('lstcert')) {
            $filenameWithExt = $request->file('lstcert')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('lstcert')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('lstcert')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['lst_cert' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate for lst final results
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_lsttrans_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Final Result Post Graduate Diploma in Legal Practice from LST";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'lsttrans' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('lsttrans')) {
            $filenameWithExt = $request->file('lsttrans')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('lsttrans')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('lsttrans')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['lst_results' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate of pupilage
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_pupilage_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Letter for Pupilage";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'pupilage' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('pupilage')) {
            $filenameWithExt = $request->file('pupilage')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('pupilage')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('pupilage')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['pupilage' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate of intenship/extenship
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_intenship_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Internship / Externship";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'intenship' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('intenship')) {
            $filenameWithExt = $request->file('intenship')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('intenship')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('intenship')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['intenship' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload employer later
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_empletter_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Employer Letter";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'empletter' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('empletter')) {
            $filenameWithExt = $request->file('empletter')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('empletter')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('empletter')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['emp_later' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload deed poll
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_deedpoll_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Deed Poll";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'deedpoll' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('deedpoll')) {
            $filenameWithExt = $request->file('deedpoll')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('deedpoll')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('deedpoll')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['deedpoll' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload birth certificate
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_birthcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Birth Certificate";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'birthcert' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('birthcert')) {
            $filenameWithExt = $request->file('birthcert')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('birthcert')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('birthcert')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['birth_cert' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }


    /**
     * upload certificate of good character
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function add_charcert_document(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $name = "Certificate of Good Character";
        $status = 0;
        $ldate = date('Y-m-d H:i:s');

         $this->validate($request, [
            'charcert' => 'required|mimes:pdf|max:2048',
         ]);

         if($request->hasFile('charcert')) {
            $filenameWithExt = $request->file('charcert')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('charcert')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('charcert')->storeAs('public/files', $fileNameToStore);

            $document = new Document;
            $document->user_id = $user_id;
            $document->name = $name;
            $document->file = $fileNameToStore;
            $document->author = $profile_id;
            $document->upload_date = $ldate;
            $document->status = $status;
            //dd($document);exit;
            $document->save();

            if($document->save()){
                 //Update profile picture values
                $profile_picture = DB::table('attachment_moves')
                        ->where('user_id', $user_id)
                        ->update(['char_cert' => $fileNameToStore]);
            }

         }

        return back()->with('success', 'Certificate successfully added');

        }
    }

     /**
     * upload submit attachments
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function submit_attachments(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $profile = Profile::where('user_id', $user_id)->first();
        $profile_id = Profile::where('user_id', $user_id)->first(['id'])->id;
        $value = 1;
        $ldate = date('Y-m-d H:i:s');

        $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
        $progress_form = 35;
        $new_progress = $progress + $progress_form;

        //Update progress values
        $progress = DB::table('application_moves')
                        ->where('user_id', $user_id)
                        ->update(['appl_progress' => $new_progress]);

         //Update petition form
         $profile_picture = DB::table('petition_forms')
                        ->where('user_id', $user_id)
                        ->update(['attachment' => $value]);

        return back()->with('success', 'Attachments successfully submitted');

        }
    }

    /**
     * get llb index
     * @return \Illuminate\Http\Response
     */
    public function get_llb_index(Request $request)
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
            return view('advocates.profile.llb', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * get lst index
     * @return \Illuminate\Http\Response
     */
    public function get_lst_index(Request $request)
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
            return view('advocates.profile.lst', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * get work experience index
     * @return \Illuminate\Http\Response
     */
    public function get_experience_index(Request $request)
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
            return view('advocates.profile.experience', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * get finish index
     * @return \Illuminate\Http\Response
     */
    public function get_finish_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //echo $attachment;exit;
            if($progress){
                $progress_value = ApplicationMove::where('user_id', $user_id)->first('appl_progress')->appl_progress;

                return view('advocates.profile.finish', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'progress_value' => $progress_value,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'experience' => $experience,
                ]);

            }else{
                return view('advocates.profile.finish', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'experience' => $experience,
                ]);
            }
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * get firm & work places index
     * @return \Illuminate\Http\Response
     */
    public function get_firm_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $firm = FirmMembership::where('user_id', $user_id)->first();
            $request_confirmation = FirmRequestConfirmation::where('requester_id', $user_id)->first();

            if($firm){
                $firm_id = FirmMembership::where('user_id', $user_id)->first('firm_id')->firm_id;
                $firm_address = FirmAddress::where('firm_id',$firm_id)->get();
                $firm_creator_id = Firm::where('id', $firm_id)->first('created_by')->created_by;

                $firm_owner = User::where('id', $firm_creator_id)->first();

                $experience = WorkExperience::where('user_id', $user_id)->first();
                //echo $attachment;exit;
                return view('advocates.profile.firm', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'firm' => $firm,
                    'firm_address' => $firm_address,
                    'firm_owner' => $firm_owner,
                    'experience' => $experience,
                ]);
            }else if($request_confirmation){
                $experience = WorkExperience::where('user_id', $user_id)->first();
                //echo $attachment;exit;
                return view('advocates.profile.firm', [
                    'request_confirmation' => $request_confirmation,
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'firm' => $firm,
                    'experience' => $experience,
                ]);
            }else{
                $experience = WorkExperience::where('user_id', $user_id)->first();
                //echo $attachment;exit;
                return view('advocates.profile.firm', [
                    'petition_form' => $petition_form,
                    'profile' => $profile,
                    'progress' => $progress,
                    'qualification' => $qualification,
                    'attachment' => $attachment,
                    'llb' => $llb,
                    'lst' => $lst,
                    'firm' => $firm,
                    'experience' => $experience,
                ]);
            }

          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


      /**
     * get firm & work places add form index
     * @return \Illuminate\Http\Response
     */
    public function get_add_firm_index(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $firm = FirmMembership::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //echo $attachment;exit;
            return view('advocates.profile.add_firm', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'firm' => $firm,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


       /**
     * get firm & work confirmation form index
     * @return \Illuminate\Http\Response
     */
    public function get_firm_confirmation(Request $request)
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $profile = Profile::where('user_id', $user_id)->first();
            $progress = ApplicationMove::where('user_id', $user_id)->first();
            $petition_form = PetitionForm::where('user_id', $user_id)->first();
            $qualification = Qualification::where('user_id', $user_id)->first();
            $attachment = Document::where('user_id', $user_id)->get();
            $llb = LlbCollege::where('user_id', $user_id)->first();
            $lst = LstCollege::where('user_id', $user_id)->first();
            $firm = FirmMembership::where('user_id', $user_id)->first();
            $experience = WorkExperience::where('user_id', $user_id)->first();
            //echo $attachment;exit;
            return view('advocates.profile.confirm_firm', [
                'petition_form' => $petition_form,
                'profile' => $profile,
                'progress' => $progress,
                'qualification' => $qualification,
                'attachment' => $attachment,
                'llb' => $llb,
                'lst' => $lst,
                'firm' => $firm,
                'experience' => $experience,
            ]);
          }
          return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * add llb university or college
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_llb(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required',
            'complete_year' => 'required|numeric',
        ]);

        $college = new LlbCollege();
        $college->name = $request->input('name');
        $college->complete_year = $request->input('complete_year');
        $college->user_id = Auth::user()->id;
        $college->save();

        //Update petition form values and progress
        if($college){
        //Update progress values
        $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
        $progress_form = 10;
        $value = 1;

        $new_progress = $progress + $progress_form;
        $progress = DB::table('application_moves')
                        ->where('user_id', $user_id)
                        ->update(['appl_progress' => $new_progress]);

         //Update petition form
         $profile_picture = DB::table('petition_forms')
                        ->where('user_id', $user_id)
                        ->update(['llb' => $value]);

        }
        return back()->with('success', 'University / College info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * add  firm or workplace
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_firm(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'region' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'street' => 'required',
        ]);

        if($request->input('type') == "Law Firm" || $request->input('type') == "Business Company"){
            $member = 1;
            $date = date("Y-m-d");
            $position = "HQ";

            $firm = new Firm();
            $firm->name = $request->input('name');
            $firm->type = $request->input('type');
            $firm->tin = $request->input('tin');
            $firm->members = $member;
            $firm->taxpayer_name = $request->input('taxpayer');
            $firm->created_by = Auth::user()->id;
            $firm->save();

            $firm_membership = new FirmMembership();
            $firm_membership->date_joined = $date;
            $firm_membership->date_requested = $date;
            $firm_membership->firm_id = $firm->id;
            $firm_membership->user_id = Auth::user()->id;
            $firm_membership->save();

            $firm_address = new FirmAddress();
            $firm_address->address = $request->input('address');
            $firm_address->region = $request->input('region');
            $firm_address->district = $request->input('district');
            $firm_address->ward = $request->input('ward');
            $firm_address->street = $request->input('street');
            $firm_address->postcode = $request->input('postcode');
            $firm_address->firm_id = $firm->id;
            $firm_address->position = $position;
            $firm_address->save();

            //Update petition form values and progress
            if($firm){
            //Update progress values
            $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
            $progress_form = 5;
            $value = 1;
            $new_progress = $progress + $progress_form;

            $progress = DB::table('application_moves')
                            ->where('user_id', $user_id)
                            ->update(['appl_progress' => $new_progress]);

            //Update petition form
            $profile_picture = DB::table('petition_forms')
                            ->where('user_id', $user_id)
                            ->update(['firm' => $value]);


            }
            return redirect::to("petition/firm")->with('success', 'Workplace added successfully');

        }else{

            $member = 1;
            $date = date("Y-m-d");
            $position = "HQ";

            $firm = new Firm();
            $firm->name = $request->input('name');
            $firm->type = $request->input('type');
            $firm->members = $member;
            $firm->created_by = Auth::user()->id;
            $firm->save();

            $firm_membership = new FirmMembership();
            $firm_membership->date_joined = $date;
            $firm_membership->date_requested = $date;
            $firm_membership->firm_id = $firm->id;
            $firm_membership->user_id = Auth::user()->id;
            $firm_membership->save();

            $firm_address = new FirmMembership();
            $firm_address->address = $request->input('address');
            $firm_address->region = $request->input('region');
            $firm_address->district = $request->input('district');
            $firm_address->ward = $request->input('ward');
            $firm_address->street = $request->input('street');
            $firm_address->postcode = $request->input('postcode');
            $firm_address->firm_id = $firm->id;
            $firm_address->position = $position;
            $firm_address->save();

            //Update petition form values and progress
            if($firm){
            //Update progress values
            $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
            $progress_form = 5;
            $value = 1;
            $new_progress = $progress + $progress_form;

            $progress = DB::table('application_moves')
                            ->where('user_id', $user_id)
                            ->update(['appl_progress' => $new_progress]);

            //Update petition form
            $profile_picture = DB::table('petition_forms')
                            ->where('user_id', $user_id)
                            ->update(['firm' => $value]);


            }
            return redirect::to("petition/firm")->with('success', 'Workplace added successfully');
        }

        }

        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * add law school college
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_lst(Request $request)
    {
        if(Auth::check()){

        // Validate LST Reg Number with LAW SCHOOL system API



        $this->validate($request, [
            'name' => 'required',
            'reg_number' => 'required',
            'complete_year' => 'required|numeric',
        ]);

        $college = new LstCollege();
        $college->name = $request->input('name');
        $college->reg_number = $request->input('reg_number');
        $college->complete_year = $request->input('complete_year');
        $college->user_id = Auth::user()->id;
        $college->save();

        return back()->with('success', 'Post graduate in legal practice info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * add work experience
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_experience(Request $request)
    {
        if(Auth::check()){
        $user_id = Auth::user()->id;
        $this->validate($request, [
            'name' => 'required',
            'title' => 'required',
            'start_year' => 'required|numeric',
            'end_year' => 'required|numeric',
        ]);

        $experience = new WorkExperience();
        $experience->organisation = $request->input('name');
        $experience->title = $request->input('title');
        $experience->start_year = $request->input('start_year');
        $experience->end_year = $request->input('end_year');
        $experience->user_id = Auth::user()->id;
        $experience->save();

        //Update petition form values and progress
        if($experience){
            //Update progress values
            $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
            $progress_form = 10;
            $value = 1;

            $new_progress = $progress + $progress_form;
            $progress = DB::table('application_moves')
                            ->where('user_id', $user_id)
                            ->update(['appl_progress' => $new_progress]);

             //Update petition form
             $profile_picture = DB::table('petition_forms')
                            ->where('user_id', $user_id)
                            ->update(['experience' => $value]);

        }
        return back()->with('success', 'Work experience info added successfully');

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


    /**
     * Law firms live search
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function search_firm(Request $request)
    {
        $search_val = $request->id;

        if (is_null($search_val))
        {
        return view('advocates.profile.firm');
        }
        else
        {

        $posts_data = Firm::where('name','LIKE',"%{$search_val}%")->get();

        $output = '';

        if (count($posts_data)>0) {

            $output = '<ul class="list-group" style="display: block; position: relative;">';

            foreach ($posts_data as $row){
                $register = url('petition/request-firm',$row->id);
                $output .= '<li class="list-group-item">'.'<table>'.'<tr>'.'<td style="width:90%;font-size:15px;">'.$row->name.'</td>'.'<td style="width:10%">'.'<a class="btn btn-danger btn-xs" style="" href="'.$register.'">'.'Register'.'</a>'.'</td>'.'</tr>'.'</table>'.'</li>';
            }

            $output .= '</ul>';
        }
        else {
            $add = url('petition/add-firm');
            $output .= '<li class="list-group-item">'.'<table>'.'<tr>'.'<td style="width:90%;font-size:15px;">'.'No firm results found !'.'</td>'.'<td style="width:10%">'.'<a class="btn btn-danger btn-xs" style="" href="'.$add.'">'.'Add new firm'.'</a>'.'</td>'.'</tr>'.'</table>'.'</li>';
        }

        return $output;

      }
    }


    /**
     * request firm registration
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_firm_request(Request $request, $id)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;
        $firm_id = $id;

        $requester_name = Auth::user()->username;
        $requester_phone = Auth::user()->mobile;

        $firm_owner_id = Firm::where('id', $firm_id)->first('created_by')->created_by;

        $firm_owner_email = User::where('id', $firm_owner_id)->first('email')->email;

        $firm_owner_name = User::where('id', $firm_owner_id)->first('username')->username;

        $firm_name = Firm::where('id', $id)->first('name')->name;

        // Generate and send verificaion code to firm owner

        $verf_code = mt_rand(1,100000000);

        $confirmation = new FirmRequestConfirmation();
        $confirmation->firm_id = $firm_id;
        $confirmation->created_by = $firm_owner_id;
        $confirmation->requester_id = $user_id;
        $confirmation->ver_code = $verf_code;
        $confirmation->save();

        $email = 'Dear'." ".$firm_owner_name." ".$requester_name." ".'with mobile number'." ".$requester_phone." ".'has requested to register under Firm'." ".$firm_name." ".', If you recognize this member please share with him/her following registration confirmation code '." ".$verf_code;

        $toEmail = $firm_owner_email;
        \Mail::to($toEmail)->send(new VerifyFirm($email));

        return redirect()->intended('petition/firm-confirmation')->with('success', 'Email confirmation code sent to '. $toEmail);

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


        /**
     * request firm registration
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function post_firm_confirmation(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;

        $ver_code = $request->input('code');

        //Find and compare the verificaion code
        $verf_code = FirmRequestConfirmation::where('requester_id', $user_id)->first('ver_code')->ver_code;
        $firm_id = FirmRequestConfirmation::where('requester_id', $user_id)->first('firm_id')->firm_id;

        if($ver_code != $verf_code ){

            return back()->withErrors('You entered wrong code!');

        }else{

            //Chech for application moves
            $application_moves = ApplicationMove::where('user_id', $user_id)->first();

            if($application_moves){

                //Update firm members values
                $current_value = Firm::where('id', $firm_id)->first('members')->members;

                $progress_member = 1;
                $new_members = $current_value + $progress_member;

                $members = DB::table('firms')
                                ->where('id', $firm_id)
                                ->update(['members' => $new_members]);

                //Update progress values
                $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
                $progress_form = 5;
                $value = 1;
                $new_progress = $progress + $progress_form;

                $progress = DB::table('application_moves')
                                ->where('user_id', $user_id)
                                ->update(['appl_progress' => $new_progress]);

                //Update petition form
                $petition_form = DB::table('petition_forms')
                                ->where('user_id', $user_id)
                                ->update(['firm' => $value]);

                //Add firm membership
                $date = date("Y-m-d");

                $firm_membership = new FirmMembership();
                $firm_membership->date_joined = $date;
                $firm_membership->date_requested = $date;
                $firm_membership->firm_id = $firm_id;
                $firm_membership->user_id = Auth::user()->id;
                $firm_membership->save();

                return Redirect::to("petition/add-firm")->with('success', 'Firm registration successful!');


            }else{
                return back()->withErrors('You cant complete this step until you submit at least your personal information!');
            }


        }

        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }


          /**
     * submit entire application
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function submit_application(Request $request)
    {
        if(Auth::check()){

        $user_id = Auth::user()->id;

                //Update progress values
                $progress = ApplicationMove::where('user_id', $user_id)->first(['appl_progress'])->appl_progress;
                $progress_form = 5;
                $value = 1;
                $new_progress = $progress + $progress_form;

                $progress = DB::table('application_moves')
                                ->where('user_id', $user_id)
                                ->update(['appl_progress' => $new_progress]);

                //Update petition form
                $petition_form = DB::table('petition_forms')
                                ->where('user_id', $user_id)
                                ->update(['firm' => $value]);


                return Redirect::to("petition/finish")->with('success', 'Application submitted successful!');


        }
        return Redirect::to("auth/login")->withErrors('You do not have access!');
    }

    /**
     * edit the specified officer group
     * @param \Illuminate\Http\Request $request
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function edit_officer_group(Request $request, $id)
    {
        try {
            $officer_group = OfficerGroup::findOrFail($id);

            $this->validate($request, [
                'name' => 'required'
            ]);

            $officer_group->name = $request->input('name');
            $officer_group->save();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Officer group updated successfully.',
                'officer_group' => $officer_group
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found'
            ], 404);
        }
    }


    /**
     * delete the specified officer group
     * @param int $int
     * @param \Illuminate\Http\Response
     */
    public function delete_officer_group($id)
    {
        try {
            $officer_group = OfficerGroup::findOrFail($id);
            $officer_group->delete();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Officer group deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found'
            ], 404);
        }
    }
}
