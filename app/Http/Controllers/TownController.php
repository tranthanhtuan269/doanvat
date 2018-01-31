<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Town;
use App\District;
use Illuminate\Http\Request;
use Session;
use DB;

class TownController extends Controller
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
            $town = Town::where('name', 'LIKE', "%$keyword%")
				->orWhere('district', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $town = DB::table('towns')
            ->join('districts', 'districts.id', '=', 'towns.district')
            ->select('towns.id', 'towns.name', 'districts.name as district')
            ->paginate($perPage);
        }

        return view('town.index', compact('town'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $districts = District::pluck('name', 'id');
        return view('town.create', compact('districts'));
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
			'district' => 'required'
		]);
        $requestData = $request->all();
        
        Town::create($requestData);

        Session::flash('flash_message', 'Town added!');

        return redirect('admin/town');
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
        $town = Town::findOrFail($id);
        $district = District::findOrFail($town->district);

        return view('town.show', compact('town', 'district'));
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
        $town = Town::findOrFail($id);
        $districts = District::pluck('name', 'id');
        return view('town.edit', compact('town', 'districts'));
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
			'district' => 'required'
		]);
        $requestData = $request->all();
        
        $town = Town::findOrFail($id);
        $town->update($requestData);

        Session::flash('flash_message', 'Town updated!');

        return redirect('admin/town');
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
        Town::destroy($id);

        Session::flash('flash_message', 'Town deleted!');

        return redirect('admin/town');
    }
}
