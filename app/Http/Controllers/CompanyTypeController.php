<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CompanyType;
use Illuminate\Http\Request;
use Session;

class CompanyTypeController extends Controller
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
            $company_type = CompanyType::where('name', 'LIKE', "%$keyword%")
				->orWhere('key_word', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $company_type = CompanyType::paginate($perPage);
        }

        return view('company_type.index', compact('company_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('company_type.create');
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
        
        $requestData = $request->all();
        
        CompanyType::create($requestData);

        Session::flash('flash_message', 'company_type added!');

        return redirect('companytype/company_type');
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
        $company_type = CompanyType::findOrFail($id);

        return view('company_type.show', compact('company_type'));
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
        $company_type = CompanyType::findOrFail($id);

        return view('company_type.edit', compact('company_type'));
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
        
        $requestData = $request->all();
        
        $company_type = CompanyType::findOrFail($id);
        $company_type->update($requestData);

        Session::flash('flash_message', 'company_type updated!');

        return redirect('companytype/company_type');
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
        CompanyType::destroy($id);

        Session::flash('flash_message', 'company_type deleted!');

        return redirect('companytype/company_type');
    }
}
