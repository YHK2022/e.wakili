<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Locations\District;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DistrictController extends Controller
{
    /**
     * get a listing of districts.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request)
    {
        if ($request->input('all')) {
            $districts = District::orderBy('id', 'asc')->get();
        } else {
            $districts = District::paginate(10);
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'district' => $districts
        ], 200);
    }

    /**
     * add a new district
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_district(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:districts,name',
            'code' => 'required',
            'region_id' => 'required'
        ]);

        $district = new District();
        $district->name = $request->input('name');
        $district->code = $request->input('code');
        $district->region_id = $request->input('region_id');
        $district->save();

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'District created successfully.',
            'district' => $district
        ], 201);
    }

    /**
     * show the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_district($id)
    {
        try {
            $district = District::with('courts')->findOrFail($id);

            return response()->json([
                'code' => Response::HTTP_OK,
                'district' => $district
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }

    /**
     * edit the specified district.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_district(Request $request, $id)
    {
        try {
            $district = District::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'code' => 'required',
                'region_id' => 'required'
            ]);

            $district->name = $request->input('name');
            $district->code = $request->input('code');
            $district->region_id = $request->input('region_id');
            $district->save();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'District updated successfully.',
                'district' => $district
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }

    /**
     * delete the specified district.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_district($id)
    {
        try {
            $district = District::findOrFail($id);
            $district->delete();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'District deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }
}
