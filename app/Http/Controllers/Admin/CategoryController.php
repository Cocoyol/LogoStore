<?php

namespace LogoStore\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;

use LogoStore\Category;

use LogoStore\Http\Controllers\Controller;

use LogoStore\Http\Requests\CreateCategoryRequest;

use Illuminate\Http\Request;

use LogoStore\Http\Requests;

class CategoryController extends Controller
{

    use RedirectWithSessionMessage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'ASC')->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create($request->all());

        return $this->redirectWithFlashMessage(
            'La categor&iacute;a "' .$category->name. '" fue agregada exitosamente a la base de datos.',
            $request->ajax(),
            redirect()->route('admin.categories.index')
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
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategoryRequest $request, $id)
    {
        $category = Category::findOrfail($id);

        $category->fill($request->all());

        $category->save();

        return $this->redirectWithFlashMessage(
            'La categor&iacute;a "' .$category->name. '" fue modificada exitosamente.',
            $request->ajax(),
            redirect()->route('admin.categories.index')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $category = Category::findOrfail($id);

        $category->delete();

        return $this->redirectWithFlashMessage(
            'La categor&iacute;a "' .$category->name. '" fue eliminada de nuestros registros.',
            $request->ajax(),
            redirect()->route('admin.categories.index')
        );
    }
}
