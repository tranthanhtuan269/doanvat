<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Salary;
use Illuminate\Http\Request;
use Session;

class SalaryController extends Controller
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
            $salary = Salary::where('name', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $salary = Salary::paginate($perPage);
        }

        return view('salary.index', compact('salary'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('salary.create');
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
        
        Salary::create($requestData);

        Session::flash('flash_message', 'Salary added!');

        return redirect('admin/salary');
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
        $salary = Salary::findOrFail($id);

        return view('salary.show', compact('salary'));
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
        $salary = Salary::findOrFail($id);

        return view('salary.edit', compact('salary'));
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
        
        $salary = Salary::findOrFail($id);
        $salary->update($requestData);

        Session::flash('flash_message', 'Salary updated!');

        return redirect('admin/salary');
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
        Salary::destroy($id);

        Session::flash('flash_message', 'Salary deleted!');

        return redirect('admin/salary');
    }
}
