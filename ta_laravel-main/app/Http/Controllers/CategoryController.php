<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
Use Alert;
use App\Models\Pertanyaan;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Categories";
        $categories = Category::all();
        return view('pages.categories.index', ['categories' => $categories], ['title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Categories';
        return view('pages.categories.create',[
            'title' => $title,]);
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
        $this->validate($request,[
    		'name' => 'required',
    	]);
 
        Category::create([
    		'name' => $request->name,
    	]);
        
    	return redirect('/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $title = 'Categories';
        $categories = Category::find($id);
        return view('pages.categories.show', ['categories' => $categories],['title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Categories";
        $categories = Category::find($id);
        return view('pages.categories.edit', ['categories'=>$categories],['title' =>$title]);
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
            'name' => 'required',
        ]);
        $categories = Category::find($id);
        $categories->name = $request->name;
        $categories->update();
        
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id);
        $cekPertanyaan = Pertanyaan::where('categories_id','=',$categories->id)->count(); //cek ada berapa pertanyaan yg pake kategori yang akan dihapus
        if ($cekPertanyaan>0) {
            return redirect('/category')->with('error','Kategori gagal dihapus, kategory sedang digunakan pada pertanyaan'); 
        }else{
            $categories->delete();
            return redirect('/category')->with('success','Kategori berhasil dihapus');
        }
    }
}
