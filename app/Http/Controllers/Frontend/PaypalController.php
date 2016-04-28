<?php

namespace LogoStore\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use LogoStore\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LogoStore\Http\Requests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use LogoStore\Logo;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        //setup Paypal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment(Request $request)
    {

        $this->validate($request, [
            'terms' => 'required|in:true'
        ]);

        if (!Session::has('logo_id'))
            return redirect()->route('index');

        $logo = Logo::findorFail(Session::get('logo_id'));

        $payer =  new  Payer();
        $payer->setPaymentMethod('paypal');

        $total = $logo->price;
        $currency = 'MXN';

        $item = new Item();
        $item->setName('Logo - '.$logo->name)
            ->setCurrency($currency)
            ->setDescription($logo->description)
            ->setQuantity('1')
            ->setPrice($total);

        $items[] = $item;

        $item_list = new ItemList();
        $item_list->setItems($items);

        /*$details = new Details();
        $details->setSubtotal('0')
            ->setShipping('0');*/

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription("Compra realizada en LogoStore");


        //dd(\URL::route('payment.status'));

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
            ->setCancelUrl(\URL::route('payment.status'));


        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions([$transaction]);


        //dd($this->_api_context);

        try{
            $payment->create($this->_api_context);
        }catch(\PayPal\Exception\PayPalConnectionException $ex){
            if(Config::get('app.debug')){
                echo "Exception: " . $ex->getMessage(). PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                dd($err_data);
                exit();
            }else{
                die("Upsss!! Algo salio mal.");
            }
        }

        foreach($payment->getLinks() as $link){
            if($link->getRel() == 'approval_url'){
                $redirect_url = $link->getHref();
                break;
            }
        }

        //add payment ID to session
        $request->session()->put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)){
            //redirect to paypal
            return Redirect::to($redirect_url);
        }

        return redirect()->route('front.summary')->withErrors('error', 'Upsss!! error desconocido');
    }


    public function getPaymentStatus(Request $request)
    {
        //Get the payment ID before session clear
        $payment_id = $request->session()->get('paypal_payment_id');

        //clear the session payment ID
        $request->session()->forget('paypal_payment_id');

        $payerId = Input::get('PayerID');
        $token = Input::get('token');

        if(empty($payerId)|| empty($token))
        {
           return redirect()->route('payment.messages')->with('message', 'Hubo un problema al intentar pagar con paypal');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution =  new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));


        $result = $payment->execute($execution, $this->_api_context);

        if($result->getState() == 'approved')
        {
           return redirect()->route('payment.messages')->with('message', 'Compra fue realizada de forma correcta');
        }


        return redirect()->route('payment.messages')->with('message', 'Compra fue cancelada');


    }

}
