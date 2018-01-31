<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\District;
use App\City;
use Illuminate\Http\Request;
use Session;
use DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $district = District::where('name', 'LIKE', "%$keyword%")
				->orWhere('city', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $district = DB::table('districts')
            ->join('cities', 'cities.id', '=', 'districts.city')
            ->select('districts.id', 'districts.name', 'cities.name as city', 'districts.active')
            ->paginate($perPage);
        }

        return view('district.index', compact('district'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = City::pluck('name', 'id');
        return view('district.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'city' => 'required'
		]);
        $requestData = $request->all();
        
        District::create($requestData);

        Session::flash('flash_message', 'District added!');

        return redirect('admin/district');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $district = District::findOrFail($id);
        $city = City::findOrFail($district->city);
        return view('district.show', compact('district', 'city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $district = District::findOrFail($id);
        $cities = City::pluck('name', 'id');
        return view('district.edit', compact('district', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'city' => 'required'
		]);
        $requestData = $request->all();
        
        $district = District::findOrFail($id);
        $district->update($requestData);

        Session::flash('flash_message', 'District updated!');

        return redirect('admin/district');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        District::destroy($id);

        Session::flash('flash_message', 'District deleted!');

        return redirect('admin/district');
    }

    public function admin()
    {
        $perPage = 10;

        $districts = \DB::table('districts')
            ->join('cities', 'cities.id', '=', 'districts.city')
            ->where('cities.active', '=', 1)
            ->select('districts.id as id', 'districts.name as name', 'districts.active as active', 'cities.name as city')
            ->paginate($perPage);
        return view('district.admin', compact('districts'));
    }

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['district'])){
            $district = District::findOrFail($input['district']);
            $district->active = 1;
            if($district->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['district'])){
            $district = District::findOrFail($input['district']);
            $district->active = 0;
            if($district->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }
}
