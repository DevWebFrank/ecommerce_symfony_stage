<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FooterController extends AbstractController
{
    #[Route('/admin/footer', name: 'admin_footer')]
    public function index(): Response
    {
        return $this->render('admin/footer/index.html.twig', [
            'controller_name' => 'FooterController',
        ]);
    }

    #[Route('/admin/mentionLegale', name: 'admin_mentionLegal')]
    public function mentionLegal(): Response
    {
        return $this->render('admin/footer/mentionLegal.html.twig', [
            'controller_name' => 'FooterController',
        ]);
    }
}
