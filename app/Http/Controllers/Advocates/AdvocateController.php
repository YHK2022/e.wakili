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
use App\Models\Petitions\FirmMembership;
use App\Models\Petitions\FirmAddress;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator,Redirect;
use Illuminate\Database\QueryException;

class AdvocateController extends Controller
{
    
    
    /**
     * Advocate live search 
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
            $output .= '<li class="list-group-item">'.'<table>'.'<tr>'.'<td style="width:90%;font-size:15px;color:red;">'.'No Advocate match with search results, try again with valid input !'.'</td>'.'<td style="width:10%">'.'</td>'.'</tr>'.'</table>'.'</li>';
        }
       
        return $output;

      }
    }


 
}
