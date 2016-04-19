<?php

namespace LogoStore\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use LogoStore\Category;
use LogoStore\Http\Controllers\Controller;

use LogoStore\Http\Requests\CreateLogoRequest;

use Illuminate\Http\Request;

use LogoStore\Http\Requests;

use LogoStore\Keyword;
use LogoStore\Logo;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logos = Logo::with('category')->with('keywords')->orderBy('date', 'DESC')->paginate();

        return view('admin.logos.index', compact('logos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $keywords = Keyword::pluck('name', 'id');
        return view('admin.logos.create', compact('categories', 'keywords'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLogoRequest $request)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'date' => 'required|date',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:disponible,vendido',
            'category_id' => 'integer|exists:categories,id'
        ]);
        $logo = Logo::create($request->all());
        $this->multiStoreKeywords($logo, $request->keywords_id);

        $message ='El logo ' .$logo->name. ' fue agregado exitosamente a la base de datos.';
        if($request->ajax()) {
            return response()->json([
                'id' => $logo->id,
                'message' => $message
            ]);
        }
        Session::flash('message', $message);

        return redirect()->route('admin.logos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('name', 'id');
        $keywords = Keyword::pluck('name', 'id');

        $logo = Logo::with('keywords')->findOrFail($id);
        $logo->keywords_id = $logo->keywords->pluck('id')->toArray();

        return view('admin.logos.edit', compact('logo', 'categories', 'keywords'));
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
        $logo = Logo::findOrFail($id);
        $this->multiUpdateKeyword($logo, $request->keywords_id);
        $logo->fill($request->all());

        $logo->save();

        $message ='El logo ' .$logo->name. ' fue modificado exitosamente.';
        if($request->ajax()) {
            return response()->json([
                'id' => $logo->id,
                'message' => $message
            ]);
        }
        Session::flash('message', $message);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {

        $logo = Logo::findOrFail($id);

        $logo->delete();

        $message ='El logo ' .$logo->name. ' fue eliminado de nuestros registros.';
        if($request->ajax()) {
            return response()->json([
                'id' => $logo->id,
                'message' => $message
            ]);
        }
        Session::flash('message', $message);

        return redirect()->route('admin.logos.index');

    }

    /*
     * -- OPERACIONES CON KEYWORDS
     */
    public function multiStoreKeywords(Logo $logo, array $keywords_id)
    {
        //dd([$logo, $keywords_id]);
        foreach($keywords_id as $keyword_id) {
            $keyword = Keyword::findOrFail($keyword_id);
            $this->storeKeyword($logo, $keyword->id);
        }
        return true;
    }

    public function storeKeyword(Logo $logo, $keyword_id)
    {
        if($logo->getKeyword($keyword_id)) return false;

        $logo->keywords()->attach($keyword_id);
        return true;
    }

    public function multiUpdateKeyword(Logo $logo, array $keywords_id)
    {
        $keywords_idU = array_unique($keywords_id);
        $logo->keywords()->sync($keywords_idU);
        return true;
    }

    public function destroyKeyword(Logo $logo, $keyword_id)
    {
        if($logo->getKeyword($keyword_id)) return false;

        $logo->keywords()->detach($keyword_id);
        return true;
    }

}
