<?php

namespace App\Http\Controllers;

use App\Beacon;
use App\Customer;
use App\Favorite;
use App\Information;
use App\Iot;
use App\Message;
use App\Notif;
use App\Shop;
use App\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
//        return Auth::user()->id;
        $beacon_iot = DB::table('iots')
            ->join('beacons', 'iots.beacon_mac', '=', 'beacons.mac_address')
//            ->where('beacon.user_id' ,'=', Auth::user()->id)
            ->select('beacons.*', 'iots.count')
            ->get();

        $iot = Iot::paginate(30);

        $beacons = Beacon::all()->where('user_id', '=', Auth::user()->id);
        $customer = Customer::all();
        $spiot = "";
        return view('tables', compact('iot', 'beacons', 'customer', 'beacon_iot', 'spiot'));
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
    public function store(Request $request)
    {
        $customer = Customer::where('mac_address', $request->get('mac_address'))->get();
        if (count($customer) == 0) {
//            return "customer nist";
            Customer::create([
                'mac_address' => $request->get('mac_address'),
                'name' => "name",
                'telnum' => "telnum",
                'getrace' => "getrace",
                'time' => "time",
                'points' => "0"
            ]);
        }
//        $iots = Iot::where(['beacon_mac' => $request->get('beacon_mac'), 'customer_id' => $request->get('mac_address')])->first();
//        $beacon = Beacon::where('mac_address', $request->get('beacon_mac'))->first();

        $iot = Iot::where(['customer_id' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac')])->get();
        if (count($iot) == 0) {
//            return "iot nist";

            $iot = new Iot();
            $iot->customer_id = $request->get('mac_address');
            $iot->beacon_mac = $request->get('beacon_mac');
            $iot->beacon_id = $request->get('beacon_mac');
            $iot->rssi = $request->get('rssi');
            $iot->count = '1';
            $iot->save();

            $notifs = Notif::where('beacon_mac', $request->get('beacon_mac'))->get();
            return $notifs[0]->txt;
        } elseif (count($iot) == 1) {
//            return "iot hast";

            $coun = Iot::where(['customer_id' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac')])->get();
//            return $coun;
            $count = $coun[0]->count;
            $count = $count + 1;
            DB::table('iots')
                ->where(['customer_id' => $request->get('mac_address'), 'beacon_mac' => $request->get('beacon_mac')])
                ->update(['count' => $count]);

//            return $coun;
            if ($coun[0]->count == 10) {
                return "/////// 10 ///////";
            }
//            return "count++";
        }


    }

    public function qrcode()
    {
        return view('qrcode');
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
        $notifs = Notif::all()->where('user_id', '=', Auth::user()->id);
        return view('notif', compact('notifs'));
    }

    public function message_create()
    {

        $messages = Message::all()->where('user_id', '=', Auth::user()->id);
        $favorites = Favorite::all();
//        return $favorites[0]->favorite;
        return view('message_shop', compact('messages', 'favorites'));
    }

    public function editnotif($notif, Request $request)
    {
//        $this->authorize('UserPark', $notif);
        $notifs = Notif::where('beacon_mac', $notif)->first();
        $beacon_name = Beacon::where('mac_address', $notif)->first();
        $beacon_name = $beacon_name->name;

        return view('editnotif', compact('notifs', 'beacon_name'));
    }

    public function updatenotif(Request $request)
    {
//    if ($request->pic!=""){
//        return "salam";
//    }
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
        if ($request->vid != "") {
            DB::table('notifs')
                ->where(['beacon_mac' => $request->get('beacon_mac')])
                ->update(['vid' => $request->get('vid')]);
        }
        if ($request->url != "") {
            DB::table('notifs')
                ->where(['beacon_mac' => $request->get('beacon_mac')])
                ->update(['url' => $request->get('url')]);
        }
        if ($request->dis != "") {
            DB::table('notifs')
                ->where(['beacon_mac' => $request->get('beacon_mac')])
                ->update(['dis' => $request->get('dis')]);
        }

        return redirect('api/notif/create');
    }

    public function inform()
    {
        $aa = User::where('isadmin' , 1)->first();

        $all = Information::where('user_id', $aa->id)->first();
        $all_groups = unserialize($all->groups);
        $all_locations = unserialize($all->locations);
        $info = Information::where('user_id', Auth::user()->id)->get();
        $text = "";
        if (count($info) == 1) {
            $text = "شما یک بار برای فروشگاه خود اطلاعات پایه را وارد کرده اید. در صورت ادامه اطلاعات جدید به جای آنها خواهد نشست.";
        }
        $beacons = Beacon::all()->where('user_id', '=', Auth::user()->id);
        $favorites = Favorite::all();
//        return $favorites;
        return view('information', compact('beacons', 'favorites', 'text', 'all_groups', 'all_locations'));
    }

    public function setinform(Request $request)
    {

        $info = Information::where('user_id', Auth::user()->id)->get();
        if (count($info) == 1) {
            if ($request->gmenu) {
                $groups = $request->gmenu;
                $i = 0;
                foreach ($groups as $grou) {
                    $group[$i] = $grou;
                    $i++;
                }
                $group= serialize($group);
                DB::table('information')
                    ->where(['user_id' => Auth::user()->id])
                    ->update(['groups' => serialize($group)]);
            }


            if ($request->lmenu) {
                $locations = $request->lmenu;
                $i = 0;
                foreach ($locations as $locat) {
                    $location[$i] = $locat;
                    $i++;
                }
                $location= serialize($location);
                DB::table('information')
                    ->where(['user_id' => Auth::user()->id])
                    ->update(['locations' => serialize($location)]);
            }

        } elseif (count($info) == 0) {

            if ($request->gmenu) {
                $groups = $request->gmenu;
                $i = 0;
                foreach ($groups as $grou) {
                    $group[$i] = $grou;
                    $i++;
                }
                $group= serialize($group);
            }else{ $group = "";}


            if ($request->lmenu) {
                $locations = $request->lmenu;
                $i = 0;
                foreach ($locations as $locat) {
                    $location[$i] = $locat;
                    $i++;
                }
                $location= serialize($location);
            }else{ $location = "";}



            $shop_nam = Shop::where('user_id', Auth::user()->id)->get();
            $shop_name = $shop_nam[0]->shop_name;
            Information::create([
                'groups' => serialize($group),
                'locations' => serialize($location),
                'user_id' => Auth::user()->id,
                'shop_name' => $shop_name ?? "shop_name",
            ]);
        }
        return redirect('/');
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

        if (count($shop) == 1) {
            $text = "شما یک بار اطلاعات شخصی خود را وارد کرده اید، در صورت تغییر اطلاعات قبلی حذف می شوند.";
        } elseif (count($shop) == 0) {
            $text = "";
        }
        $profile = Shop::where('user_id', Auth::user()->id)->first();
//        dd($profile);
        $favorites = Favorite::all();
//        return $profile;
        return view('profile', compact('profile', 'text' , 'favorites'));
    }

    public function aaaa()
    {
        return Auth::user();
        $a = Favorite::all()->get('1');
        return $a->path;
        return "<img src=\"/favorites/photos/1557338999State Diagram.png\">";
    }

    public function destroy_message($message)
    {
        Message::where('id', $message)->delete();
        return redirect('/api/message/create');
    }
}
