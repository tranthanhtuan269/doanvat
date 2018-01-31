<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CompanySize;
use Illuminate\Http\Request;
use Session;

class CompanySizeController extends Controller
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
            $companysize = CompanySize::where('size', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $companysize = CompanySize::paginate($perPage);
        }

        return view('company-size.index', compact('companysize'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('company-size.create');
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
			'size' => 'required'
		]);
        $requestData = $request->all();
        
        CompanySize::create($requestData);

        Session::flash('flash_message', 'CompanySize added!');

        return redirect('Admin/company-size');
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
        $companysize = CompanySize::findOrFail($id);

        return view('company-size.show', compact('companysize'));
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
        $companysize = CompanySize::findOrFail($id);

        return view('company-size.edit', compact('companysize'));
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
			'size' => 'required'
		]);
        $requestData = $request->all();
        
        $companysize = CompanySize::findOrFail($id);
        $companysize->update($requestData);

        Session::flash('flash_message', 'CompanySize updated!');

        return redirect('Admin/company-size');
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
        CompanySize::destroy($id);

        Session::flash('flash_message', 'CompanySize deleted!');

        return redirect('Admin/company-size');
    }
}
