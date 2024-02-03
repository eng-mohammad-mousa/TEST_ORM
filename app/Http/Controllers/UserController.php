<?php

namespace App\Http\Controllers;

// يجب استدعاؤهم
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // بدون هذا التابع سيتمكن اي احد ما عامل تسجيل دخول من اضافة بوست ولذلك نضيفه

    // عد اضافته لن يتمكن احد من الذهاب لأي تابع اذا ما كان عامل تسجيل دخول

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $users = User::latest()->get();

        return view('users.all-user')->with('users', $users);

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // طالما استخدمنا مكتبة الهاش فهاد بيعني انو لازم جيبها واكتبها فوق
        ]);

        $profile = Profile::create([
            // نفسها تعيت الشرط بكونترولر البروفايل لكن
            // اليوزر اي دي سيأخذه من الأعلى
            'user_id' =>  $user->id,
            'city' => 'syria',
            'gender' => 'male',
            'bio' => 'hello world',
            'facebook' => 'https://www.facebook.com',

        ]);
        return redirect()->route("users")->with("success", "user added successfuly");
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->profile !== null) {
            $user->profile->delete($id);
        }

        $user->delete();
        return redirect()->route("users")->with("success-delete", "user deleted successfuly");;
    }
}
