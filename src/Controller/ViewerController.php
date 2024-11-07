<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Repository\SolarDataRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class ViewerController extends AbstractController
{
    #[Route('/viewer/{uid}', name: 'app_viewer')]
    public function index(string $uid, CustomerRepository $customerRepository, SolarDataRepository $solarDataRepository): Response
    {
        $customer = $customerRepository->findOneBy([
            'uid' => $uid
        ]);

        if ($customer === null) {
            throw new NotFoundHttpException();
        }

        $lastData = $solarDataRepository->findOneBy([
            'customer' => $customer
        ], ['id' => 'DESC']);

        return $this->render('viewer/index.html.twig', [
            'data' => $lastData,
            'customer' => $customer,
            'urlSite' => $_ENV['URL_SITE']
        ]);
    }
}
