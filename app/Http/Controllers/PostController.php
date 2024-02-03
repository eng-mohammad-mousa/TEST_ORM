<?php

namespace App\Http\Controllers;

use App\Models\Post;
// لكي اتمكن من التعامل مع المودل تاغ  خاص بالعلاقة كثير لكثير
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // بدون هذا التابع سيتمكن اي احد ما عامل تسجيل دخول من اضافة بوست ولذلك نضيفه

    // عد اضافته لن يتمكن احد من الذهاب لأي تابع اذا ما كان عامل تسجيل دخول

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        // $posts = Post::all();

        // اذا بدي يشوف بس منشوراتو
        // $posts = Post::where("user_id", Auth::id() )->get();

        // اذا بدي يشوف كل منشورات العالم
        // $posts = Post::latest()->get();

        // اذا بدي يشوف كل منشورات العالم بترتيب اخر اضافة
        // desc تنازلي
        $posts = Post::orderBy('created_at', 'desc')->get();

        // هذه لن تعمل اذا كان في مرتين عم عدل هوة بياخد اول زمن تعديل بس وليش مبعرف
        // $posts = Post::orderBy('updated_at', 'desc')->get();

        return view('posts.index')->with('posts', $posts);
    }

    public function postsTrashed()
    {
        // كل العالم بيقدرو يشوفو البوستات المحذوفة
        // $posts = Post::onlyTrashed()->get();

        // صحاب البوست المحذوف هم فقط من سيتمكنون من رؤية هذا البوست
        $posts = Post::onlyTrashed()->where("user_id", Auth::id())->get();
        return view('posts.trashed')->with('posts', $posts);
    }

    public function create()
    {
        // خاص بالعلاقة كثير لكثير
        $tags = Tag::all();
        // ممنوع الزبون يضيف بوست بدون ما يكون فيه تاغات
        if ($tags->count() == 0) {
            return redirect()->route("tag.create")->with("error", "you must add tags before add post ");
        }

        // نرسل التاغ وذلك لأنه عند عرض الصفحة يجب ان يأتي معها التاغات الموجودة في قواعد البينانات
        return view("posts.create")->with('tags', $tags);
    }

    public function store(Request $request)
    {
        // ال
        // user_id & slug
        //  أنا رح املأهم وليس اليوزر
        $this->validate($request, [
            "title" => 'required',
            "content" => 'required',
            "tags" => 'nullable',
            "photo" => 'required|image',
        ]);
        $photo = $request->photo;
        $newPhoto = time() . $photo->getClientOriginalName();
        //    getClientOrginalName
        // وظيفة هذا التابع هو فصل اسم الصورة عن امتدادها
        // time().$photo.getClientOrginalName();
        // سيتم بعد ذلك اضافة التاريخ الى اسم الصورة لكي نتجنب امر الحذف عند ورود صورتين بنفس الاسم

        // لكن قبل كلشي في مشروعي يجب تنفيذ الأمر التالي
        // composer require laravel/helpers

        // الأن سنحدد مكان الحفظ
        // وهو في المجلد ببلك والذي يمكن الوصول اليه فورا من اي مجلد في اللارافيل
        // وبداخله مجلدين قمنا بإنشائهم نحن
        // سنقوم بحفظ الصور فيهم
        $photo->move('uploads/posts/', $newPhoto);

        $post = Post::create([
            "user_id" => Auth::id(), //يجب استدعاء مكتبة الاوث في الأعلا
            "title" => $request->title,
            "content" => $request->content,
            "photo" => 'uploads/posts/' . $newPhoto, //مسار الصورة
            "slug" => str_slug($request->title), //توليد سلغ  من اسم التايتل
            // عبارة عن اضافة شخطات بين كلمات العنوان لا أكثر

        ]);

        $post->tag()->attach($request->tags);

        $posts = Post::orderBy('created_at', 'desc')->get();
        return redirect()->route("posts")->with("success", "post added successfuly")->with("posts", $posts);
    }

    public function show($slug)
    {
        // خاص بالعلاقة كثير لكثير
        $tags = Tag::all();

        //  يمكن مشاهدة بوستات الكل
        $post = Post::where("slug", $slug)->first();

        //  يمكن مشاهدة بوستاتو فقط
        // واذا فات عبوست غيرو بيعمل باك
        // $post = Post::where("slug", $slug)->where("user_id", Auth::id())->first();
        // if ($post === null) {
        //     return redirect()->back();
        // }

        return view('posts.show')->with('post', $post)->with('tags', $tags);
    }

    public function edit($id)
    {

        $tags = Tag::all();

        // التعديل مين من كان بعدل
        // $post = Post::find($id);

        // التعديل فقط لصاحب البوست
        // واذا فات عبوست غيرو بيعمل باك
        // $post = Post::where("user_id", Auth::id())->where("id", $id)->get();
        // لا يجب استخدام غيت مع اكثر من شرط وانما نستخدم فيرست
        $post = Post::where("user_id", Auth::id())->where("id", $id)->first();
        if ($post === null) {
            return redirect()->back();
        }

        return view('posts.edit')->with('post', $post)->with("tags", $tags);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->validate($request, [
            "title" => 'required',
            "content" => 'required',
            "photo" => 'nullable|image',
        ]);

        // بجوز المستخدم ما بدو يغير الصورة لكن اذا بدو يغيرها نحنا منضيف تابع تحقق اذا بدو يغيرها معلش بس رح نغير المسار
        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo->getClientOriginalName();

            $photo->move('uploads/posts/', $newPhoto);

            // لمعرفة المسار الذي تم حفظ الصورة فيه
            $post->photo = 'uploads/posts/' . $newPhoto;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        // خاص بالعلاقة كثير ل كثير
        $post->tag()->sync($request->tags);

        $posts = Post::orderBy('created_at', 'desc')->get();

        return redirect()->route("posts")->with("success", "post edit successfuly")->with("posts", $posts);
    }

    public function destroy($id)
    {

        // اي واحد بيقدر يحذف كل بوستات العالم
        // $posts = Post::withTrashed()->where('id', $id)->first();
        // الحذف فقط لصاحب البوست
        $posts = Post::withTrashed()->where('id', $id)->where("user_id", Auth::id())->first();
        // والا بيعملو باك
        if ($posts === null) {
            return redirect()->back();
        }

        $posts->delete();

        return redirect()->back()->with("success-delete", "post deleted successfuly");
    }

    public function hardDelete($id)
    {
        $posts = Post::withTrashed()->where("user_id", Auth::id())->where('id', $id)->first();
        if ($posts === null) {
            return redirect()->back();
        }

        $posts->forceDelete();

        return redirect()->back()->with("success-delete", "Post deleted from database");
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where("user_id", Auth::id())->where('id', $id)->first();

        if ($post === null) {
            return redirect()->back();
        }

        $post->restore();

        return redirect()->back()->with('success', "Post Restore Successfuly");
    }
}
