<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Entity\Caserne;
use App\Entity\Feu;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;

#[AllowDynamicProperties]
class CaserneController extends AbstractController
{
    public function __construct(

    ) {
        $this->status = "ko";
    }

    #[Route(path: '/api/caserne', name: 'get_caserne', methods: "GET")]
    public function getAllCaserne(Request $request, EntityManagerInterface $em ): JsonResponse {
$data = $em->getRepository(Caserne::class)->findAll();
            return $this->json(
               $data
            );
    }


}