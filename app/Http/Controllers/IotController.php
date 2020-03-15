<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Comment;
use App\Customer;
use App\Favorite;
use App\Information;
use App\Iot;
use App\IotRecord;
use App\Message;
use App\Notif;
use App\QrNotif;
use App\Shop;
use App\User;
use App\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\Facades\DataTables;
use function MongoDB\BSON\toJSON;
use Morilog\Jalali\Jalalian;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Tymon\JWTAuth\JWTAuth;

class IotController extends Controller
{
    public function __construct()
    {
        $this->middleware('web')->only('inform');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beacon_iot = DB::table('iots')
            ->join('beacons', 'iots.beacon_mac', '=', 'beacons.mac_address')
            ->select('beacons.*', 'iots.*')
            ->get();
        $beacon_iot = $beacon_iot->where('user_id', '=', Auth::user()->id);
        $iot = Iot::all();
//        return $iot;
        $beacons = Beacon::all()->where('user_id', '=', Auth::user()->id);
        $customer = Customer::all();
        $spiot = "";
//        return view('tables');
        return view('tables', compact('iot', 'beacons', 'customer', 'beacon_iot', 'spiot'));
    }

    public function getdata()
    {
        $beacon_iot = DB::table('iots')
            ->join('beacons', 'iots.beacon_mac', '=', 'beacons.mac_address')
            ->select('beacons.*', 'iots.*')
            ->get();
        $beacon_iot = $beacon_iot->where('user_id', '=', Auth::user()->id);
        return DataTables::of($beacon_iot)->make(true);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
////        $currentUser = \JWTAuth::parseToken()->authenticate();
////        $aaa = \JWTAuth::getToken();
//
////        $aaa = \JWTAuth::getPayload($currentUser)->get('sub');
////        $a = \JWTAuth::auth()->byId($aaa);
//
////        return response()->json($currentUser);
//        $beacon_mac = $request->get('beacon_mac');
//        $beacon_status = Beacon::where('mac_address' , $beacon_mac)->get();
////        return $beacon_status;
//        if ($beacon_status[0]->status == 0){
//            return "";
//        }
//
////        $customer = Customer::where('mac_address', $request->get('mac_address'))->get();
////        if (count($customer) == 0) {
//////            return "customer nist";
////            Customer::create([
////                'mac_address' => $request->get('mac_address'),
////            ]);
////        }
////        $iots = Iot::where(['beacon_mac' => $request->get('beacon_mac'), 'customer_id' => $request->get('mac_address')])->first();
////        $beacon = Beacon::where('mac_address', $request->get('beacon_mac'))->first();
//
//        $iot = Iot::where(['customer_id' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac')])->get();
//        if (count($iot) == 0) {
////            return "iot nist";
//
//            $iot = new Iot();
//            $iot->customer_id = $request->get('mac_address');
//            $iot->beacon_mac = $request->get('beacon_mac');
//            $iot->beacon_id = $request->get('beacon_mac');
//            $iot->rssi = $request->get('rssi');
//            $iot->count = '1';
//            $iot->save();
//
//            $notifs = DB::table('notifs')
//                ->join('shops', 'notifs.user_id', '=', 'shops.user_id')
//                ->select('notifs.*', 'shops.id as shop_id' , 'shops.shop_name')
//                ->get();
//
//
////            $notifs = Notif::where('beacon_mac', '=', $beacon_mac)->first();
//            return $notifs;
//        } elseif (count($iot) == 1) {
////            return "iot hast";
//
//            $coun = Iot::where(['customer_id' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac')])->get();
////            return $coun;
//            $count = $coun[0]->count;
//            $count = $count + 1;
//            DB::table('iots')
//                ->where(['customer_id' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac')])
//                ->update(['count' => $count]);
//
//            if ($coun[0]->count % 10 == 0) {
//                $notifs = Notif::all()->where('beacon_mac', '=', $beacon_mac)->first();
//                return $notifs;
//            }
//            return "";
//
//
//        }
//
//
//    }

    public function qrcode()
    {
        $user_information = Information::where('user_id', Auth::user()->id)->get();
        if (count($user_information) == 0){
            $all_user_locations = [];
            $all_user_groups = [];
        }
        else{
        $all_user_groups = unserialize($user_information[0]->groups);
        $all_user_locations = unserialize($user_information[0]->locations);
        if ($user_information[0]->groups == null) {
            $all_user_groups = [];
        } else if ($user_information[0]->locations == null) {
            $all_user_locations = [];
        } else {
            $all_user_groups = unserialize($user_information[0]->groups);
            $all_user_locations = unserialize($user_information[0]->locations);
        }
        }
        $qr_notifs = QrNotif::where('user_id', Auth::user()->id)->get();
        return view('qrcode', compact('all_user_groups', 'all_user_locations', 'qr_notifs'));
    }

    public function qrcode_generate(Request $request)
    {
        $qr_notifs = QrNotif::where('user_id', Auth::user()->id)->get();
        if (count($qr_notifs) >= 5) {
            return back()->with('error', 'شما تاکنون 5 qr ثبت کرده اید. برای تولید qr جدید به مدیریت درخواست بدهید.');
        }
        $content = $request->get('txt');
//        return Carbon::time;
        $filename = Auth::user()->id . "ss" . Jalalian::now()->getTimestamp();
        $Qrcode = QrCode::format('png')->size(200)->generate($content, "messages/photos/qrcode/{$filename}.png");
//        return $aaa;
        $qr = \App\QrCode::create([
            'qr_code' => $Qrcode,
            'user_id' => Auth::user()->id,
            'path' => "messages/photos/qrcode/{$filename}.png"
//            'path' => $path
        ]);
        QrNotif::create([
            'qr_id' => $qr->id,
            'user_id' => Auth::user()->id,
            'content' => $content,
            'group' => $request->get('group'),
            'location' => $request->get('location')
        ]);
        session()->flash('qr-message' , 'qr-code جدید افزوده شد');
        return back();
    }

    public function destroy_qrcode($qrcode)
    {
        \App\QrCode::where('id', $qrcode)->delete();
        QrNotif::where('qr_id', $qrcode)->delete();
        session()->flash('qr-message' , 'qr-code حذف شد');
        return back();
    }

    public function show_qrcode_content()
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function show(iot $iot)
    {
        return $iot;
        return $iot->Beacon()->get();
//        return iot::latest()->take(50)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function edit(iot $iot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, iot $iot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\iot $iot
     * @return \Illuminate\Http\Response
     */
    public function destroy(iot $iot)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function notif()
    {
        $notifs = DB::table('notifs')
            ->join('beacons', 'notifs.beacon_mac', '=', 'beacons.mac_address')
            ->select('beacons.*', 'notifs.*')
            ->get();
        $notifs = $notifs->where('user_id', Auth::user()->id);
        return view('notif', compact('notifs'));
    }

    public function message_create()
    {
        $messages = Message::all()->where('user_id', '=', Auth::user()->id);
//        return $messages[0]->pic;

        $favorites = Favorite::all();
//        return $favorites[0]->favorite;
        return view('message_shop', compact('messages', 'favorites'));
    }

    public function editnotif($notif, Request $request)
    {
        $favorites = Favorite::all();
        $notifs = Notif::where('beacon_mac', $notif)->first();
        $beacon_name = Beacon::where('mac_address', $notif)->first();
        $beacon_name = $beacon_name->name;

        return view('editnotif', compact('notifs', 'beacon_name', 'favorites'));
    }

    public function updatenotif(Request $request)
    {
//        return $request;
        if ($request->txt != "") {
            DB::table('notifs')
                ->where(['beacon_mac' => $request->get('beacon_mac')])
                ->update(['txt' => $request->get('txt')]);
        }
        if ($request->pic != "") {
            DB::table('notifs')
                ->where(['beacon_mac' => $request->get('beacon_mac')])
                ->update(['pic' => $request->get('pic')]);
        }
        if ($request->url != "") {
            DB::table('notifs')
                ->where(['beacon_mac' => $request->get('beacon_mac')])
                ->update(['url' => $request->get('url')]);
        }
        if ($request->offer_set == 1) {
            if ($request->url != "") {
                DB::table('notifs')
                    ->where(['beacon_mac' => $request->get('beacon_mac')])
                    ->update(['offer_percent' => $request->get('offer_percent')]);
                DB::table('notifs')
                    ->where(['beacon_mac' => $request->get('beacon_mac')])
                    ->update(['type' => "1"]);
            }
        }
        return redirect('notif/create');
    }

    public function additional_inform()
    {
        $admin_user = User::all()->where('isadmin', '=', 1)->first();
        $information = Information::where('user_id', '=', $admin_user->id)->get();
//
        $user_information = Information::where('user_id', Auth::user()->id)->get();

        if (count($information) == 0) {
            $all_locations = [];
            $all_groups = [];
        } else {

            $all_groups = unserialize($information[0]->groups);
            $all_locations = unserialize($information[0]->locations);
            if ($information[0]->groups == null) {
                $all_groups = [];
            } else if ($information[0]->locations == null) {
                $all_locations = [];
            }
        }

        if (count($user_information) == 0) {
            $all_user_groups = [];
            $all_user_locations = [];
        } else {

            $all_user_groups = unserialize($user_information[0]->groups);
            $all_user_locations = unserialize($user_information[0]->locations);
            if ($user_information[0]->groups == null) {
                $all_user_groups = [];
            } else if ($user_information[0]->locations == null) {
                $all_user_locations = [];
            }
        }

//        if (count($user_information) == 0) {
//            $user_information->locations = '';
//            $user_information->groups = '';
//            $all_user_locations = unserialize($user_information->locations);
//            $all_user_groups = unserialize($user_information->groups);
//        } else {
//            $all_user_locations = unserialize($user_information[0]->locations);
//            $all_user_groups = unserialize($user_information[0]->groups);
//        }
//
//        if (count($information) == 0) {
//            $all_groups = [];
//            $all_locations = [];
//
//        } else {
//            $all_groups = unserialize($information[0]->groups);
//            $all_locations = unserialize($information[0]->locations);
//        }

        return view('moreinformation', compact('information', 'all_groups', 'all_locations',
            'all_user_groups', 'all_user_locations'));
    }

    public function inform()
    {
//        if (Auth::user()->isadmin == '1') {
            $text = "";
            $favorites = Favorite::all();
            return view('information', compact('text', 'favorites'));

//        } elseif (Auth::user()->isadmin == '0') {
//            return "دسترسی ندارید";
            $aa = User::where('isadmin', 1)->first();
//        return $aa;
            $all = Information::where('user_id', $aa->id)->first();


            if ($all && $all->groups && $all->locations) {
                $all_groups = unserialize($all->groups);
                $all_locations = unserialize($all->locations);
                $textt = "";
            } else {
                $all_locations = [];
                $all_groups = [];
                $textt = "برای فروشگاه شما اطلاعات پایه تعریف نشده است.";
            }

            $info = Information::where('user_id', Auth::user()->id)->get();
            if (count($info) == 1) {
                $text = "شما یک بار برای فروشگاه خود اطلاعات پایه را وارد کرده اید.";
            } else {
                $text = "";
            }
            $beacons = Beacon::all()->where('user_id', '=', Auth::user()->id);
            $favorites = Favorite::all();
//        return $favorites;
//            return $all_groups;
            return view('moreinformation', compact('beacons', 'favorites', 'text', 'textt', 'all_groups', 'all_locations'));
        }
//    }


    public function admin_set_group(Request $request)
    {
        $old_group = Information::where('user_id', Auth::user()->id)->get();
        $shop = Shop::where('user_id', Auth::user()->id)->first();

//        return response()->json(['success' => true, 'message' => $shop->shop_name ]);
        $new_group = $request->get('group');
        if ($new_group == "") {
            return response()->json(['success' => false, 'message' => 'طبقه بندی را وارد کنید']);
        }

        if (count($old_group) == 0) {
            $old_group = [];
            $old_location = [];
            array_push($old_group, $new_group);
            Information::create([
                'user_id' => Auth::user()->id,
                'groups' => serialize($old_group),
                'locations' => serialize($old_location),
                'shop_name' => $shop->shop_name
            ]);
            return response()->json(['success' => true, 'message' => 'اضافه شد', 'group' => $new_group]);

        }

        $old_group = unserialize($old_group[0]->groups);

        foreach ($old_group as $oldg) {
            if ($oldg == $new_group) {
                return response()->json(['success' => false, 'message' => 'این طبقه بندی وجود دارد']);
            }
        }
        array_push($old_group, $new_group);
        DB::table('information')
            ->where(['user_id' => Auth::user()->id])
            ->update(['groups' => serialize($old_group)]);
        return response()->json(['success' => true, 'message' => 'اضافه شد', 'group' => $new_group]);
    }

    public function admin_set_location(Request $request)
    {
        $old_location = Information::where('user_id', Auth::user()->id)->get();
        $shop = Shop::where('user_id', Auth::user()->id)->first();
        $new_location = $request->get('location');
        if ($new_location == "") {
            return response()->json(['success' => false, 'message' => 'دسته بندی را وارد کنید']);
        }

        if (count($old_location) == 0) {
            $old_location = [];
            $old_groups = [""];
            array_push($old_location, $new_location);
            Information::create([
                'user_id' => Auth::user()->id,
                'locations' => serialize($old_location),
                'groups' => serialize($old_groups),
                'shop_name' => $shop->shop_name
            ]);
            return response()->json(['success' => true, 'message' => 'اضافه شد', 'location' => $new_location]);

        }

        $old_location = unserialize($old_location[0]->locations);

        foreach ($old_location as $oldl) {
            if ($oldl == $new_location) {
                return response()->json(['success' => false, 'message' => 'این دسته بندی وجود دارد']);
            }
        }
        array_push($old_location, $new_location);
        DB::table('information')
            ->where(['user_id' => Auth::user()->id])
            ->update(['locations' => serialize($old_location)]);
        return response()->json(['success' => true, 'message' => 'اضافه شد', 'location' => $new_location]);
    }

    public function setaddinform(Request $request)
    {
        $information = Information::where('user_id', Auth::user()->id)->get();
        $group = serialize($request->groups);
        $location = serialize($request->locations);
        if (count($information) == 1) {
            DB::table('information')
                ->where(['user_id' => Auth::user()->id])
                ->update(['groups' => $group]);
            DB::table('information')
                ->where(['user_id' => Auth::user()->id])
                ->update(['locations' => $location]);
        } elseif (count($information) == 0) {

            $shop_nam = Shop::where('user_id', Auth::user()->id)->get();
            $shop_name = $shop_nam[0]->shop_name;

            Information::create([
                'user_id' => Auth::user()->id,
                'groups' => $group,
                'locations' => $location,
                'shop_name' => $shop_name ?? "shop_name",
            ]);
        }
        return redirect('/home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
//    public function setfavorite(Request $request)
//    {
////        $validreq = $request->validate([
////            'favorite' => 'required',
////            'favoritefile' => 'file|image|mimes:jpeg,png,jpg|size:50000'
////        ]);
////        return $validreq;
//
////        $file = $validreq['favoritefile'];
////        $filename = time() . $file->getClientOriginalName();
//
//        $file = $request->file('favoritefile');
//        $filename = time() . $file->getClientOriginalName();
//        $file->move('favorites/phptos' , $filename);
//        Favorite::create([
//            'favorite' => $request->get('favorite') ,
//            'path' => "/favorites/photos/{$filename}"
//        ]);
//        return back();
//    }

    public function profile()
    {
        $shop = Shop::where('user_id', Auth::user()->id)->get();
//return $shop;
        if (count($shop) == 1) {
            $text = "شما یک بار پروفایل خود را کامل کرده اید، در صورت تغییر اطلاعات جدید ذخیره می شوند.";
        } elseif (count($shop) == 0) {
            $text = "";
        }
        $profile = Shop::where('user_id', Auth::user()->id)->first();
//        dd($profile);
        $favorites = Favorite::all();
//        return $profile;
        return view('profile', compact('profile', 'text', 'favorites'));
    }

    public
    function aaaa()
    {
        return Auth::user();
        $a = Favorite::all()->get('1');
        return $a->path;
        return "<img src=\"/favorites/photos/1557338999State Diagram.png\">";
    }

    public
    function destroy_message($message)
    {
        Message::where('id', $message)->delete();
        return back();
    }

    public function user_verify(Request $request)
    {
        $user = User::all()->where('id', $request->get('id'))->first();
        if ($user->isuser == 1) {
            DB::table('users')
                ->where('id', '=', $request->get('id'))
                ->update(['isuser' => 0]);
            return response()->json(['success' => true, 'message' => $user->isuser]);
        } elseif ($user->isuser == 0) {
            DB::table('users')
                ->where('id', '=', $request->get('id'))
                ->update(['isuser' => 1]);
            return response()->json(['success' => true, 'message' => $user->isuser]);
        }
    }

    public function indexchart()
    {
        $beacons = DB::table('beacons')
            ->join('iot_records', 'beacons.mac_address', '=', 'iot_records.beacon_id')
            ->select('beacons.*', 'iot_records.*')
            ->get();
        $beacons = Beacon::all()->where('user_id', '=', Auth::user()->id);

        $last_week_date = [];

        $now = Jalalian::now();
        for ($i = 6; $i >=0;$i-- ){
            $last_week_date[$i] = $now->subDays($i)->format('%Y-%m-%d');
        }

        $collect = collect([]);
        $collect->put('a' , 'b');
//        dd($collect);



//        foreach ($beacons as $beacon){

            $beacon_record = IotRecord::where('beacon_id' ,'=', 1111)->first();
            $old_record = $beacon_record->record;

//            return $old_record;

//            DB::table('iot_records')
//                ->where('beacon_id' ,'=', $beacon->mac_address)
//                ->update(['record' => $new_record]);


//        }




//        return $beacons[0]->daily_record();

        return view('tables_dynamic', compact('beacons' , 'last_week_date'));
    }

    public function home_screen()
    {


        $profile = Shop::all()->where('user_id', '=', Auth::user()->id);
//    return count($profile);
        $beacon_admin = Beacon::all()->count();
        $user_admin = User::all()->count() - 1;
        $unique_user_shop = DB::table('iots')
            ->join('beacons', 'iots.beacon_id', '=', 'beacons.mac_address')
            ->select('iots.*')
            ->get();
        $unique_user_shop = $unique_user_shop->where('user_id', '=', Auth::user()->id);
        $unicount = count($unique_user_shop);
        $beacon_shop = Beacon::all()->where('user_id', '=', Auth::user()->id)->count();
        $race_shop = Race::all()->where('user_id', '=', Auth::user()->id)->count();
        $visit_r_shop = DB::table('iots')
            ->join('beacons', 'iots.beacon_id', '=', 'beacons.mac_address')
            ->select('iots.*')
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        $count = array();
        foreach ($visit_r_shop as $k => $v_r_s) {
            $count[$k] = $v_r_s->count;
        }
        $visit_shop = array_sum($count);

        $user_not_register = User::where('isadmin', '!=', '1')->paginate(5);

        $admin_comments = Comment::all()->where('user_id', '!=', Auth::user()->id);
        $admin_comments = $admin_comments->reverse();

        $user_comments = Comment::where('user_id', '=', Auth::user()->id)->get();
        $user_comments = $user_comments->reverse();

        $admin = User::where('isadmin', '=', '1')->first();

        if ($admin){
            $admin_send_comment = Comment::all()->where('user_id', '=', $admin->id);
        }
        $user_comments = $user_comments->reverse();

        return view('welcome',
            compact('beacon_admin', 'user_admin', 'beacon_shop',
                'race_shop', 'visit_shop', 'profile', 'unicount',
                'user_not_register', 'admin_comments', 'user_comments', 'admin_send_comment'));
    }

    public function main_page()
    {
        return view('main_page');
    }

    public function create_comment(Request $request)
    {
        if ($request->get('comment') == "") {
            return response()->json(['success' => false, 'message' => 'متن پیام خود را وارد کنید.']);

        }
        $comment_number = Comment::all()->where('user_id', '=', Auth::user()->id)->count();
        if ($comment_number >= 5) {
            return response()->json(['success' => false, 'message' => 'شما بیش از حد مجاز پیام ثبت کرده اید.']);

        } else {
            $comment = Comment::create([
                'user_id' => Auth::user()->id,
                'comment' => $request->get('comment'),
            ]);
            return response()->json(['success' => true, 'message' => 'پیام شما با موفقیت ارسال شد.', 'comment' => $comment->comment]);
        }
    }

    public function answer_comment(Request $request)
    {
        if ($request->get('answer') == "") {
            return response()->json(['success' => false, 'message' => 'متن پیام خود را وارد کنید.']);
        }

        DB::table('comments')
            ->where('id', '=', $request->get('id'))
            ->update(['answer' => $request->get('answer'), 'answer_status' => '1']);
        return response()->json(['success' => true, 'message' => 'پیام شما با موفقیت ارسال شد.',
            'answer' => $request->get('answer')]);
    }

    public function admin_create_comment(Request $request)
    {
        if ($request->get('comment') == "") {
            return response()->json(['success' => false, 'message' => 'متن پیام خود را وارد کنید.']);
        }

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'comment' => $request->get('comment'),
        ]);
        return response()->json(['success' => true, 'message' => 'پیام شما با موفقیت ارسال شد.', 'comment' => $comment->comment]);

    }

    public function user_messages_show()
    {
        return view('user_messages');
    }

    public function shops_messages_manage()
    {
        $admin = User::where('isadmin', '=', '1')->first();
        $shops = Shop::all();
        $admin_shop = Shop::all()->where('user_id', '=', $admin->id);
//        return $shops[0]->beacons();
        $admin_shop = $admin_shop[0]->shop_name;
        return view('all_shop_messages', compact('shops', 'admin_shop'));
    }
}
