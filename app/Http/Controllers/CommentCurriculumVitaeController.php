<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CommentCurriculumVitae;
use Illuminate\Http\Request;
use Session;

class CommentCurriculumVitaeController extends Controller
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
            $commentcurriculumvitae = CommentCurriculumVitae::where('user', 'LIKE', "%$keyword%")
				->orWhere('curriculumvitae', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->orWhere('star', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $commentcurriculumvitae = CommentCurriculumVitae::paginate($perPage);
        }

        return view('comment-curriculum-vitae.index', compact('commentcurriculumvitae'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('comment-curriculum-vitae.create');
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
			'curriculumvitae' => 'required'
		]);
        $requestData = $request->all();
        
        CommentCurriculumVitae::create($requestData);

        Session::flash('flash_message', 'CommentCurriculumVitae added!');

        return redirect('user/comment-curriculum-vitae');
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
        $commentcurriculumvitae = CommentCurriculumVitae::findOrFail($id);

        return view('comment-curriculum-vitae.show', compact('commentcurriculumvitae'));
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
        $commentcurriculumvitae = CommentCurriculumVitae::findOrFail($id);

        return view('comment-curriculum-vitae.edit', compact('commentcurriculumvitae'));
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
			'curriculumvitae' => 'required'
		]);
        $requestData = $request->all();
        
        $commentcurriculumvitae = CommentCurriculumVitae::findOrFail($id);
        $commentcurriculumvitae->update($requestData);

        Session::flash('flash_message', 'CommentCurriculumVitae updated!');

        return redirect('user/comment-curriculum-vitae');
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
        CommentCurriculumVitae::destroy($id);

        Session::flash('flash_message', 'CommentCurriculumVitae deleted!');

        return redirect('user/comment-curriculum-vitae');
    }
}
