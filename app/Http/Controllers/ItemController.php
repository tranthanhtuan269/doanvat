<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\Shop;
use App\CurriculumVitae;
use App\Apply;
use Illuminate\Http\Request;
use Session;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        return view('item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('item.create');
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
			'shop' => 'required'
		]);
        $requestData = $request->all();
        
        Item::create($requestData);

        Session::flash('flash_message', 'Tạo món ăn thành công!');

        return redirect('admin/item');
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
        $item = Item::findOrFail($id);

        return view('item.show', compact('item'));
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
        $item = Item::findOrFail($id);

        return view('item.edit', compact('item'));
    }

    public function editItem($id)
    {
        $shop_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];

            if($shop_id > 0){
                //load shop info
                $shop = Shop::find($shop_id);
                $item = Item::where('id', '=', $id)->where('shop', '=', $shop_id)->first();
                if(isset($item)){
                    return view('item.edit_item', compact('shop_id', 'cv_id', 'shop', 'item'));
                }
            }
        }

        return view('errors.404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateItem($id, Request $request)
    {
        $shop_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            if($shop_id > 0){
                $item = Item::findOrFail($id);
                $input = $request->all();
                if ($input['description'] == null) {
                    $input['description'] = $item->description;
                }
                $input['created_at'] = date("Y-m-d H:i:s");
                $input['updated_at'] = date("Y-m-d H:i:s");
                $input['public'] = 1;
                $current_id = \Auth::user()->id;

                if ($item->update($input)) {
                    return redirect()->action(
                            'ItemController@info', ['id' => $item->id]
                        );
                }
            }
        }

        return redirect()->back();
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
        Item::destroy($id);

        Session::flash('flash_message', 'Item deleted!');

        return redirect('admin/item');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function createItem() {
        $shop_id = -1;
        $cv_id = -1;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];
            $current_id = $user_info['user_id'];
            
            //get shop 
            $shop = \DB::table('shops')
                    ->where('shops.user', $current_id)
                    ->first();
            if($shop){
                return view('item.create_item', compact('shop', 'cv_id', 'shop_id'));
            }else{
                return redirect('shop/create');
            }
        }
        
        return redirect()->back();
    }

    public function storeItem(Request $request) {
        $input = $request->all();
        if ($input['description'] == null) {
            $input['description'] = '';
        }
        $current_id = \Auth::user()->id;
        $input['created_by'] = $current_id;
        $input['created_at'] = date("Y-m-d H:i:s");
        $input['updated_at'] = date("Y-m-d H:i:s");
        $input['public'] = 1;

        // check followed
        $shop = Shop::where('user', $current_id)->orderBy('created_at', 'desc')->select('id')->first();
        if($shop){
            $input['shop'] = $shop->id;
        }else{
            $input['shop'] = 0;
        }
        
        $item = Item::create($input);

        if ($item) {            
            return redirect()->action(
                    'ItemController@info', ['id' => $item->id]
                );
        }

        return redirect()->back();
    }

    public function info($id){

        $item_selected = Item::find($id);
        $item_selected->views = $item_selected->views + rand(0,10);
        $item_selected->save();

        $shop_id = -1;
        $cv_id = -1;
        $applied = 0;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];
            $current_id = $user_info['user_id'];
            
            $apply_check = \DB::table('applies')
                    ->where('applies.user', $current_id)
                    ->where('applies.item', $id)
                    ->select(
                        'id'
                    )
                    ->first();
            
            if($apply_check){
                $applied = 1;
            }
        }
        
        $item = \DB::table('items')
                ->select(
                        'items.id',
                        'items.name',
                        'items.description',
                        'items.shop',
                        'items.slug'
                )
                ->where('items.id', $id)
                ->first();
        if($item && $item->shop){
            $shop = \DB::table('shops')
                ->join('cities', 'cities.id', '=', 'shops.city')
                ->join('districts', 'districts.id', '=', 'shops.district')
                ->join('towns', 'towns.id', '=', 'shops.town')
                ->select(
                        'shops.id', 
                        'shops.name', 
                        'shops.logo', 
                        'shops.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'towns.name as town', 
                        'shops.items', 
                        'shops.sologan', 
                        'shops.description',
                        'shops.site_url',
                        'shops.images'
                )
                ->where('shops.id', $item->shop)
                ->first();
            $branches = [];
            if($shop){
                $branches = \DB::table('branches')
                            ->join('cities', 'cities.id', '=', 'branches.city')
                            ->where('shop', $shop->id)
                            ->select(
                                'branches.city', 
                                'cities.name as city'
                            )
                            ->distinct()
                            ->get();
            }

            $item_relatives = \DB::table('items')
                                ->join('shops', 'shops.id', '=', 'items.shop')
                                ->join('cities', 'cities.id', '=', 'shops.city')
                                ->join('districts', 'districts.id', '=', 'shops.district')
                                ->whereRaw('LENGTH(items.name) < 50')
                                ->whereRaw('LENGTH(shops.name) < 50')
                                ->where('shops.id', '<>', $item->shop)
                                ->select('items.id as id', 'items.name as name', 'items.slug as slug', 'shops.logo', 'shops.name as shopname', 'cities.name as city', 'districts.name as district')
                                ->orderBy('items.created_at', 'desc')
                                ->take(12)
                                ->get();

            $content_share = array();
            $content_share['url'] = url('/') . '/item/' . $item->id . '/' . $item->slug;
            $content_share['title'] = ucfirst($item->name);
            $content_share['description'] = $item->description;
            $content_share['image'] = url('/') . '/public/images/' . $shop->logo;
            return view('item.info', compact('item', 'shop', 'shop_id', 'cv_id', 'applied', 'branches', 'item_relatives', 'content_share'));
        }
        return view('errors.404');
    }

    public function getSlug($id, $slug = ''){

        $item_selected = Item::find($id);
        if(isset($item_selected)){
        $item_selected->views = $item_selected->views + rand(0,10);
        $item_selected->save();
        }
        $shop_id = -1;
        $cv_id = -1;
        $likes = 0;
        if (\Auth::check()) {
            $user_info = \Auth::user()->getUserInfo();
            $shop_id = $user_info['shop_id'];
            $cv_id = $user_info['cv_id'];
            $current_id = $user_info['user_id'];
            
            $like_check = \DB::table('likes')
                    ->where('likes.user', $current_id)
                    ->where('likes.item', $id)
                    ->select(
                        'id'
                    )
                    ->first();
            
            if($like_check){
                $likes = 1;
            }
        }
        
        $item = \DB::table('items')
                ->select(
                        'items.id',
                        'items.name',
                        'items.description',
                        'items.shop',
                        'items.branches',
                        'items.slug'
                )
                ->where('items.id', $id)
                ->first();
        if($item && $item->shop){
            $shop = \DB::table('shops')
                ->join('cities', 'cities.id', '=', 'shops.city')
                ->join('districts', 'districts.id', '=', 'shops.district')
                ->join('towns', 'towns.id', '=', 'shops.town')
                ->select(
                        'shops.id', 
                        'shops.name', 
                        'shops.logo', 
                        'shops.address', 
                        'cities.name as city', 
                        'districts.name as district', 
                        'towns.name as town', 
                        'shops.sologan', 
                        'shops.description',
                        'shops.site_url'
                )
                ->where('shops.id', $item->shop)
                ->first();
            $branches = [];
            if($shop){
                $branches = \DB::table('branches')
                            ->join('cities', 'cities.id', '=', 'branches.city')
                            ->where('shop', $shop->id)
                            ->select(
                                'branches.city', 
                                'cities.name as city'
                            )
                            ->distinct()
                            ->get();
            }

            $item_relatives = \DB::table('items')
                                ->join('shops', 'shops.id', '=', 'items.shop')
                                ->join('cities', 'cities.id', '=', 'shops.city')
                                ->join('districts', 'districts.id', '=', 'shops.district')
                                ->where('shops.id', '<>', $item->shop)
                                ->whereRaw('LENGTH(items.name) < 50')
                                ->whereRaw('LENGTH(shops.name) < 50')
                                ->select('items.id as id', 'items.name as name', 'items.slug as slug', 'shops.logo', 'shops.name as shopname', 'cities.name as city', 'districts.name as district')
                                ->orderBy('items.created_at', 'desc')
                                ->take(12)
                                ->get();

            $content_share = array();
            $content_share['url'] = url('/') . '/item/' . $item->id . '/' . $item->slug;
            $content_share['title'] = ucfirst($item->name);
            $content_share['description'] = $item->description;
            $content_share['image'] = url('/') . '/public/images/' . $shop->logo;
            return view('item.info', compact('item', 'shop', 'shop_id', 'cv_id', 'likes', 'branches', 'item_relatives', 'content_share'));
        }
        return view('errors.404');
    }

    public function join(Request $request){
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;

            // check exist CV
            $cv_user = \DB::table('curriculum_vitaes')
                    ->join('users', 'users.id', '=', 'curriculum_vitaes.user')
                    ->join('cities', 'cities.id', '=', 'curriculum_vitaes.city')
                    ->join('districts', 'districts.id', '=', 'curriculum_vitaes.district')
                    ->where('curriculum_vitaes.user', $current_id)
                    ->select(
                        'curriculum_vitaes.id as id',
                        'users.name as username',
                        'curriculum_vitaes.birthday as birthday',
                        'curriculum_vitaes.avatar as avatarCv',
                        'users.avatar as avatarU',
                        'curriculum_vitaes.items as items',
                        'salaries.name as salary',
                        'cities.name as city',
                        'districts.name as district'
                    )
                    ->first();
            if($cv_user){
                // check item exist
                if(isset($request->item) && $request->item > 0){
                    $exitApply = Apply::where('user', $current_id)->where('item', $request->item)->first();
                    if($exitApply){
                        return \Response::json(array('code' => '200', 'message' => 'Apply is existed!'));
                    }
                    $apply = new Apply;

                    $apply->user = $current_id;
                    $apply->item = $request->item;

                    if($apply->save()){
                        $item_selected = Item::find($request->item);
                        if(isset($item_selected)){
                            $item_selected->applied = $item_selected->applied + 1;
                            $item_selected->save();
                            if(isset($item_selected->created_by) && ($item_selected->created_by > 0)){
                                $userToSend = \App\User::find($item_selected->created_by);
                                if(isset($userToSend) && isset($userToSend->email) && strlen($userToSend->email) > 3){
                                    \Mail::to($userToSend->email)->send(new \App\Mail\AlertApply($cv_user));
                                }
                            }
                            return \Response::json(array('code' => '200', 'message' => 'Created success!'));
                        }
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

    public function removeItem(Request $request){
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            if(isset($request->item_id) && $request->item_id > 0){
                // check exist CV
                $item_selected = Item::find($request->item_id);
                if($item_selected){
                    // check item exist
                    $item_selected->active = 0;

                    if($item_selected->save()){
                        return \Response::json(array('code' => '200', 'message' => 'Save success!'));
                    }
                }else{
                    return \Response::json(array('code' => '401', 'message' => 'Save unsuccess!'));
                }
                return \Response::json(array('code' => '403', 'message' => 'Save unsuccess!'));
            }
            return \Response::json(array('code' => '401', 'message' => 'unauthen!'));
        }else{
            return \Response::json(array('code' => '401', 'message' => 'unauthen!'));
        }
    }

    public function vip(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['item'])){
            $item = Item::findOrFail($input['item']);
            $item->public = 2;
            if($item->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function vip2(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['item'])){
            $item = Item::findOrFail($input['item']);
            $item->public = 0;
            if($item->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function unvip(Request $request){
        $input = $request->all();
        if(isset($input) && isset($input['item'])){
            $item = Item::findOrFail($input['item']);
            $item->public = 1;
            if($item->save()){
                return \Response::json(array('code' => '200', 'message' => 'Update success!'));
            }
        }
        return \Response::json(array('code' => '404', 'message' => 'Update unsuccess!'));
    }

    public function getItem(){
        $itemGetObj = new Item;
        $district = $city = $field = $item_type = $shop = $cv = $vip = $from = $number_get = null;
        $number_get = 5;
        if(isset($_GET)){

            if(isset($_GET['start']) && $_GET['start'] > 0){
                $from = $_GET['start'];
            }

            if(isset($_GET['number']) && $_GET['number'] > 0){
                $number_get = $_GET['number'];
            }
            
            if(isset($_GET['item_type']) && $_GET['item_type'] > 0){
                $item_type = $_GET['item_type'];
            }

            if(isset($_GET['city']) && $_GET['city'] > 0){
                $city = $_GET['city'];
            }

            if(isset($_GET['district']) && $_GET['district'] > 0){
                $district = $_GET['district'];
            }

            if(isset($_GET['item'])){
                if($_GET['item'] == 'vip1'){
                    $vip = 1;
                }else if($_GET['item'] == 'vip2'){
                    $vip = 2;
                }else if($_GET['item'] == 'new'){
                    $vip = 0;
                }
            }

            $items = $itemGetObj->getItem($district, $city, $field, $item_type, $shop, $cv, $vip, $from, $number_get);
            return \Response::json(array('code' => '200', 'message' => 'Success!', 'items' => $items));
        }
    }

    public function userapplied(){
        if (\Auth::check()) {

            $itemGetObj = new Item;
            $field = $district = $city = $item_type = $shop = $cv = $vip = null;
            $from = 0;
            $number_get = 5;

            
            $shopGetObj = new Shop;

            // get info User
            $myInfo = CurriculumVitae::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'avatar', 'school')->first();

            $itemsvip = $itemGetObj->getItemApplied(\Auth::user()->id, $district, $city, $field, $item_type, $from, 100);
            // dd($itemsvip);
            $shops = $shopGetObj->getShop($district, $city, $field, $from, $number_get);
            return view('uv.applied', compact('myInfo', 'itemsvip', 'shops'));
        }

        return redirect('/');
    }

    public function userItemRelative(){
        $itemGetObj = new Item;
        $shopGetObj = new Shop;
        $district = $city = $salary_want = $items_want = null;
        $from = 0;
        $number_get = 5;

        if (\Auth::check()) {
            $userRelative = \Auth::user()->getRelativeItem(\Auth::user()->id);
            if(isset($userRelative)){
                $district = $userRelative['district'];
                $city = $userRelative['city'];
                $salary_want = $userRelative['salary_want'];
                $items_want = $userRelative['items_want'];
            }

            // get info User
            $myInfo = CurriculumVitae::where('user', '=', \Auth::user()->id)->orderBy('created_at', 'desc')->select('id', 'avatar', 'school')->first();

            $itemsrelative = $itemGetObj->getItemRelative($district, $city, $salary_want, $items_want, $from, 10);

            $shops = $shopGetObj->getShop($district, $city, null, $from, $number_get);
            return view('uv.items', compact('myInfo', 'itemsrelative', 'shops', 'city', 'district', 'salary_want', 'items_want'));
        }

        return redirect('/');
    }

    public function getItemRelative(){
        $itemGetObj = new Item;
        $district = $city = $salary_want = $items_want = $from = $number_get = null;
        $number_get = 5;
        if(isset($_GET)){

            if(isset($_GET['start']) && $_GET['start'] > 0){
                $from = $_GET['start'];
            }

            if(isset($_GET['number']) && $_GET['number'] > 0){
                $number_get = $_GET['number'];
            }
            
            if(isset($_GET['salary_want']) && $_GET['salary_want'] > 0){
                $salary_want = $_GET['salary_want'];
            }
            
            if(isset($_GET['items_want']) && $_GET['items_want'] > 0){
                $items_want = $_GET['items_want'];
            }

            if(isset($_GET['city']) && $_GET['city'] > 0){
                $city = $_GET['city'];
            }

            if(isset($_GET['district']) && $_GET['district'] > 0){
                $district = $_GET['district'];
            }

            $items = $itemGetObj->getItemRelative($district, $city, $salary_want, $items_want, $from, $number_get);
            return \Response::json(array('code' => '200', 'message' => 'Success!', 'items' => $items));
        }
    }

    public function getItemWithBanner(){
        $itemGetObj = new Item;
        $district = $city = $field = $item_type = $shop = $cv = $vip = $from = $number_get = null;
        $number_get = 5;
        if(isset($_GET)){

            if(isset($_GET['start']) && $_GET['start'] > 0){
                $from = $_GET['start'];
            }

            if(isset($_GET['number']) && $_GET['number'] > 0){
                $number_get = $_GET['number'];
            }
            
            if(isset($_GET['item_type']) && $_GET['item_type'] > 0){
                $item_type = $_GET['item_type'];
            }

            if(isset($_GET['city']) && $_GET['city'] > 0){
                $city = $_GET['city'];
            }

            if(isset($_GET['district']) && $_GET['district'] > 0){
                $district = $_GET['district'];
            }

            if(isset($_GET['item'])){
                if($_GET['item'] == 'vip1'){
                    $vip = 1;
                }else if($_GET['item'] == 'vip2'){
                    $vip = 2;
                }else if($_GET['item'] == 'new'){
                    $vip = 0;
                }
            }

            $items = $itemGetObj->getItemWithBanner($from, $number_get);
            return \Response::json(array('code' => '200', 'message' => 'Success!', 'items' => $items));
        }
    }
}
