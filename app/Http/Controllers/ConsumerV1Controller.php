<?php


namespace App\Http\Controllers;


use App\Beacon;
use App\Customer;
use App\Follow;
use App\Iot;
use App\Notif;
use http\Env\Response;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ConsumerV1Controller extends Controller
{
    public $loginAfterSignUp = true;

    /**
     * @OA\Info(title="offera-api", version="0.1")
     */


    public function __construct()
    {
        auth()->setDefaultDriver('api');


//        Config::set('auth.providers.users.model', Customer::class);
//        Config::set('auth.providers.users.table', 'customers');
//        Config::set('jwt.user', Customer::class);

    }

    /**
     * @OA\Post(
     *     path="/customer/register",
     *     @OA\Response(response="200", description="customer register")
     *
     * )
     */

    public function register(Request $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => bcrypt($request->password),
        ]);

        $token = auth()->login($customer);

        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *     path="/customer/login",
     *     @OA\Parameter(
     *         name="mobile",
     *         in="query",
     *         description="Tags to filter by",
     *         required=true,
     *         @OA\Schema(
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Tags to filter by",
     *         required=true,
     *         @OA\Schema(
     *           @OA\Items(type="string"),
     *         ),
     *         style="form"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     content: asa,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Pet")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Invalid tag value",
     *     ),
     *     security={
     *         {"petstore_auth": {"write:pets", "read:pets"}}
     *     },
     *     deprecated=true
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['mobile', 'name' ,  'password']);

//        return \response()->json(auth()->attempt($credentials));
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function refreshUser() {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }

    public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());
    }

    /**
     * @OA\Post(
     *     path="/customer/logout",
     *     @OA\Response(response="200", description="customer register")
     *
     * )
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 10 * 48
        ]);
    }

    /**
     * @OA\Post(
     *     path="/customer/verity",
     *     @OA\Response(response="200", description="customer register")
     *
     * )
     */
    public function verifyUser(Request $request)
    {
        $mobile = $request->mobile;
        $user = Customer::all()->where('mobile' , '=' , $mobile);
        if(count($user) > 0){
            if ($user->name && $user->password){
                return response()->json($user);
            }
        }
        return response()->json(['message' => "user is not verify"]);
    }

    public function followpost(Request $request)
    {

        $customerr = auth()->user();

        $customer = Follow::where(['customer_id' => $customerr->mobile, 'shop_id' => $request->get('shop_id')])
            ->get();

        if (count($customer) == 0) {

            Follow::create([
                'customer_id' => $customerr->mobile,
                'shop_id' => $request->get('shop_id'),
                'follow' => $request->get('follow')
            ]);

            return response()->json(['message' => 'set follow']);
        }
        return response()->json(['message' => 'follow']);
    }

    public function unfollowpost(Request $request)
    {
        $customer = auth()->user();

        $follow = Follow::where('customer_id', $customer->mobile)->get();

        if (count($follow) == 0) {
            return "boro baba";
        } else {
            Follow::where('customer_id', $customer->mobile)->delete();
            return response()->json(['message' => 'unfollow']);
        }
    }

    public function get_home_message(Request $request)
    {
        $customer = auth()->user();

        $message_follows = DB::table('messages')
            ->join('follows', 'messages.shop_id', '=', 'follows.shop_id')
            ->join('shops', 'shops.id', '=', 'follows.shop_id')
            ->select('messages.*', 'follows.*' , 'shops.shop_name')
            ->where('customer_id', '=', $customer->mobile)
            ->get();
        return $message_follows;
    }

    public function store(Request $request)
    {
        $customer = auth()->user();
        $beacon_mac = $request->get('beacon_mac');
        $beacon_status = Beacon::where('mac_address' , $beacon_mac)->get();
        if ($beacon_status[0]->status == 0){
            return response()->json(['message' => 'Beacon is not active']);
        }

        $notifs = DB::table('notifs')
            ->join('shops', 'notifs.user_id', '=', 'shops.user_id')
            ->select('notifs.*', 'shops.id as shop_id' , 'shops.shop_name')
            ->get();


        $iot = Iot::where(['customer_id' => $customer->mobile, 'beacon_mac' => $request->get('beacon_mac')])->get();
        if (count($iot) == 0) {

            $iot = new Iot();
            $iot->customer_id = $customer->mobile;
            $iot->beacon_mac = $request->get('beacon_mac');
            $iot->beacon_id = $request->get('beacon_mac');
            $iot->rssi = $request->get('rssi');
            $iot->count = '1';
            $iot->save();

//            $notifs = DB::table('notifs')
//                ->join('shops', 'notifs.user_id', '=', 'shops.user_id')
//                ->select('notifs.*', 'shops.id as shop_id' , 'shops.shop_name')
//                ->get();


//            $notifs = Notif::where('beacon_mac', '=', $beacon_mac)->first();
            return $notifs;
        } elseif (count($iot) == 1) {
//            return "iot hast";

            $coun = Iot::where(['customer_id' => $customer->mobile, 'beacon_mac' => $request->get('beacon_mac')])->get();
//            return $coun;
            $count = $coun[0]->count;
            $count = $count + 1;
            DB::table('iots')
                ->where(['customer_id' => $customer->mobile, 'beacon_mac' => $request->get('beacon_mac')])
                ->update(['count' => $count]);

            return $notifs;
//            if ($coun[0]->count % 10 == 0) {
//                $notifs = Notif::all()->where('beacon_mac', '=', $beacon_mac)->first();
//                return $notifs;
//            }
//            return response()->json(['message' => 'customer counter ++']);

        }

    }

    public function register_v2(Request $request)
    {
        if ($request->header('verify_token') == "K8vCaBPIhZLumw6R5I2ZDkhId.Offera.aCRMgmi0mtIUKmG2P2p6BrzIhVZOfOfVWoTlxnN")
        {
            $customer = Customer::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'password' => bcrypt($request->password),
            ]);

            $token = auth()->login($customer);

            return $this->respondWithToken($token);
        }
        return response()->json(["message" => "request is not valid"]);
    }


}


