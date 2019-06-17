<?php


namespace App\Services;


use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class Payment
{
    /**
     * @var Request|null
     */
    private $request;
    private $privateKey;

    public function __construct(RequestStack $requestStack, $privateKey)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->requestStack = $requestStack;
        $this->privateKey = $privateKey;
    }

    public function doPayment(float $amount, string $description)
    {
        Stripe::setApiKey($this->privateKey);
        try{
            $charge = Charge::create(array(
                "amount" => $amount * 100,
                "currency" => "eur",
                "source" => $this->request->request->get('stripeToken'),
                "description" => $description
            ));

            return $charge['id'];

        }catch(Card $exception){
            return false;
        }
    }


}