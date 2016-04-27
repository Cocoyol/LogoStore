<?php

namespace LogoStore\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;

use LogoStore\Customer;

use LogoStore\Http\Controllers\Controller;

use Illuminate\Http\Request;

use LogoStore\Http\Requests;
use LogoStore\Http\Requests\CreateCustomerRequest;

class CustomerController extends Controller
{

    use RedirectWithSessionMessage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('name', 'DESC')->paginate();

        return view('admin.customers.index', compact('customers'));
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
    public function store(CreateCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        return $this->redirectWithFlashMessage(
            'El cliente "' .$customer->name. '" fue agregado exitosamente a la base de datos.',
            $request->ajax(),
            redirect()->route('admin.customers.index')
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
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
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
        $customer = Customer::findOrFail($id);

        $this->validate($request,[
        'name' => 'required|max:255',
        'email' => 'required|max:255|email|unique:customers,email,'.$customer->id,
            'phone' => 'required|max:255'
        ]);

        $customer->fill($request->all());
        $customer->save();

        return $this->redirectWithFlashMessage(
            'La informaci&oacute;n del cliente "' .$customer->name. '" fue modificada exitosamente.',
            $request->ajax(),
            redirect()->route('admin.customers.index')
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
        $customer = Customer::findOrFail($id);

        $customer->delete();

        return $this->redirectWithFlashMessage(
            'El cliente "' .$customer->name. '" fue eliminado de nuestros registros.',
            $request->ajax(),
            redirect()->route('admin.customers.index')
        );
    }
}
