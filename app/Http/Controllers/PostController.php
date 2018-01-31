<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
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
            $post = \DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category')
                ->where('title', 'LIKE', "%$keyword%")
				->orWhere('description', 'LIKE', "%$keyword%")
				->orWhere('category', 'LIKE', "%$keyword%")
                ->select('posts.id', 'posts.title', 'posts.image', 'posts.views', 'posts.active', 'posts.keyword', 'posts.likes', 'categories.name as categoryName')
				->paginate($perPage);
        } else {
            $post = \DB::table('posts')
                ->join('categories', 'categories.id', '=', 'posts.category')
                ->select('posts.id', 'posts.title', 'posts.image', 'posts.views', 'posts.active', 'posts.keyword', 'posts.likes', 'categories.name as categoryName')
                ->orderBy('posts.created_at', 'desc')
                ->paginate($perPage);
        }

        return view('post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('post.create');
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
        $img_avatar = '';
        if ($request->hasFile('imagePost')) {
            $file_avatar = $request->file('imagePost');
            $filename = $file_avatar->getClientOriginalName();
            $extension = $file_avatar->getClientOriginalExtension();
            $img_avatar = date('His') . $filename;
            $destinationPath = base_path('../../images');
            // $destinationPath = base_path() . '/public/images';
            $file_avatar->move($destinationPath, $img_avatar);
        }

        $requestData = $request->all();
        unset($requestData['imagePost']);

        $requestData['image'] = $img_avatar;
        
        Post::create($requestData);

        Session::flash('flash_message', 'Post added!');

        return redirect('post');
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
        $post = Post::findOrFail($id);

        return view('post.show', compact('post'));
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
        $post = Post::findOrFail($id);

        return view('post.edit', compact('post'));
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

        $img_avatar = '';
        if ($request->hasFile('imagePost')) {
            $file_avatar = $request->file('imagePost');
            $filename = $file_avatar->getClientOriginalName();
            $extension = $file_avatar->getClientOriginalExtension();
            $img_avatar = date('His') . $filename;
            $destinationPath = base_path('../../images');
            // $destinationPath = base_path() . '/public/images';
            $file_avatar->move($destinationPath, $img_avatar);
        }

        $requestData = $request->all();
        unset($requestData['imagePost']);

        if(strlen($img_avatar) > 0){
            $requestData['image'] = $img_avatar;
        }
                
        $post = Post::findOrFail($id);
        $post->update($requestData);

        Session::flash('flash_message', 'Post updated!');

        return redirect('post');
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
        Post::destroy($id);

        Session::flash('flash_message', 'Post deleted!');

        return redirect('post');
    }

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['post'])){
            $post = Post::findOrFail($input['post']);
            $post->active = 1;
            if($post->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['post'])){
            $post = Post::findOrFail($input['post']);
            $post->active = 0;
            if($post->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }
}
