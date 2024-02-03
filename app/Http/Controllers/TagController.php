<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::where("user_id", Auth::id())->latest()->get();
        return view("tags.index")->with("tags", $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tags.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // يمثل الاسم في صفحة البليد
            "tag" => 'required',

        ]);

        $tag = Tag::create([
            //يجب استدعاء مكتبة الاوث في الأعلا
            "user_id" => Auth::id(),
            "tags" => $request->tag,
        ]);

        return redirect()->back()->with("success", "tag added successfuly");

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::where("user_id", Auth::id())->where("id", $id)->first();

        if ($tag === null) {
            return redirect()->back();
        }
        return view('tags.edit')->with('tag', $tag);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $this->validate($request, [
            "tags" => 'required',

        ]);

        $tag->tags = $request->tags;
        $tag->save();

        return redirect()->back()->with("success", "tag edit successfuly");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $tag = Tag::where("user_id", Auth::id())->where("id", $id)->first();


        $tag = Tag::where("user_id", Auth::id())->where("id", $id)->first();
        if ($tag === null) {
            return redirect()->back();
        }

        // نفس الشي تماما وهاد السؤال اللي بيطرح نفسو
        $tag->destroy($id);
        // $tag->delete();

        return redirect()->back()->with("success", "tag deleted successfuly");

    }
}
