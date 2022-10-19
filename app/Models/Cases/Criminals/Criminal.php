<?php

namespace App\Models\Cases\Criminals;

use App\Models\Cases\CaseSubtype;
use App\Models\Cases\Charge;
use App\Models\Cases\Complainant;
use App\Models\Cases\Nature;
use App\Models\Cases\Respondent;
use App\Models\Cases\Victim;
use App\Models\Courts\Court;
use App\Models\Courts\CourtSubmission;
use App\Models\Locations\District;
use App\Profile;
use Illuminate\Database\Eloquent\Model;

class Criminal extends Model
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

    public function criminal_charges()
    {
        return $this->hasMany(CriminalCharge::class);
    }

    public function natures()
    {
        return $this->belongsToMany(Nature::class);
    }

    public function criminal_natures()
    {
        return $this->hasMany(CriminalNature::class);
    }

    public function complainants()
    {
        return $this->belongsToMany(Complainant::class);
    }

    public function criminal_complainants()
    {
        return $this->hasMany(CriminalComplainant::class);
    }

    public function respondents()
    {
        return $this->belongsToMany(Respondent::class);
    }

    public function criminal_respondents()
    {
        return $this->hasMany(CriminalRespondent::class);
    }

    public function victims()
    {
        return $this->belongsToMany(Victim::class);
    }

    public function criminal_victims()
    {
        return $this->hasMany(CriminalVictim::class);
    }
}
