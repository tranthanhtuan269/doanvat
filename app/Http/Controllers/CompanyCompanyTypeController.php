<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CompanyCompanyType;
use Illuminate\Http\Request;
use Session;

class CompanyCompanyTypeController extends Controller
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
            $companycompanytype = CompanyCompanyType::where('company', 'LIKE', "%$keyword%")
				->orWhere('company_type', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $companycompanytype = CompanyCompanyType::paginate($perPage);
        }

        return view('company-company-type.index', compact('companycompanytype'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('company-company-type.create');
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
			'company' => 'required',
			'company_type' => 'required'
		]);
        $requestData = $request->all();
        
        CompanyCompanyType::create($requestData);

        Session::flash('flash_message', 'CompanyCompanyType added!');

        return redirect('company-company-type');
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
        $companycompanytype = CompanyCompanyType::findOrFail($id);

        return view('company-company-type.show', compact('companycompanytype'));
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
        $companycompanytype = CompanyCompanyType::findOrFail($id);

        return view('company-company-type.edit', compact('companycompanytype'));
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
			'company' => 'required',
			'company_type' => 'required'
		]);
        $requestData = $request->all();
        
        $companycompanytype = CompanyCompanyType::findOrFail($id);
        $companycompanytype->update($requestData);

        Session::flash('flash_message', 'CompanyCompanyType updated!');

        return redirect('company-company-type');
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
        CompanyCompanyType::destroy($id);

        Session::flash('flash_message', 'CompanyCompanyType deleted!');

        return redirect('company-company-type');
    }
}
