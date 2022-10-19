<?php

namespace App\Models\Admissions;

use App\Models\Cases\CaseSubtype;
use App\Models\Cases\Charge;
use App\Models\Cases\Complainant;
use App\Models\Cases\Nature;
use App\Models\Cases\Respondent;
use App\Models\Courts\Court;
use App\Models\Courts\CourtSubmission;
use App\Models\Locations\District;
use App\Profile;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function case_subtype()
    {
        return $this->belongsTo(CaseSubtype::class);
    }

    public function court_submission()
    {
        return $this->belongsTo(CourtSubmission::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function charges()
    {
        return $this->belongsToMany(Charge::class);
    }

    public function natures()
    {
        return $this->belongsToMany(Nature::class);
    }

    public function complainants()
    {
        return $this->belongsToMany(Complainant::class);
    }

    public function respondents()
    {
        return $this->belongsToMany(Respondent::class);
    }
}
