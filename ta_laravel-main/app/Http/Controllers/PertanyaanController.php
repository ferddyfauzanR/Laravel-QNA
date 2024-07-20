<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pertanyaan;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\File;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Question';
        $user = User::all();
        $pertanyaan = Pertanyaan::selectRaw('pertanyaan.id,pertanyaan.judul,pertanyaan.content,pertanyaan.created_at,profiles.name,pertanyaan.user_id,pertanyaan.images,categories.name as categoriesName ')
                      ->join('categories', 'pertanyaan.categories_id', '=', 'categories.id')
                      ->join('users', 'pertanyaan.user_id', '=', 'users.id')
                      ->join('profiles','users.id','=','profiles.user_id')
                      ->get();         
        return view('pages.pertanyaan.index',['pertanyaan' => $pertanyaan], ['title'=>$title],['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Question';
        $categories = Category::all();
        return view('pages.pertanyaan.create', ['categories'=> $categories], ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'judul' => 'required|min:5',
            'content' => 'required|max:255',
            'categories_id' => 'required',
            'images' => 'required|mimes:png,jpeg,jpg|max:2048',
        ]);

        $id = Auth::id();
        $imagesName = time() . "." . $request->images->extension();
        $request->images->move(public_path('images'), $imagesName);

        $pertanyaan = new Pertanyaan;

        $pertanyaan->judul = $request->input('judul');
        $pertanyaan->content = $request->input('content');
        $pertanyaan->categories_id = $request->input('categories_id');
        $pertanyaan->user_id = $id;
        $pertanyaan->images = $imagesName;

        // $pertanyaan->judul = $request->input('judul');
        // $pertanyaan->content = $request->input('content');
        // $pertanyaan->categories_id = $request->input('categories_id');
        // $pertanyaan->user_id = $id;
        // $pertanyaan->images = $imagesName;

        $pertanyaan->save();
        return redirect('/pertanyaan');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $categories = Category::all();
        $title = 'Question';
        return view('pages.pertanyaan.create', ['categories'=> $categories], ['title' => $title],['pertanyaan' => $pertanyaan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $title = 'Question';
        $user = User::all();
        $categories = Category::all();
        $pertanyaan = Pertanyaan::selectRaw('pertanyaan.id,pertanyaan.judul,pertanyaan.content,pertanyaan.categories_id,pertanyaan.created_at,profiles.name,pertanyaan.user_id,pertanyaan.images,categories.name as categoriesName ')
                      ->join('categories', 'pertanyaan.categories_id', '=', 'categories.id')
                      ->join('users', 'pertanyaan.user_id', '=', 'users.id')
                      ->join('profiles','users.id','=','profiles.user_id')
                      ->where('pertanyaan.id','=',$id)
                      ->first();  
        return view('pages.pertanyaan.edit',['pertanyaan' => $pertanyaan,'categories'=> $categories,'title'=>$title,'user'=>$user, 'id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'content' => 'required',
            'categories_id' => 'required',
            'images' => 'mimes:png,jpeg,jpg|max:2048',
        ]);
        $pertanyaan = Pertanyaan::find($id);
        if($request->has('images')) {
            $path = "images/";
            File::delete($path . $pertanyaan->images);

            $imagesName = time().'.'.$request->images->extension();  
   
            $request->images->move(public_path('images'), $imagesName);  

            $pertanyaan->images = $imagesName;

            $pertanyaan->save();
        }

        $pertanyaan->judul = $request->judul;
        $pertanyaan->content = $request->content;
        $pertanyaan->categories_id = $request->categories_id;

        $pertanyaan->save();

       
        return redirect('/pertanyaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::find($id);
        $path = "images/";
            FILE::delete($path . $pertanyaan->images);
        $pertanyaan->delete();
        
        return redirect('/pertanyaan');
    }

    // public function isOwner()
    // {
    //     //
    //     return Auth::user()->id == $this->users->id;
    // }
}

