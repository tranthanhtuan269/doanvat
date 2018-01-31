<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Company;
use App\CompanyCompanyType;
use App\Follow;
use App\Branch;
use App\Job;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class CompanyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $company = \DB::table('companies')
                    ->join('cities', 'cities.id', '=', 'companies.city')
                    ->orWhere('companies.logo', 'LIKE', "%$keyword%")
                    ->orWhere('companies.name', 'LIKE', "%$keyword%")
                    ->orWhere('cities.name', 'LIKE', "%$keyword%")
                    ->orderBy('companies.created_at', 'desc')
                    ->select('companies.logo', 'companies.name', 'cities.name as cityname', 'companies.id', 'companies.show_master')
                    ->paginate($perPage);
        } else {
            $company = \DB::table('companies')
                        ->join('cities', 'cities.id', '=', 'companies.city')
                        ->select('companies.logo', 'companies.name', 'cities.name as cityname', 'companies.id', 'companies.show_master')
                        ->orderBy('companies.created_at', 'desc')
                        ->paginate($perPage);
        }

        return view('company.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('company.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function createCompany() {
        
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
        }

        $company_types = \DB::table('company_types')->get();
        
        return view('company.create_company', compact('company_id', 'cv_id', 'company_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function editCompany() {
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];
            $company_types = \DB::table('company_types')->get();

            if($company_id > 0){
                //load company info
                $company = Company::findOrFail($company_id);

                $cities = \App\City::pluck('name', 'id');
                $districts = \App\District::where('city', '=', $company->city)->pluck('name', 'id');
                $towns = \App\Town::where('district', '=', $company->district)->pluck('name', 'id');
                $branches = \DB::table('branches')
                            ->join('cities', 'cities.id', '=', 'branches.city')
                            ->join('districts', 'districts.id', '=', 'branches.district')
                            ->where('company', '=', $company->id)
                            ->select('branches.id', 'branches.name as name_branch', 'branches.address as address_branch', 'cities.id as city_branch_id', 'cities.name as city_branch_name', 'districts.id as district_branch_id', 'districts.name as district_branch_name')
                            ->get();
                $companytypes = \DB::table('company_company_types')
                            ->join('company_types', 'company_types.id', '=', 'company_company_types.company_type')
                            ->where('company', '=', $company_id)
                            ->select('company_types.name as name')
                            ->get()->toArray();
                $companytypesArr = [];
                foreach($companytypes as $t){
                    array_push($companytypesArr, $t->name);
                }
                return view('company.edit_company', compact('company_id', 'cv_id', 'company_types', 'company', 'cities', 'districts', 'towns', 'branches', 'companytypesArr'));
            }
        }

        return view('errors.404');
    }

    public function updateCompany(Request $request) {
        $company_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            if($company_id > 0){
                $input = $request->all();
                if ($input['description'] == null)
                    $input['description'] = '';

                if($request['logo-image-field'] != ''){
                    $input['logo'] = $request['logo-image-field'];
                }
                if($request['banner-image-field'] != ''){
                    $input['banner'] = $request['banner-image-field'];
                }
                $input['images'] = $request['images-plus-field'];
                $input['user'] = \Auth::user()->id;

                $input['email'] = \Auth::user()->email;
                $input['phone'] = \Auth::user()->phone;
                
                // $company = Company::create($input);
                $company = Company::findOrFail($company_id);
                $company->update($input);

                // remove all branches
                $affectedRows = Branch::where('company', '=', $company->id)->delete();

                if ($company) {
                    $branchs = $input['branchs'];
                    if(isset($branchs) && strlen($branchs) > 0){
                        $branchs = ltrim($branchs, ';');
                        $branch_list = explode(";",$branchs);
                            
                        foreach ($branch_list as $braObject) {
                            if($braObject != 'undefined'){
                                $bra = json_decode($braObject, true);
                                $branObj = new Branch;
                                $branObj->name = $bra['name_branch'];
                                $branObj->address = $bra['address_branch'];
                                $branObj->city = $bra['city_branch_id'];
                                $branObj->district = $bra['district_branch_id'];
                                $branObj->master = 1;
                                $branObj->company = $company->id;
                                $branObj->save();
                            }
                        }
                    }
                    
                    // add CompanyCompanyType
                    if($input['jobs'] != null){
                        // remove companycompanytype
                        $affectedRows = CompanyCompanyType::where('company', '=', $company->id)->delete();

                        $jobs = $input['jobs'];
                        if(isset($jobs) && strlen($jobs) > 0){
                            $jobs = rtrim($jobs, ';');
                            $job_list = explode(";",$jobs);
                                
                            foreach ($job_list as $job) {
                                if($job == 'Khách sạn'){
                                    $jobObj = new CompanyCompanyType;
                                    $jobObj->company_type = 1;
                                    $jobObj->company = $company->id;
                                    $jobObj->save();
                                }else if($job == 'Nhà Hàng'){
                                    $jobObj = new CompanyCompanyType;
                                    $jobObj->company_type = 2;
                                    $jobObj->company = $company->id;
                                    $jobObj->save();
                                }else if($job == 'Cửa hàng'){
                                    $jobObj = new CompanyCompanyType;
                                    $jobObj->company_type = 3;
                                    $jobObj->company = $company->id;
                                    $jobObj->save();
                                }else if($job == 'Doanh nghiệp'){
                                    $jobObj = new CompanyCompanyType;
                                    $jobObj->company_type = 4;
                                    $jobObj->company = $company->id;
                                    $jobObj->save();
                                }else if($job == 'Spa'){
                                    $jobObj = new CompanyCompanyType;
                                    $jobObj->company_type = 5;
                                    $jobObj->company = $company->id;
                                    $jobObj->save();
                                }
                            }
                        }
                    }

                    return redirect()->action(
                            'CompanyController@info', ['id' => $company->id]
                        );
                }
            }
        }

        return redirect()->back();
    }

    public function storeCompany(Request $request) {
        $img_banner = '';
        if ($request->hasFile('banner-img')) {
            $file_banner = $request->file('banner-img');
            $filename = $file_banner->getClientOriginalName();
            $extension = $file_banner->getClientOriginalExtension();
            $img_banner = date('His') . $filename;
            $destinationPath = base_path('../../images');
            $file_banner->move($destinationPath, $img_banner);
        }

        $img_logo = '';
        if ($request->hasFile('logo-img')) {
            $file_logo = $request->file('logo-img');
            $filename = $file_logo->getClientOriginalName();
            $extension = $file_logo->getClientOriginalExtension();
            $img_logo = date('His') . $filename;
            $destinationPath = base_path('../../images');
            $file_logo->move($destinationPath, $img_logo);
        }

        $picture = '';
        $allPic = '';
        if ($request->hasFile('images-img')) {
            $files = $request->file('images-img');
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = date('His') . $filename;
                $allPic .= $picture . ';';
                $destinationPath = base_path('../../images');
                $file->move($destinationPath, $picture);
            }
        }

        $input = $request->all();
        if ($input['description'] == null)
            $input['description'] = '';
        unset($input['banner-img']);
        unset($input['logo-img']);
        unset($input['images-img']);
        $input['logo'] = $img_logo;
        $input['banner'] = $img_banner;
        $input['images'] = $allPic;
        $input['user'] = \Auth::user()->id;
        $input['email'] = \Auth::user()->email;
        $input['phone'] = \Auth::user()->phone;
        
        $company = Company::create($input);

        if ($company) {
            // add branchs 
            $branMaster = new Branch;
            $branMaster->name = "Trụ sở chính";
            $branMaster->address = $input['address'];
            $branMaster->city = $input['city'];
            $branMaster->district = $input['district'];
            $branMaster->master = 0;
            $branMaster->company = $company->id;
            $branMaster->save();
            $branchs = $input['branchs'];
            if(isset($branchs) && strlen($branchs) > 0){
                $branchs = ltrim($branchs, ';');
                $branch_list = explode(";",$branchs);
                foreach ($branch_list as $braObject) {
                    $bra = json_decode($braObject, true);
                    $branObj = new Branch;
                    $branObj->name = $bra['name_branch'];
                    $branObj->address = $bra['address_branch'];
                    $branObj->city = $bra['city_branch_id'];
                    $branObj->district = $bra['district_branch_id'];
                    $branObj->master = 1;
                    $branObj->company = $company->id;
                    $branObj->save();
                }
            }
            
            // add CompanyCompanyType
            $jobs = $input['jobs'];
            if(isset($jobs) && strlen($jobs) > 0){
                $jobs = rtrim($jobs, ';');
                $job_list = explode(";",$jobs);
                    
                foreach ($job_list as $job) {
                    if($job == 'Khách sạn'){
                        $jobObj = new CompanyCompanyType;
                        $jobObj->company_type = 1;
                        $jobObj->company = $company->id;
                        $jobObj->save();
                    }else if($job == 'Nhà Hàng'){
                        $jobObj = new CompanyCompanyType;
                        $jobObj->company_type = 2;
                        $jobObj->company = $company->id;
                        $jobObj->save();
                    }else if($job == 'Cửa hàng'){
                        $jobObj = new CompanyCompanyType;
                        $jobObj->company_type = 3;
                        $jobObj->company = $company->id;
                        $jobObj->save();
                    }else if($job == 'Doanh nghiệp'){
                        $jobObj = new CompanyCompanyType;
                        $jobObj->company_type = 4;
                        $jobObj->company = $company->id;
                        $jobObj->save();
                    }else if($job == 'Spa'){
                        $jobObj = new CompanyCompanyType;
                        $jobObj->company_type = 5;
                        $jobObj->company = $company->id;
                        $jobObj->save();
                    }
                }
            }

            return redirect()->action(
                    'CompanyController@info', ['id' => $company->id]
                );
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        $this->validate($request, [
            'user' => 'required'
        ]);
        $requestData = $request->all();

        Company::create($requestData);

        Session::flash('flash_message', 'Company added!');

        return redirect('admin/company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $company = Company::findOrFail($id);

        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $company = Company::findOrFail($id);

        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request) {
        $this->validate($request, [
            'user' => 'required'
        ]);
        $requestData = $request->all();

        $company = Company::findOrFail($id);
        $company->update($requestData);

        Session::flash('flash_message', 'Company updated!');

        return redirect('admin/company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Company::destroy($id);

        Session::flash('flash_message', 'Company deleted!');

        return redirect('admin/company');
    }

    public function info($id) {
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];

            // check followed
            $follow = Follow::where('user', $user_info['user_id'])->where('company', $id)->first();
            if ($follow)
                $followed = 1;
            else
                $followed = 0;
        }else {
            $followed = 0;
        }
        // $company = Company::find($id);
        $company = \DB::table('companies')
                ->join('cities', 'cities.id', '=', 'companies.city')
                ->join('districts', 'districts.id', '=', 'companies.district')
                ->join('towns', 'towns.id', '=', 'companies.town')
                ->join('company_sizes', 'company_sizes.id', '=', 'companies.size')
                ->join('users', 'users.id', '=', 'companies.user')
                ->select(
                        'companies.id', 
                        'companies.name', 
                        'companies.logo', 
                        'companies.user', 
                        'companies.banner', 
                        'companies.youtube_link', 
                        'companies.lat', 
                        'companies.lng', 
                        'companies.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'towns.name as town', 
                        'companies.jobs', 
                        'company_sizes.size as size', 
                        'companies.sologan', 
                        'companies.description',
                        'companies.images',
                        'companies.template',
                        'companies.site_url',
                        'users.phone as hotline'
                )
                ->where('companies.id', $id)
                ->first();

        if ($company) {
            // load comment of company
            $comments = Comment::where('company', $id)->get();
            $totalStar = 0;
            foreach ($comments as $comment) {
                $totalStar = $comment->star;
            }

            if (count($comments) == 0)
                $numberComment = 1;
            else
                $numberComment = count($comments);

            $star = intval($totalStar / $numberComment);

            $jobs = \DB::table('jobs')
                    ->join('companies', 'companies.id', '=', 'jobs.company')
                    ->join('salaries', 'salaries.id', '=', 'jobs.salary')
                    ->join('cities', 'cities.id', '=', 'companies.city')
                    ->join('districts', 'districts.id', '=', 'companies.district')
                    ->where('companies.id', '=', $company->id)
                    ->select(
                        'jobs.id as id', 
                        'jobs.name as name', 
                        'jobs.number as number', 
                        'jobs.views as views', 
                        'jobs.applied as applied', 
                        'jobs.expiration_date as expiration_date', 
                        'salaries.name as salary', 
                        'companies.logo', 
                        'companies.name as companyname', 
                        'cities.name as city', 
                        'districts.name as district')
                    ->orderBy('jobs.created_at', 'desc')
                    ->take(12)
                    ->get();

            if($company->template == 0){
                return view('company.info', array('company' => $company, 'company_id' => $company_id, 'cv_id' => $cv_id, 'followed' => $followed, 'comments' => $comments, 'votes' => $star, 'template' => $company->template, 'jobs' => $jobs));
            }else if($company->template == 1){
                return view('company.view01', array('company' => $company, 'company_id' => $company_id, 'cv_id' => $cv_id, 'followed' => $followed, 'comments' => $comments, 'votes' => $star, 'template' => $company->template, 'jobs' => $jobs));
            }else if($company->template == 2){
                return view('company.view02', array('company' => $company, 'company_id' => $company_id, 'cv_id' => $cv_id, 'followed' => $followed, 'comments' => $comments, 'votes' => $star, 'template' => $company->template, 'jobs' => $jobs));
            }else if($company->template == 3){
                return view('company.view03', array('company' => $company, 'company_id' => $company_id, 'cv_id' => $cv_id, 'followed' => $followed, 'comments' => $comments, 'votes' => $star, 'template' => $company->template, 'jobs' => $jobs));
            }else{
                return view('company.info', array('company' => $company, 'company_id' => $company_id, 'cv_id' => $cv_id, 'followed' => $followed, 'comments' => $comments, 'votes' => $star, 'jobs' => $jobs));
            }
        }
        return view('errors.404');
    }

    public function returnView($id){
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];

            // check followed
            $follow = Follow::where('user', $user_info['user_id'])->where('company', $id)->first();
            if ($follow)
                $followed = 1;
            else
                $followed = 0;
        }else {
            $followed = 0;
        }
        // $company = Company::find($id);
        $company = \DB::table('companies')
                ->join('cities', 'cities.id', '=', 'companies.city')
                ->join('districts', 'districts.id', '=', 'companies.district')
                ->join('towns', 'towns.id', '=', 'companies.town')
                ->join('company_sizes', 'company_sizes.id', '=', 'companies.size')
                ->join('users', 'users.id', '=', 'companies.user')
                ->select(
                        'companies.id', 
                        'companies.name', 
                        'companies.logo', 
                        'companies.user', 
                        'companies.banner', 
                        'companies.youtube_link', 
                        'companies.lat', 
                        'companies.lng', 
                        'companies.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'towns.name as town', 
                        'companies.jobs', 
                        'company_sizes.size as size', 
                        'companies.sologan', 
                        'companies.description',
                        'companies.images',
                        'users.phone as hotline'
                )
                ->where('companies.id', $id)
                ->first();

        if ($company) {
            // load comment of company
            $comments = Comment::where('company', $id)->get();
            $totalStar = 0;
            foreach ($comments as $comment) {
                $totalStar = $comment->star;
            }

            if (count($comments) == 0)
                $numberComment = 1;
            else
                $numberComment = count($comments);

            $star = intval($totalStar / $numberComment);

            $jobs = Job::where('company', $id)->paginate(5);

            return array('company' => $company, 'company_id' => $company_id, 'cv_id' => $cv_id, 'followed' => $followed, 'comments' => $comments, 'votes' => $star, 'jobs' => $jobs);
        }
        return view('errors.404');
    }

    public function view01($id) {
        return view('company.view01', $this->returnView($id));
    }

    public function view02($id) {
        return view('company.info', $this->returnView($id));
    }

    public function view03($id) {
        return view('company.info', $this->returnView($id));        
    }

    public function listjobs($id) {
        // load company info
        $company_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $company_id = $user_info['company_id'];
            $cv_id = $user_info['cv_id'];

            // check followed
            $follow = Follow::where('user', $user_info['user_id'])->where('company', $id)->first();
            if ($follow)
                $followed = 1;
            else
                $followed = 0;
        }else {
            $followed = 0;
        }

        $company = Company::find($id);

        if ($company) {
            $company->hotline = $company->getPhoneNumber($company->user);
            // load job of company
            $jobs = Job::where('company', $id)->paginate(5);

            // load comment of company
            $comments = Comment::where('company', $id)->get();
            $totalStar = 0;
            foreach ($comments as $comment) {
                $totalStar = $comment->star;
            }

            if (count($comments) == 0)
                $numberComment = 1;
            else
                $numberComment = count($comments);

            $star = intval($totalStar / $numberComment);

            return view('company.listjobs', array('company' => $company, 'jobs' => $jobs, 'followed' => $followed, 'comments' => $comments, 'votes' => $star));
        }
        return view('errors.404');
    }

    public function sendcomment(Request $request) {
        if(\Auth::check()){
            $input = $request->all();
            $current_id = \Auth::user()->id;

            // check exist comment of user
            $commentExist = Comment::where('created_by', $current_id)->where('company', $input['company'])->first();

            if ($commentExist)
                return \Response::json(array('code' => '404', 'message' => 'Bạn chỉ được gửi đánh giá 1 lần với Nhà tuyển dụng này!'));

            // store
            $comment = new Comment;
            $comment->title = \Auth::user()->name;
            $comment->description = $input['description'];
            $comment->star = $input['countStar'];
            $comment->company = $input['company'];
            $comment->created_by = $current_id;
            $comment->created_at = date("Y-m-d H:i:s");

            if ($comment->save()) {
                return \Response::json(array('code' => '200', 'message' => 'success', 'comment' => $comment));
            }
            return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
        }else{
            return \Response::json(array('code' => '404', 'message' => 'unauthen'));
        }
    }

    public function follow(Request $request) {
        if (\Auth::check()) {
            $input = $request->all();
            $current_id = \Auth::user()->id;

            $follow = Follow::where('user', $current_id)->where('company', $input['company'])->first();
            if ($follow == null) {
                // store
                $follow = new Follow;
                $follow->user = $current_id;
                $follow->company = $input['company'];

                if ($follow->save()) {
                    return \Response::json(array('code' => '200', 'message' => 'success', 'follow' => $follow));
                }
            } else {
                return \Response::json(array('code' => '200', 'message' => 'success', 'follow' => $follow));
            }
            return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
        }else{
            return \Response::json(array('code' => '401', 'message' => 'unauthen!'));
        }
    }

    public function unfollow(Request $request) {
        if (\Auth::check()) {
            $input = $request->all();
            $current_id = \Auth::user()->id;

            $follow = Follow::where('user', $current_id)->where('company', $input['company'])->first();
            if ($follow) {
                if ($follow->delete()) {
                    return \Response::json(array('code' => '200', 'message' => 'success', 'follow' => $follow));
                } else {
                    return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
                }
            }
        }else{
            return \Response::json(array('code' => '401', 'message' => 'unauthen!'));
        }
    }

    public function changeTemplate(Request $request) {
        $input = $request->all();
        $current_id = \Auth::user()->id;

        $company = Company::where('user', $current_id)->first();
        if ($company && isset($input['template'])) {
            $company->template = (int)$input['template'];
            if ($company->save()) {
                return \Response::json(array('code' => '200', 'message' => 'success'));
            } else {
                return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
            }
        }
    }

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['company'])){
            $company = Company::findOrFail($input['company']);
            $company->show_master = 1;
            if($company->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['company'])){
            $company = Company::findOrFail($input['company']);
            $company->show_master = 0;
            if($company->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

}
