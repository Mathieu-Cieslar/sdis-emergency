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
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
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


    #[Route(path: '/api/intervention/actif', name: 'get_intervention_actif', methods: "GET")]
    public function getInterventionActive(Request $request, EntityManagerInterface $em ): JsonResponse {
        $data = $em->getRepository(Intervention::class)->getInterWithActiveFeu();
        return $this->json(
            $data
        );
    }

    #[Route(path: '/api/intervention', name: 'post_intervention', methods: "POST")]
    public function postInter(Request $request, EntityManagerInterface $em,HubInterface $hub ): JsonResponse {
        $data = $request->toArray();
$intervention = new Intervention();
$feu = $em->getRepository(Feu::class)->findOneBy(['id' => $data['feu']['id']]);
$caserne = $em->getRepository(Caserne::class)->findOneBy(['id' => $data['caserne']['id']]);
$intervention->setFeu($feu);
$intervention->setCaserne($caserne);
$intervention->setCamion($caserne->getCamions()[0]);
$caserne->setNbCamion(0);
$now = new \DateTime("now");
$intervention->setDateIntervention($now);
$intervention->setTrajet($data['trajet']);
$intervention->setTempsTrajet($data['tempsTrajet']);
        $em->persist($intervention);
        $em->flush();


        // Créer un événement pour Mercure
        $update = new Update(
            'https://example.com/new-inter', // Sujet unique
            json_encode(['id' => $intervention->getId(), 'trajet' => $intervention->getTrajet(), 'tempsTrajet' => $intervention->getTempsTrajet(),"camion"=> $intervention->getCamion()->getId()])
        );
        // Envoyer l'événement au Hub Mercure
        $hub->publish($update);
        return $this->json(
            $data
        );
    }


}