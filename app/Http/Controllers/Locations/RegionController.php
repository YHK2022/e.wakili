<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Masterdata\Region;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegionController extends Controller
{
    /**
     * get a listing of regions.
     * @return \Illuminate\Http\Response
     */
    public function get_index(Request $request)
    {
        if ($request->input('all')) {
            $regions = Region::orderBy('id', 'asc')->get();
        } else {
            $regions = Region::with('districts')->paginate(10);
        }

        return response()->json([
            'code' => Response::HTTP_OK,
            'region' => $regions
        ], 200);
    }

    /**
     * add a new region
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function add_region(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique,regions,name',
            'code' => 'required',
            'zone_id' => 'required'
        ]);

        $region = new Region();
        $region->name = $request->input('name');
        $region->code = $request->input('code');
        $region->zone_id = $request->input('zone_id');
        $region->save();

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => 'Region created successfully',
            'region' => $region
        ], 201);
    }

    /**
     * show the specified region.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_region($id)
    {
        try {
            $region = Region::with('districts')->findOrFail($id);

            return response()->json([
                'code' => Response::HTTP_OK,
                'region' => $region
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }

    /**
     * edit the specified region.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_region(Request $request, $id)
    {
        try {
            $region = Region::findOrFail($id);

            $this->validate($request, [
                'name' => 'required',
                'code' => 'required',
                'zone_id' => 'required'
            ]);

            $region->name = $request->input('name');
            $region->code = $request->input('code');
            $region->zone_id = $request->input('zone_id');
            $region->save();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Region updated successfully',
                'region' => $region
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }

    /**
     * delete the specified region.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_region($id)
    {
        try {
            $region = Region::findOrFail($id);
            $region->delete();

            return response()->json([
                'code' => Response::HTTP_OK,
                'message' => 'Region deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'error' => 'Not found.'
            ], 404);
        }
    }
}
