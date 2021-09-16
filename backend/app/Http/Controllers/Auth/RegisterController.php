<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

//Mail
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

//Request
use Illuminate\Http\Request;

//時刻取得
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * 登録後、ユーザーのインスタンスを作成し本登録メールを送信
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            //todo:tokenの作り方はこれでいいのか
            'email_verify_token' => base64_encode($data['email']),
        ]);

        $email = new EmailVerification($user);
        Mail::to($user->email)->send($email);

        return $user;
    }

    /**
     * バリデーションチェックし仮登録のメールを送信
     * 
     * @param Illuminate\Http\Request $request
     * return view
     */
    public function preCheck(Request $request)
    {
        $this->validator($request->all())->validate();

        //sessionへ一時的に保存
        $request->flashOnly('email');

        $bridge_request = $request->all();

        $bridge_request['password_mask'] = '******';

        return view('auth.register_check')->with($bridge_request);
    }

    /**
     * Authで呼ばれるregister()でcreate()を呼び出し
     * 
     * @param Illuminate\Http\Request $request
     * return view
     */
    public function register(Request $request)
    {
        event(new Registered($user = $this->create( $request->all() )));

        return view('auth.registered');
    }

    /**
     * トークンが無効か調べ、auth_statusを更新する
     * 
     * @param string $email_token
     * return view
     */

    public function showMyPage($email_token)
    {
        //テーブルに存在するトークンかチェック
        if( !User::where('email_verify_token', $email_token)->exists() ){
            return view('auth.notice_registered')->with('message', '無効なトークンです。');
        } else {
            $user = User::where('email_verify_token', $email_token)->first();
            if ( $user->auth_status == config('const.USER_STATUS.REGISTER')){
                //既に登録されていた場合
                logger('status'.$user->auth_status);
                return view('auth.notice_registered')->with('messeage', 'すでに登録されています。ログインしてください');
            }
            //テーブルのstatusを更新
            $user->auth_status = config('const.USER_STATUS.MAIL_AUTHED');
            $user->email_verified_at = Carbon::now();

            //saveした時の例外時
            if ($user->save()) { 
                return view('auth.notice_registered');
            } else {
                return view('auth.notice_registered')->with('message', 'メール認証に失敗しました。');
            }
        }
    }
}