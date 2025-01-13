<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Entity\Camion;
use App\Entity\Capteur;
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
class CamionController extends AbstractController
{
    public function __construct(

    ) {
        $this->status = "ko";
    }


    #[Route(path: '/api/camion/{id}', name: 'put_camion', methods: "PUT")]
    public function putCamion(Request $request, EntityManagerInterface $em, $id ): JsonResponse {
        $data = $request->toArray();
        $camion = $em->getRepository(Camion::class)->findOneBy(['id'=>$id]);
            isset($value['coorX'])  ?? $camion->setCoorX($data['coorX']);
            isset($value['coorY']) ?? $camion->setCoorY($data['coorY']);
        $em->persist($camion);
        $em->flush();

        return $this->json(
            $data
        );
    }


}