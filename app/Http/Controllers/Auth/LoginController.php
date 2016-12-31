<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * 覆写引用类AuthenticatesUsers方法：
     *
     * 修改auth视图默认路径
     */
    public function showLoginForm()
    {
        return view(theme('auth.login'));
    }

    /**
     * 覆写引用类AuthenticatesUsers方法：
     *
     * 修改auth默认登陆用户表字段 email > name
     */
    public function username()
    {
        return 'name';
    }

    /**
     * 覆写引用类AuthenticatesUsers方法：
     *
     * 增加登陆验证字段，使新注册用户默认未激活
     */
    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'),['level' => '1']);
    }
}
