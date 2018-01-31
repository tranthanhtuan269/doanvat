<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\JobType;
use Illuminate\Http\Request;
use Session;

class JobTypeController extends Controller
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
            $jobtype = JobType::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $jobtype = JobType::paginate($perPage);
        }

        return view('job-type.index', compact('jobtype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('job-type.create');
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        JobType::create($requestData);

        Session::flash('flash_message', 'JobType added!');

        return redirect('admin/job-type');
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
        $jobtype = JobType::findOrFail($id);

        return view('job-type.show', compact('jobtype'));
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
        $jobtype = JobType::findOrFail($id);

        return view('job-type.edit', compact('jobtype'));
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
			'name' => 'required'
		]);
        $requestData = $request->all();
        
        $jobtype = JobType::findOrFail($id);
        $jobtype->update($requestData);

        Session::flash('flash_message', 'JobType updated!');

        return redirect('admin/job-type');
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
        JobType::destroy($id);

        Session::flash('flash_message', 'JobType deleted!');

        return redirect('admin/job-type');
    }

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['jobtype'])){
            $jobtype = JobType::findOrFail($input['jobtype']);
            $jobtype->spa_show = 1;
            if($jobtype->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['jobtype'])){
            $jobtype = JobType::findOrFail($input['jobtype']);
            $jobtype->spa_show = 0;
            if($jobtype->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }
}
