<?php

namespace LogoStore\Http\Controllers\Admin;

use Illuminate\Http\Request;

use LogoStore\AdditionalRequirementsLogoPrice;
use LogoStore\Http\Requests;
use LogoStore\Http\Controllers\Controller;
use LogoStore\Http\Requests\EditAdditionalRequirementsLogoPriceRequest;

class AdditionalRequirementsLogoPriceController extends Controller
{
    use RedirectWithSessionMessage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additionals = AdditionalRequirementsLogoPrice::orderBy('id', 'ASC')->paginate();
        return view('admin.additional.index', compact('additionals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $additional = AdditionalRequirementsLogoPrice::findOrFail($id);
        return view('admin.additional.edit', compact('additional'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAdditionalRequirementsLogoPriceRequest $request, $id)
    {
        $additional = AdditionalRequirementsLogoPrice::findOrfail($id);

        $additional->fill($request->all());

        $additional->save();

        return $this->redirectWithFlashMessage(
            'El requerimiento adicional "' .$additional->id. '" fue modificada exitosamente.',
            $request->ajax(),
            redirect()->route('admin.additional.index')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
