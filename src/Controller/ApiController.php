<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\SolarData;
use App\Form\SolarDataType;
use ContainerPeZJTxQ\get_Debug_ValueResolver_ArgumentResolver_DatetimeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ApiController extends AbstractController
{
    #[Route('/api/data', name: 'api_post_data', methods: ['POST'])]
    public function postData(Request $request, EntityManagerInterface $entityManager)
    {
        $customerRepository = $entityManager->getRepository(Customer::class);

        $customer = $customerRepository->find($request->request->getInt('customer'));

        $solarData = new SolarData();
        $solarData->setCustomer($customer)
                  ->setCreatedAt(new \DateTime($request->request->get('createdAt')))
                  ->setCo2($request->request->getInt('co2'))
                  ->setThrees($request->request->getInt('threes'))
                  ->setProduction((int) $request->request->get('production'))
                  ->setProductionDay((float) $request->request->get('productionDay'))
                  ->setProductionTotal((int) $request->request->get('productionTotal'));

        $entityManager->persist($solarData);
        $entityManager->flush();

        return $this->json([
            'message' => 'success'
        ], 200);
    }
}
