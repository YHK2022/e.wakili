<?php

namespace App\Http\Controllers\Reports;
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
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function petition()
    {
        $applications = DB::select('SELECT A.petition_no,A.lst_regno,B.fullname,A.admit_as,C.type,C.status from petition AS A
        INNER JOIN profiles AS B ON A.profile_id = B.id
        INNER JOIN applications AS C ON A.application_id = C.id;');
    /*
        $advocates = DB::select('SELECT a.roll_no,
        b.fullname,
        b.gender,
        c.email,
        c.phone_number,
        a.admission,
        a.status,
        a.active,
        (date(now()) - a.admission) / 365 AS age
       FROM advocates a
         LEFT JOIN profiles b ON a.profile_id = b.id
         LEFT JOIN users c ON c.id = b.user_id
      ORDER BY age ASC'); */
       
        return view('management.report.petition',compact('applications')); 
    }
    

    public function advocate()
    {
        $advocates = DB::select('SELECT a.roll_no,
        b.fullname,
        b.gender,
        c.email,
        c.phone_number,
        a.admission,
        a.status,
        (date(now()) - a.admission) / 365 AS age
       FROM advocates a
         LEFT JOIN profiles b ON a.profile_id = b.id
         LEFT JOIN users c ON c.id = b.user_id
      ORDER BY age;');

        // dd($advocates);

        return view('management.report.advocate', compact('advocates'));
    }



    public function permit()
    {
        
        $permits = DB::select('SELECT 
        p.fullname,
        B.type,
        W.display_name,
        B.status,
        B.submission_at,
        B.current_stage
        from Applications AS B 
        RIGHT JOIN profiles AS p ON B.profile_id = p.id 
        RIGHT JOIN workflow_process AS W ON B.workflow_process_id = W.id
        WHERE type IS NOT NULL 
        ORDER BY submission_at DESC ;');

        return view('management.report.permit', compact('permits'));
    }

    

    public function revenue()
    {
        $revenues = DB::select('select payctrnum,billamt,paidamt,pyrname,pspreceiptnumber,pspname,pyrcellnum,usdpaychnl,trxdttm 
        from payment ORDER BY trxdttm DESC;');
        return view('management.report.revenue', compact('revenues')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
