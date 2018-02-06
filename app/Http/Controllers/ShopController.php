<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Shop;
use App\Follow;
use App\Branch;
use App\Item;
use App\Comment;
use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;

class ShopController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $shop = \DB::table('shops')
                    ->join('cities', 'cities.id', '=', 'shops.city')
                    ->orWhere('shops.logo', 'LIKE', "%$keyword%")
                    ->orWhere('shops.name', 'LIKE', "%$keyword%")
                    ->orWhere('cities.name', 'LIKE', "%$keyword%")
                    ->orderBy('shops.created_at', 'desc')
                    ->select('shops.logo', 'shops.name', 'cities.name as cityname', 'shops.id', 'shops.show_master')
                    ->paginate($perPage);
        } else {
            $shop = \DB::table('shops')
                        ->join('cities', 'cities.id', '=', 'shops.city')
                        ->select('shops.logo', 'shops.name', 'cities.name as cityname', 'shops.id', 'shops.show_master')
                        ->orderBy('shops.created_at', 'desc')
                        ->paginate($perPage);
        }

        return view('shop.index', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('shop.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function createShop() {
        $shop_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];
        }
        
        return view('shop.create_shop', compact('shop_id', 'cv_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function editShop() {
        $shop_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];

            if($shop_id > 0){
                //load shop info
                $shop = Shop::findOrFail($shop_id);

                $cities = \App\City::pluck('name', 'id');
                $districts = \App\District::where('city', '=', $shop->city)->pluck('name', 'id');
                $towns = \App\Town::where('district', '=', $shop->district)->pluck('name', 'id');
                $branches = \DB::table('branches')
                            ->join('cities', 'cities.id', '=', 'branches.city')
                            ->join('districts', 'districts.id', '=', 'branches.district')
                            ->where('shop', '=', $shop->id)
                            ->select('branches.id', 'branches.name as name_branch', 'branches.address as address_branch', 'cities.id as city_branch_id', 'cities.name as city_branch_name', 'districts.id as district_branch_id', 'districts.name as district_branch_name')
                            ->get();
                return view('shop.edit_shop', compact('shop_id', 'cv_id', 'shop', 'cities', 'districts', 'towns', 'branches'));
            }
        }

        return view('errors.404');
    }

    public function updateShop(Request $request) {
        $shop_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            if($shop_id > 0){
                $shop = Shop::findOrFail($shop_id);
                $input = $request->all();
                if ($input['description'] == null)
                    $input['description'] = '';

                if(!isset($request['logo']) || $request['logo'] == ''){
                    $input['logo'] = $shop->logo;
                }
                if(!isset($request['banner']) || $request['banner'] == ''){
                    $input['banner'] = $shop->banner;
                }
                $input['images'] = $request['images-plus-field'];

                $input['user'] = \Auth::user()->id;

                $input['email'] = \Auth::user()->email;
                $input['phone'] = \Auth::user()->phone;
                
                $shop = Shop::findOrFail($shop_id);
                $shop->update($input);

                // remove all branches
                $affectedRows = Branch::where('shop', '=', $shop->id)->delete();

                if ($shop) {
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
                                $branObj->shop = $shop->id;
                                $branObj->save();
                            }
                        }
                    }

                    return redirect()->action(
                            'ShopController@info', ['id' => $shop->id]
                        );
                }
            }
        }

        return redirect()->back();
    }

    public function storeShop(Request $request) {
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
        
        $shop = Shop::create($input);

        if ($shop) {
            // add branchs 
            $branMaster = new Branch;
            $branMaster->name = "Trụ sở chính";
            $branMaster->address = $input['address'];
            $branMaster->city = $input['city'];
            $branMaster->district = $input['district'];
            $branMaster->master = 0;
            $branMaster->shop = $shop->id;
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
                    $branObj->shop = $shop->id;
                    $branObj->save();
                }
            }

            return redirect()->action(
                    'ShopController@info', ['id' => $shop->id]
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

        Shop::create($requestData);

        Session::flash('flash_message', 'Shop added!');

        return redirect('admin/shop');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id) {
        $shop = Shop::findOrFail($id);

        return view('shop.show', compact('shop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id) {
        $shop = Shop::findOrFail($id);

        return view('shop.edit', compact('shop'));
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

        $shop = Shop::findOrFail($id);
        $shop->update($requestData);

        Session::flash('flash_message', 'Shop updated!');

        return redirect('admin/shop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id) {
        Shop::destroy($id);

        Session::flash('flash_message', 'Shop deleted!');

        return redirect('admin/shop');
    }

    public function info($id) {
        $shop_id = -1;
        $cv_id = -1;
        $current_id = -1;
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];

            // check followed
            $follow = Follow::where('user', $user_info['user_id'])->where('shop', $id)->first();
            if ($follow)
                $followed = 1;
            else
                $followed = 0;
        }else {
            $followed = 0;
        }

        $shop = \DB::table('shops')
                ->join('cities', 'cities.id', '=', 'shops.city')
                ->join('districts', 'districts.id', '=', 'shops.district')
                ->join('towns', 'towns.id', '=', 'shops.town')
                ->join('users', 'users.id', '=', 'shops.user')
                ->select(
                        'shops.id', 
                        'shops.name', 
                        'shops.logo', 
                        'shops.user', 
                        'shops.banner', 
                        'shops.youtube_link', 
                        'shops.lat', 
                        'shops.lng', 
                        'shops.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'towns.name as town', 
                        'shops.sologan', 
                        'shops.description',
                        'shops.images',
                        'users.phone as hotline'
                )
                ->where('shops.id', $id)
                ->first();

        if ($shop) {
            // load comment of Shop
            $comments = Comment::where('shop', $id)->get();

            $items = \DB::table('items')
                    ->where('items.shop', '=', $shop->id)
                    ->where('items.active', '=', 1)
                    ->select(
                        'items.id as id', 
                        'items.name as name',
                        'items.views as views', 
                        'items.likes as likes', 
                        'items.image as image', 
                        'items.price as price'
                    )
                    ->orderBy('items.created_at', 'desc')
                    ->take(12)
                    ->get();

            $stringArray = [];
            foreach ($items as $item) {
                $stringArray[]= $item->id;
            }

            if($current_id != -1){
                $likes = \DB::table('likes')
                    ->where('likes.user', '=', $current_id)
                    ->whereIn('likes.item', $stringArray)
                    ->select(
                        'likes.item as item'
                    )
                    ->get();

                $likedArray = [];
                foreach ($likes as $like) {
                    $likedArray[]= $like->item;
                }
            }else{
                $likedArray = [];
            }

            return view('shop.info', array('shop' => $shop, 'shop_id' => $shop_id, 'cv_id' => $cv_id, 'followed' => $followed, 'comments' => $comments, 'items' => $items, 'likedArray' => $likedArray));
        }
        return view('errors.404');
    }

    public function listItems($id) {
        // load Shop info
        $shop_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];

            // check followed
            $follow = Follow::where('user', $user_info['user_id'])->where('shop', $id)->first();
            if ($follow)
                $followed = 1;
            else
                $followed = 0;
        }else {
            $followed = 0;
        }

        $shop = Shop::find($id);

        if ($shop) {
            $shop->hotline = $shop->getPhoneNumber($shop->user);
            // load item of Shop
            $items = Item::where('shop', $id)->paginate(5);

            // load comment of Shop
            $comments = Comment::where('shop', $id)->get();
            $totalStar = 0;
            foreach ($comments as $comment) {
                $totalStar = $comment->star;
            }

            if (count($comments) == 0)
                $numberComment = 1;
            else
                $numberComment = count($comments);

            $star = intval($totalStar / $numberComment);

            return view('shop.listitems', array('shop' => $shop, 'items' => $items, 'followed' => $followed, 'comments' => $comments, 'votes' => $star));
        }
        return view('errors.404');
    }

    public function sendcomment(Request $request) {
        if(\Auth::check()){
            $input = $request->all();
            $current_id = \Auth::user()->id;

            // check exist comment of user
            $commentExist = Comment::where('created_by', $current_id)->where('shop', $input['shop'])->first();

            if ($commentExist)
                return \Response::json(array('code' => '404', 'message' => 'Bạn chỉ được gửi đánh giá 1 lần với Cửa hàng này!'));

            // store
            $comment = new Comment;
            $comment->comment = $input['comment'];
            $comment->shop = $input['shop'];
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

    public function sendlike(Request $request) {
        if(\Auth::check()){
            $input = $request->all();
            $current_id = \Auth::user()->id;

            // check exist comment of user
            $liked = Like::where('user', $current_id)->where('item', $input['item'])->first();

            if ($liked && $input['like'] == 0){
                $item = Item::where('id', $input['item'])->first();
                $item->likes -= 1;
                // remove like
                if ($liked->delete() && $item->save()) {
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                } else {
                    return \Response::json(array('code' => '404', 'message' => 'unsuccess'));
                }
            }else{
                // add like
                $like = new Like;
                $like->user = $current_id;
                $like->item = $input['item'];

                $item = Item::where('id', $input['item'])->first();
                $item->likes += 1;
                if ($like->save() && $item->save()) {
                    return \Response::json(array('code' => '200', 'message' => 'success'));
                }
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

            $follow = Follow::where('user', $current_id)->where('shop', $input['shop'])->first();
            if ($follow == null) {
                // store
                $follow = new Follow;
                $follow->user = $current_id;
                $follow->shop = $input['shop'];

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

            $follow = Follow::where('user', $current_id)->where('shop', $input['shop'])->first();
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

    public function active(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['shop'])){
            $shop = Shop::findOrFail($input['shop']);
            $shop->show_master = 1;
            if($shop->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unactive(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['shop'])){
            $shop = Shop::findOrFail($input['shop']);
            $shop->show_master = 0;
            if($shop->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

}
