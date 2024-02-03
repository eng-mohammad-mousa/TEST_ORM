<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    // بدون هذا التابع سيتمكن اي احد ما عامل تسجيل دخول من اضافة بوست ولذلك نضيفه

    // عد اضافته لن يتمكن احد من الذهاب لأي تابع اذا ما كان عامل تسجيل دخول

    public function __construct(){
        $this->middleware("auth");
    }

    public function index()
    {
        // يمكن استخراج البيناتات من القاعدة
        // لكن لدينا مكتبة ال
        // auth
        // بقا ليش ه الحيونة
        // لازم نستدعي المكتبة فوق اهم شي
        $user = Auth::user();
        $id = Auth::id();

        // اذا كان المستخدم لا يمتلك بروفايل
        // قم بإنشاء بروفايل بالبيانات التالية
        // profile
        // تمثل اسم التابع الموجود في جدول ال
        // user

        //
        if ($user->profile === null) {
            // dd($user->profile);
            $profile = Profile::create([
                'user_id' => $id,
                'city' => 'syria',
                'gender' => 'male',
                'bio' => 'hello world',
                'facebook' => 'https://www.facebook.com',

            ]);
        }

        // وهيك لو غير ال اي دي ما رح يصير شي
        // قد ما غير رح يوجهو لحسابو
        // اما لو استخدمنا اي دي
        // بتغيير الاي دي بيتغير الحساب
        return view("users.profile")->with("user" , $user);

    }

    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required' ,
            'city' => 'required' ,
            'gender' => 'required' ,
            'bio' => 'required' ,
        ]);

        $user = Auth::user();

        // الطرف الأول يمثل أسماء الأعمدة في قاعدة البيانات
        // من الداتا بيس يتم جلب الأسماء

        // الطرف الثاني اللي بجانب الريكوسيت بمثل اسماء حقول الإدخال
        // من البليد يتم جلب الأسماء



        $user->name = $request->name; // الحقل موجود في جدول المستخدمين فالوصول مباشرة للعمود نيم

        // يجب الاستعانة بالتابع بروفايل الموجود ضمن المودل
        // user
        $user->profile->city = $request->city;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;


        // هنا تغيير كلمة السر  ليس ضروري
        if($request->has('password')){
            // بيكربت تابع تشفير فقط
            $user->password = bycrpt($request->password);
            $user->save();
            $user->profile->save();
        }

        $user->save();
        $user->profile->save();
        // رجعني للصفخة الحالية
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
