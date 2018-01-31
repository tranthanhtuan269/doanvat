<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Job;
use App\Company;
use App\Apply;
use Illuminate\Http\Request;
use Session;

class JobController extends Controller
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
            $job = \DB::table('jobs')
                ->join('companies', 'companies.id', '=', 'jobs.company')
                ->join('cities', 'cities.id', '=', 'companies.city')
                ->where('jobs.name', 'LIKE', "%$keyword%")
                ->orWhere('jobs.expiration_date', 'LIKE', "%$keyword%")
                ->orWhere('cities.id', 'LIKE', "%$keyword%")
                ->select(
                    'jobs.id',
                    'jobs.name',
                    'companies.name as salary',
                    'jobs.vip as vip',
                    'jobs.expiration_date as expiration_date',
                    'cities.name as city'
                )
                ->orderBy('jobs.created_at', 'desc')
                ->paginate($perPage);
        } else {
            $job = \DB::table('jobs')
                ->join('companies', 'companies.id', '=', 'jobs.company')
                ->join('cities', 'cities.id', '=', 'companies.city')
                ->select(
                    'jobs.id',
                    'jobs.name',
                    'companies.name as salary',
                    'jobs.vip as vip',
                    'jobs.expiration_date as expiration_date',
                    'cities.name as city'
                )
                ->orderBy('jobs.created_at', 'desc')
                ->paginate($perPage);
        }

        return view('job.index', compact('job'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('job.create');
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
			'company' => 'required'
		]);
        $requestData = $request->all();
        
        Job::create($requestData);

        Session::flash('flash_message', 'Job added!');

        return redirect('admin/job');
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
        $job = Job::findOrFail($id);

        return view('job.show', compact('job'));
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
        $job = Job::findOrFail($id);

        return view('job.edit', compact('job'));
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
			'company' => 'required'
		]);
        $requestData = $request->all();
        
        $job = Job::findOrFail($id);
        $job->update($requestData);

        Session::flash('flash_message', 'Job updated!');

        return redirect('admin/job');
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
        Job::destroy($id);

        Session::flash('flash_message', 'Job deleted!');

        return redirect('admin/job');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function createJob() {
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
            $current_id = $user_info['user_id'];
            
            //get company 
            $company = \DB::table('companies')
                    ->where('companies.user', $current_id)
                    ->first();
            $jobstype = \App\JobType::pluck('name', 'id');
            $salaries = \App\Salary::pluck('name', 'id');
            if($company){
                $branches = \DB::table('branches')
                    ->join('cities', 'cities.id', '=', 'branches.city')
                    ->join('districts', 'districts.id', '=', 'branches.district')
                    ->where('branches.company', $company->id)
                    ->select(
                        'branches.id as id',
                        'branches.name as name',
                        'branches.address as address',
                        'cities.name as city',
                        'districts.name as district'
                        )
                    ->get();
                return view('job.create_job', compact('branches', 'salaries', 'jobstype', 'company', 'cv_id', 'company_id'));
            }else{
                return redirect('company/create');
            }
        }
        
        return redirect()->back();
    }

    public function storeJob(Request $request) {
        $input = $request->all();
        if ($input['description'] == null) {
            $input['description'] = '';
        }
        if ($input['requirement'] == null) {
            $input['requirement'] = '';
        }
        if ($input['benefit'] == null) {
            $input['benefit'] = '';
        }
        if ($input['number'] == null) {
            $input['number'] = 1;
        }
        if ($input['expiration_date'] == null) {
            $input['expiration_date'] = date("Y-m-d H:i:s");
        }
        if (!isset($input['job_type']) || $input['job_type'] == null) {
            $input['job_type'] = 1;
        }
        if (isset($input['work_type']) || $input['work_type'] == null) {
            $input['work_type'] = 0;
        }
        $input['work_time'] = date("Y-m-d H:i:s");
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['updated_at'] = date("Y-m-d H:i:s");
        $input['public'] = 1;
        $current_id = \Auth::user()->id;

        // check followed
        $company = Company::where('user', $current_id)->orderBy('created_at', 'desc')->select('id')->first();
        if($company){
            $input['company'] = $company->id;
        }else{
            $input['company'] = 0;
        }
        
        $job = Job::create($input);

        if ($job) {
            return redirect()->action(
                    'JobController@info', ['id' => $job->id]
                );
        }

        return redirect()->back();
    }

    public function info($id){

        $job_selected = Job::find($id);
        $job_selected->views = $job_selected->views + 1;
        $job_selected->save();

        $company_id = -1;
        $cv_id = -1;
        $applied = 0;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
            $current_id = $user_info['user_id'];
            
            $apply_check = \DB::table('applies')
                    ->where('applies.user', $current_id)
                    ->where('applies.job', $id)
                    ->select(
                        'id'
                    )
                    ->first();
            
            if($apply_check){
                $applied = 1;
            }
        }
        
        $job = \DB::table('jobs')
                ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                ->select(
                        'jobs.id',
                        'jobs.name',
                        'jobs.description',
                        'jobs.required',
                        'jobs.requirement',
                        'jobs.benefit',
                        'jobs.number',
                        'jobs.company',
                        'jobs.expiration_date',
                        'jobs.job_type',
                        'jobs.gender',
                        'jobs.branches',
                        'salaries.name as salary'
                )
                ->where('jobs.id', $id)
                ->first();
        if($job && $job->company){
            $company = \DB::table('companies')
                ->join('cities', 'cities.id', '=', 'companies.city')
                ->join('districts', 'districts.id', '=', 'companies.district')
                ->join('towns', 'towns.id', '=', 'companies.town')
                ->join('company_sizes', 'company_sizes.id', '=', 'companies.size')
                ->select(
                        'companies.id', 
                        'companies.name', 
                        'companies.logo', 
                        'companies.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'towns.name as town', 
                        'companies.jobs', 
                        'company_sizes.size as size', 
                        'companies.sologan', 
                        'companies.description',
                        'companies.site_url',
                        'companies.images'
                )
                ->where('companies.id', $job->company)
                ->first();
            $branches = [];
            if($company){
                $branches = \DB::table('branches')
                            ->join('cities', 'cities.id', '=', 'branches.city')
                            ->where('company', $company->id)
                            ->select(
                                'branches.city', 
                                'cities.name as city'
                            )
                            ->distinct()
                            ->get();
            }

            $job_relatives = \DB::table('jobs')
                                ->join('companies', 'companies.id', '=', 'jobs.company')
                                ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                                ->join('cities', 'cities.id', '=', 'companies.city')
                                ->join('districts', 'districts.id', '=', 'companies.district')
                                ->where('jobs.job_type', '=', $job->job_type)
                                ->select('jobs.id as id', 'jobs.name as name', 'salaries.name as salary', 'companies.logo', 'companies.name as companyname', 'cities.name as city', 'districts.name as district')
                                ->orderBy('jobs.created_at', 'desc')
                                ->take(12)
                                ->get();
            return view('job.info', compact('job', 'company', 'company_id', 'cv_id', 'applied', 'branches', 'job_relatives'));
        }
        return view('errors.404');
    }

    public function join(Request $request){
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;

            // check exist CV
            $cv_user = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($cv_user){
                // check job exist
                if(isset($request->job) && $request->job > 0){
                    $exitApply = Apply::where('user', $current_id)->where('job', $request->job)->first();
                    if($exitApply){
                        return \Response::json(array('code' => '200', 'message' => 'Apply is existed!'));
                    }
                    $apply = new Apply;

                    $apply->user = $current_id;
                    $apply->job = $request->job;

                    if($apply->save()){
                        $job_selected = Job::find($request->job);
                        $job_selected->applied = $job_selected->applied + 1;
                        $job_selected->save();
                        return \Response::json(array('code' => '200', 'message' => 'Created success!'));
                    }
                }
            }else{
                return \Response::json(array('code' => '401', 'message' => 'No curriculum vitaes!'));
            }
            return \Response::json(array('code' => '403', 'message' => 'Created unsuccess!'));
        }else{
            return \Response::json(array('code' => '401', 'message' => 'unauthen!'));
        }
    }

    public function vip(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['job'])){
            $job = Job::findOrFail($input['job']);
            $job->vip = 2;
            if($job->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function vip2(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['job'])){
            $job = Job::findOrFail($input['job']);
            $job->vip = 0;
            if($job->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unvip(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['job'])){
            $job = Job::findOrFail($input['job']);
            $job->vip = 1;
            if($job->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function getJob(){
        $jobGetObj = new Job;
        $district = $city = $field = $job_type = $company = $cv = $vip = $from = $number_get = null;
        $number_get = 5;
        if(isset($_GET)){

            if(isset($_GET['start']) && $_GET['start'] > 0){
                $from = $_GET['start'];
            }
            
            if(isset($_GET['job_type']) && $_GET['job_type'] > 0){
                $job_type = $_GET['job_type'];
            }

            if(isset($_GET['city']) && $_GET['city'] > 0){
                $city = $_GET['city'];
            }

            if(isset($_GET['district']) && $_GET['district'] > 0){
                $district = $_GET['district'];
            }

            if(isset($_GET['job'])){
                if($_GET['job'] == 'vip1'){
                    $vip = 1;
                }else if($_GET['job'] == 'vip2'){
                    $vip = 2;
                }else if($_GET['job'] == 'new'){
                    $vip = 0;
                }
            }

            $jobs = $jobGetObj->getJob($district, $city, $field, $job_type, $company, $cv, $vip, $from, $number_get);
            return \Response::json(array('code' => '200', 'message' => 'Success!', 'jobs' => $jobs));
        }
    }
}
