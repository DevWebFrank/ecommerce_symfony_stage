<?php

namespace App\Controller\Purchase;

use Stripe\Stripe;
use App\Entity\User;
use Stripe\Checkout\Session;
use App\Services\Cart\HandleCart;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    // appel vers Stripe 
    #[Route('/boutique/commande/stripe/session', name: 'boutique_stripe_session')]
    public function creatSession(HandleCart $handleCart)
    {    // ma clef secrete 
        Stripe::setApiKey('sk_test_51KP32hCUkRKEMw8wrQnwIQWFtSAtCxFienXJxwN0NCpQtGhSYHf3iiLbxFV2w1hP60f48uOs5QwVXpGoweXjC3sj00ZXMJA5vK');
        // mon domaine
        $YOUR_DOMAIN = 'http://localhost:8000';

        /** @var User $user */
        $user = $this->getUser();

        $productDetail = $handleCart->detailPanier();
        // produit qu'il vont pouvoir detailler
        $productForStripe = [];

        // boucle pour lui donner pour chaque item les infos (le prix, la monnaie, le nom le visuel et la quantité)  
        foreach ($productDetail as $item) {
            $productForStripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $item->getProduct()->getPrice(),
                    'product_data' => [
                        'name' => $item->getProduct()->getName(),
                        'images' => [
                            $item->getProduct()->getImagePath()
                        ]
                    ]
                ],
                'quantity' => $item->getQty()
            ];
        }

        $checkout_session = Session::create([
            'customer_email' => $user->getEmail(),
            'payment_method_types' => [
                'card',
            ],
            'line_items' => [[
                $productForStripe
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/boutique/paiement/success',
            'cancel_url' => $YOUR_DOMAIN . '/boutique/paiement/cancel',
        ]);

        return $this->redirect($checkout_session->url);
    }
}
