<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Apply;
use Illuminate\Http\Request;
use Session;

class ApplyController extends Controller
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
            $apply = Apply::where('user', 'LIKE', "%$keyword%")
				->orWhere('job', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $apply = Apply::paginate($perPage);
        }

        return view('apply.index', compact('apply'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('apply.create');
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
			'user' => 'required',
			'job' => 'required'
		]);
        $requestData = $request->all();
        
        Apply::create($requestData);

        Session::flash('flash_message', 'Apply added!');

        return redirect('apply');
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
        $apply = Apply::findOrFail($id);

        return view('apply.show', compact('apply'));
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
        $apply = Apply::findOrFail($id);

        return view('apply.edit', compact('apply'));
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
			'user' => 'required',
			'job' => 'required'
		]);
        $requestData = $request->all();
        
        $apply = Apply::findOrFail($id);
        $apply->update($requestData);

        Session::flash('flash_message', 'Apply updated!');

        return redirect('apply');
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
        Apply::destroy($id);

        Session::flash('flash_message', 'Apply deleted!');

        return redirect('apply');
    }

    public function admin()
    {
        $perPage = 10;

        $apply = \DB::table('applies')
            ->join('users', 'users.id', '=', 'applies.user')
            ->join('curriculum_vitaes', 'curriculum_vitaes.user', '=', 'users.id')
            ->join('jobs', 'jobs.id', '=', 'applies.job')
            ->join('companies', 'companies.id', '=', 'jobs.company')
            ->select(
                'applies.id as id',
                'applies.active as active', 
                'curriculum_vitaes.id as cv_id',
                'applies.created_at as created_at', 
                'users.name as user',
                'users.email as email',
                'users.phone as phone',
                'jobs.name as job',
                'companies.id as companyId',
                'companies.name as companyName',
                'companies.phone as companyPhone',
                'companies.email as companyEmail'
                )
            ->orderBy('applies.created_at', 'desc')
            ->paginate($perPage);

        return view('apply.admin', compact('apply'));
    }

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['apply'])){
            $apply = Apply::findOrFail($input['apply']);
            $apply->active = 1;
            if($apply->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['apply'])){
            $apply = Apply::findOrFail($input['apply']);
            $apply->active = 0;
            if($apply->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }
}
