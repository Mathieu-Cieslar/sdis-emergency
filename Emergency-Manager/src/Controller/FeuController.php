<?php

namespace App\Controller;

use AllowDynamicProperties;
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
class FeuController extends AbstractController
{
    public function __construct(

    ) {
        $this->status = "ko";
    }

    #[Route(path: '/api/feu', name: 'get_feu', methods: "GET")]
    public function getAllFeu(Request $request, EntityManagerInterface $em ): JsonResponse {
$data = $em->getRepository(Feu::class)->findAll();
            return $this->json(
               $data
            );
    }

    #[Route(path: '/api/feu', name: 'post_feu', methods: "POST")]
    public function postFeu(Request $request, EntityManagerInterface $em ): JsonResponse {
        $data = $request->toArray();





    }


}