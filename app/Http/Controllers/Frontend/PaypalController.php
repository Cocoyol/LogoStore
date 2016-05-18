<?php

namespace LogoStore\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use LogoStore\AdditionalRequirementsLogoPrice;
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

        if (!Session::has('logo_id') ||
            !Session::has('customer') ||
            !Session::has('requirements') ||
            !Session::has('additionals')) {
            return redirect()->route('index');
        }

        Session::put('paypal', true);

        $logo = Logo::findorFail(Session::get('logo_id'));

        $payer =  new  Payer();
        $payer->setPaymentMethod('paypal');

        $currency = 'MXN';
        $items = [];
        $total_ad  = 0;
        $total_ad2 = 0;
        $total_ad3 = 0;

        // Cálculo del Total
        $subtotal = $logo->price;

        // Requerimientos adicionales
        $additionals = Session::get('additionals');
        $additionalsData = AdditionalRequirementsLogoPrice::get(['id', 'text', 'price']);
        //$addText = ' $'.$logo->price;


        if(isset($additionals[1])) {

            $total_ad = $additionalsData[0]->price;
            //$addText .= " + ".$additionalsData[0]->text." $".$additionalsData[0]->price;

            $item_1 = new Item();
            $item_1->setName('Cambio de tipografia')
                ->setCurrency($currency)
                ->setDescription($additionalsData[0]->text)
                ->setQuantity('1')
                ->setPrice($total_ad);

            $items[] = $item_1;

        }
        if(isset($additionals[2])) {

            $total_ad2 = $additionalsData[1]->price;

            $item_2 = new Item();
            $item_2->setName('Cambio de color')
                ->setCurrency($currency)
                ->setDescription($additionalsData[1]->text)
                ->setQuantity('1')
                ->setPrice($total_ad2);


            $items[] = $item_2;


            //$total += $additionalsData[1]->price;
            //$addText .= " + ".$additionalsData[1]->text." $".$additionalsData[1]->price;
        }
        if(isset($additionals[3])) {

            $total_ad3 = intval($additionals[3]['data']) * $additionalsData[2]->price;


            $item_3 = new Item();
            $item_3->setName('Revisiones')
                ->setCurrency($currency)
                ->setDescription($additionalsData[2]->text)
                ->setQuantity($additionals[3]['data'])
                ->setPrice($additionalsData[2]->price);

            $items[] = $item_3;

            //$total += intval($additionals[3]['data']) * $additionalsData[2]->price;
            //$addText .= " + ".$additionalsData[2]->text." $".intval($additionals[3]['data']) * $additionalsData[2]->price." (".$additionals[3]['data']." * ".$additionalsData[2]->price.")" ;
        }




        $item_0 = new Item();
        $item_0->setName('Logo - '.$logo->name)
            ->setCurrency($currency)
            ->setDescription($logo->description)
            ->setQuantity('1')
            ->setPrice($subtotal);


        $items[] = $item_0;


        $total = $subtotal + $total_ad + $total_ad2 + $total_ad3;



        //dd($items);

        $item_list = new ItemList();
        $item_list->setItems($items);


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
