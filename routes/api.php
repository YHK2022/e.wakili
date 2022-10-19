<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/profile', 'AuthController@profile');
    Route::post('/password-verify', 'Authentications\ForgotPasswordController@verify_email');
    Route::post('/password-reset', 'Authentications\ResetPasswordController@reset_response');
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/roles', ['uses' => 'Roles\RoleController@get_index']);
    Route::post('/roles', ['uses' => 'Roles\RoleController@add_role']);
    Route::get('/roles/show/{id}', ['uses' => 'Roles\RoleController@show_role']);
    Route::put('/roles/edit/{id}', ['uses' => 'Roles\RoleController@edit_role']);
    Route::delete('/roles/delete/{id}', ['uses' => 'Roles\RoleController@delete_role']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/court-levels', ['uses' => 'Courts\CourtLevelController@get_index']);
    Route::post('/court-levels', ['uses' => 'Courts\CourtLevelController@add_court_level']);
    Route::get('/court-levels/show/{id}', ['uses' => 'Courts\CourtLevelController@show_court_level']);
    Route::put('/court-levels/edit/{id}', ['uses' => 'Courts\CourtLevelController@edit_court_level']);
    Route::delete('/court-levels/delete/{id}', ['uses' => 'Courts\CourtLevelController@delete_court_level']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/zones', ['uses' => 'Locations\ZoneController@get_index']);
    Route::post('/zones', ['uses' => 'Locations\ZoneController@add_zone']);
    Route::get('/zones/show/{id}', ['uses' => 'Locations\ZoneController@show_zone']);
    Route::put('/zones/edit/{id}', ['uses' => 'Locations\ZoneController@edit_zone']);
    Route::delete('/zones/delete/{id}', ['uses' => 'Locations\ZoneController@delete_zone']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/regions', ['uses' => 'Locations\RegionController@get_index']);
    Route::post('/regions', ['uses' => 'Locations\RegionController@add_region']);
    Route::get('/regions/show/{id}', ['uses' => 'Locations\RegionController@show_region']);
    Route::put('/regions/edit/{id}', ['uses' => 'Locations\RegionController@edit_region']);
    Route::delete('/regions/delete/{id}', ['uses' => 'Locations\RegionController@delete_region']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/districts', ['uses' => 'Locations\DistrictController@get_index']);
    Route::post('/districts', ['uses' => 'Locations\DistrictController@add_district']);
    Route::get('/districts/show/{id}', ['uses' => 'Locations\DistrictController@show_district']);
    Route::put('/districts/edit/{id}', ['uses' => 'Locations\DistrictController@edit_district']);
    Route::delete('/districts/delete/{id}', ['uses' => 'Locations\DistrictController@delete_district']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/courts', ['uses' => 'Courts\CourtController@get_index']);
    Route::post('/courts', ['uses' => 'Courts\CourtController@add_court']);
    Route::get('/courts/show/{id}', ['uses' => 'Courts\CourtController@show_court']);
    Route::put('/courts/edit/{id}', ['uses' => 'Courts\CourtController@edit_court']);
    Route::delete('/courts/delete/{id}', ['uses' => 'Courts\CourtController@delete_court']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/court-rooms', ['uses' => 'Courts\CourtRoomController@get_index']);
    Route::post('/court-rooms', ['uses' => 'Courts\CourtRoomController@add_court_room']);
    Route::get('/court-rooms/show/{id}', ['uses' => 'Courts\CourtRoomController@show_court_room']);
    Route::put('/court-rooms/edit/{id}', ['uses' => 'Courts\CourtRoomController@edit_court_room']);
    Route::delete('/court-rooms/delete/{id}', ['uses' => 'Courts\CourtRoomController@delete_court_room']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/court-submissions', ['uses' => 'Courts\CourtSubmissionController@get_index']);
    Route::post('/court-submissions', ['uses' => 'Courts\CourtSubmissionController@add_court_submission']);
    Route::get('/court-submissions/show/{id}', ['uses' => 'Courts\CourtSubmissionController@show_court_submission']);
    Route::put('/court-submissions/edit/{id}', ['uses' => 'Courts\CourtSubmissionController@edit_court_submission']);
    Route::delete('/court-submissions/delete/{id}', ['uses' => 'Courts\CourtSubmissionController@delete_court_submission']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/case-registers', ['uses' => 'Cases\CaseRegisterController@get_index']);
    Route::post('/case-registers', ['uses' => 'Cases\CaseRegisterController@add_case_register']);
    Route::get('/case-registers/show/{id}', ['uses' => 'Cases\CaseRegisterController@show_case_register']);
    Route::put('/case-registers/edit/{id}', ['uses' => 'Cases\CaseRegisterController@edit_case_register']);
    Route::delete('/case-registers/delete/{id}', ['uses' => 'Cases\CaseRegisterController@delete_case_register']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/case-types', ['uses' => 'Cases\CaseTypeController@get_index']);
    Route::post('/case-types', ['uses' => 'Cases\CaseTypeController@add_case_type']);
    Route::get('/case-types/show/{id}', ['uses' => 'Cases\CaseTypeController@show_case_type']);
    Route::put('/case-types/edit/{id}', ['uses' => 'Cases\CaseTypeController@edit_case_type']);
    Route::delete('/case-types/delete/{id}', ['uses' => 'Cases\CaseTypeController@delete_case_type']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/case-subtypes', ['uses' => 'Cases\CaseSubtypeController@get_index']);
    Route::post('/case-subtypes', ['uses' => 'Cases\CaseSubtypeController@add_case_subtype']);
    Route::get('/case-subtypes/show/{id}', ['uses' => 'Cases\CaseSubtypeController@show_case_subtype']);
    Route::put('/case-subtypes/edit/{id}', ['uses' => 'Cases\CaseSubtypeController@edit_case_subtype']);
    Route::delete('/case-subtypes/delete/{id}', ['uses' => 'Cases\CaseSubtypeController@delete_case_subtype']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/mode-determinations', ['uses' => 'Cases\ModeDeterminationController@get_index']);
    Route::post('/mode-determinations', ['uses' => 'Cases\ModeDeterminationController@add_mode_determination']);
    Route::get('/mode-determinations/show/{id}', ['uses' => 'Cases\ModeDeterminationController@show_mode_determination']);
    Route::put('/mode-determinations/edit/{id}', ['uses' => 'Cases\ModeDeterminationController@edit_mode_determination']);
    Route::delete('/mode-determinations/delete/{id}', ['uses' => 'Cases\ModeDeterminationController@delete_mode_determination']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/proceeding-outcomes', ['uses' => 'Cases\ProceedingOutcomeController@get_index']);
    Route::post('/proceeding-outcomes', ['uses' => 'Cases\ProceedingOutcomeController@add_proceeding_outcome']);
    Route::get('/proceeding-outcomes/show/{id}', ['uses' => 'Cases\ProceedingOutcomeController@show_proceeding_outcome']);
    Route::put('/proceeding-outcomes/edit/{id}', ['uses' => 'Cases\ProceedingOutcomeController@edit_proceeding_outcome']);
    Route::delete('/proceeding-outcomes/delete/{id}', ['uses' => 'Cases\ProceedingOutcomeController@delete_proceeding_outcome']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/case-stages', ['uses' => 'Cases\CaseStageController@get_index']);
    Route::post('/case-stages', ['uses' => 'Cases\CaseStageController@add_case_stage']);
    Route::get('/case-stages/show/{id}', ['uses' => 'Cases\CaseStageController@show_case_stage']);
    Route::put('/case-stages/edit/{id}', ['uses' => 'Cases\CaseStageController@edit_case_stage']);
    Route::delete('/case-stages/delete/{id}', ['uses' => 'Cases\CaseStageController@delete_case_stage']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/case-outcomes', ['uses' => 'Cases\CaseOutcomeController@get_index']);
    Route::post('/case-outcomes', ['uses' => 'Cases\CaseOutcomeController@add_case_outcome']);
    Route::get('/case-outcomes/show/{id}', ['uses' => 'Cases\CaseOutcomeController@show_case_outcome']);
    Route::put('/case-outcomes/edit/{id}', ['uses' => 'Cases\CaseOutcomeController@edit_case_outcome']);
    Route::delete('/case-outcomes/delete/{id}', ['uses' => 'Cases\CaseOutcomeController@delete_case_outcome']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/case-nature', ['uses' => 'Cases\CaseNatureController@get_index']);
    Route::post('/case-nature', ['uses' => 'Cases\CaseNatureController@add_case_nature']);
    Route::get('/case-nature/show/{id}', ['uses' => 'Cases\CaseNatureController@show_case_nature']);
    Route::put('/case-nature/edit/{id}', ['uses' => 'Cases\CaseNatureController@edit_case_nature']);
    Route::delete('/case-nature/delete/{id}', ['uses' => 'Cases\CaseNatureController@delete_case_nature']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/case-charges', ['uses' => 'Cases\CaseChargeController@get_index']);
    Route::post('/case-charges', ['uses' => 'Cases\CaseChargeController@add_case_charge']);
    Route::get('/case-charges/show/{id}', ['uses' => 'Cases\CaseChargeController@show_case_register']);
    Route::put('/case-charges/edit/{id}', ['uses' => 'Cases\CaseChargeController@edit_case_charge']);
    Route::delete('/case-charges/delete/{id}', ['uses' => 'Cases\CaseChargeController@delete_case_charge']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/groups', ['uses' => 'Administrations\OfficerGroupController@get_index']);
    Route::post('/groups', ['uses' => 'Administrations\OfficerGroupController@add_officer_group']);
    Route::get('/groups/show/{id}', ['uses' => 'Administrations\OfficerGroupController@show_officer_group']);
    Route::put('/groups/edit/{id}', ['uses' => 'Administrations\OfficerGroupController@edit_officer_group']);
    Route::delete('/groups/delete/{id}', ['uses' => 'Administrations\OfficerGroupController@delete_officer_group']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/positions', ['uses' => 'Administrations\OfficerPositionController@get_index']);
    Route::post('/positions', ['uses' => 'Administrations\OfficerPositionController@add_officer_position']);
    Route::get('/positions/show/{id}', ['uses' => 'Administrations\OfficerPositionController@show_officer_position']);
    Route::put('/positions/edit/{id}', ['uses' => 'Administrations\OfficerPositionController@edit_officer_position']);
    Route::delete('/positions/delete/{id}', ['uses' => 'Administrations\OfficerPositionController@delete_officer_position']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/seniorities', ['uses' => 'Administrations\SeniorityController@get_index']);
    Route::post('/seniorities', ['uses' => 'Administrations\SeniorityController@add_seniority']);
    Route::get('/seniorities/show/{id}', ['uses' => 'Administrations\SeniorityController@show_seniorty']);
    Route::put('/seniorities/edit/{id}', ['uses' => 'Administrations\SeniorityController@edit_seniority']);
    Route::delete('/seniorities/delete/{id}', ['uses' => 'Administrations\SeniorityController@delete_seniority']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/officers', ['uses' => 'Administrations\OfficerController@get_index']);
    Route::post('/officers/{user_id}', ['uses' => 'Administrations\OfficerController@update_officer']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1/criminal'], function () {
    Route::get('/cases', ['uses' => 'Cases\Criminals\CriminalController@get_index']);
    Route::post('/cases', ['uses' => 'Cases\Criminals\CriminalController@add_criminal_case']);
    Route::get('/cases/show/{id}', ['uses' => 'Cases\Criminals\CriminalController@show_criminal_case']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1/criminal'], function () {
    Route::get('/case-charges', ['uses' => 'Cases\Criminals\CriminalChargeController@get_index']);
    Route::post('/{criminal_case_id}/case-charges', ['uses' => 'Cases\Criminals\CriminalChargeController@add_criminal_charge']);
    Route::get('/case-charges/show/{id}', ['uses' => 'Cases\Criminals\CriminalChargeController@show_criminal_charge']);
    Route::put('/{criminal_case_id}/case-charges/edit/{id}', ['uses' => 'Cases\Criminals\CriminalChargeController@edit_criminal_charge']);
    Route::delete('/case-charges/delete/{id}', ['uses' => 'Cases\Criminals\CriminalChargeController@delete_criminal_charge']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1/criminal'], function () {
    Route::get('/case-nature', ['uses' => 'Cases\Criminals\CriminalNatureController@get_index']);
    Route::post('/{criminal_case_id}/case-nature', ['uses' => 'Cases\Criminals\CriminalNatureController@add_criminal_nature']);
    Route::get('/case-nature/show/{id}', ['uses' => 'Cases\Criminals\CriminalNatureController@show_criminal_nature']);
    Route::put('/{criminal_case_id}/case-nature/edit/{id}', ['uses' => 'Cases\Criminals\CriminalNatureController@edit_criminal_nature']);
    Route::delete('/case-nature/delete/{id}', ['uses' => 'Cases\Criminals\CriminalNatureController@delete_criminal_nature']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/complainants', ['uses' => 'Cases\ComplainantController@get_index']);
    Route::post('/complainants', ['uses' => 'Cases\ComplainantController@add_complainant']);
    Route::get('/complainants/show/{id}', ['uses' => 'Cases\ComplainantController@show_complainant']);
    Route::put('/complainants/edit/{id}', ['uses' => 'Cases\ComplainantController@edit_complainant']);
    Route::delete('/complainants/delete/{id}', ['uses' => 'Cases\ComplainantController@delete_complainant']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/respondents', ['uses' => 'Cases\RespondentController@get_index']);
    Route::post('/respondents', ['uses' => 'Cases\RespondentController@add_respondent']);
    Route::get('/respondents/show/{id}', ['uses' => 'Cases\RespondentController@show_respondent']);
    Route::put('/respondents/edit/{id}', ['uses' => 'Cases\RespondentController@edit_respondent']);
    Route::delete('/respondents/delete/{id}', ['uses' => 'Cases\RespondentController@delete_respondent']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/victims', ['uses' => 'Cases\VictimController@get_index']);
    Route::post('/victims', ['uses' => 'Cases\VictimController@add_victim']);
    Route::get('/victims/show/{id}', ['uses' => 'Cases\VictimController@show_victim']);
    Route::put('/victims/edit/{id}', ['uses' => 'Cases\VictimController@edit_victim']);
    Route::delete('/victims/delete/{id}', ['uses' => 'Cases\VictimController@delete_victim']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1/criminal'], function () {
    Route::get('/complainants', ['uses' => 'Cases\Criminals\CriminalComplainantController@get_index']);
    Route::post('/{criminal_id}/complainants', ['uses' => 'Cases\Criminals\CriminalComplainantController@add_criminal_complainant']);
    Route::get('/complainants/show/{id}', ['uses' => 'Cases\Criminals\CriminalComplainantController@show_criminal_complainant']);
    Route::put('/{criminal_id}/complainants/edit/{id}', ['uses' => 'Cases\Criminals\CriminalComplainantController@edit_criminal_complainant']);
    Route::delete('/complainants/delete/{id}', ['uses' => 'Cases\Criminals\CriminalComplainantController@delete_criminal_complainant']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1/criminal'], function () {
    Route::get('/respondents', ['uses' => 'Cases\Criminals\CriminalRespondentController@get_index']);
    Route::post('/{criminal_id}/respondents', ['uses' => 'Cases\Criminals\CriminalRespondentController@add_criminal_respondent']);
    Route::get('/respondents/show/{id}', ['uses' => 'Cases\Criminals\CriminalRespondentController@show_criminal_respondent']);
    Route::put('/{criminal_id}/respondents/edit/{id}', ['uses' => 'Cases\Criminals\CriminalRespondentController@edit_criminal_respondent']);
    Route::delete('/respondents/delete/{id}', ['uses' => 'Cases\Criminals\CriminalRespondentController@delete_criminal_respondent']);
});

Route::group(['middleware' => 'api', 'prefix' => 'v1/criminal'], function () {
    Route::get('/victims', ['uses' => 'Cases\Criminals\CriminalVictimController@get_index']);
    Route::post('/{criminal_id}/victims', ['uses' => 'Cases\Criminals\CriminalVictimController@add_criminal_victim']);
    Route::get('/victims/show/{id}', ['uses' => 'Cases\Criminals\CriminalVictimController@show_criminal_victim']);
    Route::put('/{criminal_id}/victims/edit/{id}', ['uses' => 'Cases\Criminals\CriminalVictimController@edit_criminal_victim']);
    Route::delete('/victims/delete/{id}', ['uses' => 'Cases\Criminals\CriminalVictimController@delete_criminal_victim']);
});
