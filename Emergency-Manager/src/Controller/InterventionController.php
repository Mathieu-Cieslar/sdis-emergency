<?php

namespace App\Controller;

use AllowDynamicProperties;
use App\Entity\Capteur;
use App\Entity\Caserne;
use App\Entity\Feu;
use App\Entity\Intervention;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;

#[AllowDynamicProperties]
class InterventionController extends AbstractController
{
    public function __construct(

    ) {
        $this->status = "ko";
    }

    #[Route(path: '/api/intervention', name: 'get_intervention', methods: "GET")]
    public function getAllIntervention(Request $request, EntityManagerInterface $em ): JsonResponse {
$data = $em->getRepository(Intervention::class)->findAll();
            return $this->json(
               $data
            );
    }


    #[Route(path: '/api/intervention', name: 'post_intervention', methods: "POST")]
    public function postInter(Request $request, EntityManagerInterface $em ): JsonResponse {
        $data = $request->toArray();
$intervention = new Intervention();
$feu = $em->getRepository(Feu::class)->findOneBy(['id' => $data['feu']['id']]);
$caserne = $em->getRepository(Caserne::class)->findOneBy(['id' => $data['caserne']['id']]);
$intervention->setFeu($feu);
$intervention->setCaserne($caserne);
$intervention->setDateIntervention(new \DateTime());
$intervention->setTrajet($data['trajet']);
$intervention->setTempsTrajet($data['tempsTrajet']);
        $em->persist($intervention);
        $em->flush();
        return $this->json(
            $data
        );
    }


}