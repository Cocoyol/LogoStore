<?php

namespace LogoStore\Http\Controllers\admin;

use Illuminate\Support\Facades\Session;

use LogoStore\Keyword;

use Illuminate\Http\Request;

use LogoStore\Http\Requests\CreateKeywordRequest;

use LogoStore\Http\Requests;

use LogoStore\Http\Controllers\Controller;

class KeywordController extends Controller
{
    use RedirectWithSessionMessage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords = Keyword::orderBy('name', 'ASC')->paginate();
        return view('admin.keywords.index', compact('keywords'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.keywords.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateKeywordRequest $request)
    {
        $keyword = Keyword::create($request->all());
        return $this->redirectWithFlashMessage(
            'La palabra clave "' .$keyword->name. '" fue agregada exitosamente en nuestros registros.',
            $request->ajax(),
            redirect()->route('admin.keywords.index')
        );
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
        $keyword = Keyword::findOrFail($id);
        return view('admin.keywords.edit', compact('keyword'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateKeywordRequest $request, $id)
    {
        $keyword = Keyword::findOrfail($id);

        $keyword->fill($request->all());

        $keyword->save();

        return $this->redirectWithFlashMessage(
            'La palabra clave "' .$keyword->name. '" fue modificada exitosamente.',
            $request->ajax(),
            redirect()->route('admin.keywords.index')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $keyword = Keyword::findOrfail($id);

        $keyword->delete();

        return $this->redirectWithFlashMessage(
            'La palabra clave "' .$keyword->name. '" fue eliminada de nuestros registros.',
            $request->ajax(),
            redirect()->route('admin.keywords.index')
        );
    }
}
