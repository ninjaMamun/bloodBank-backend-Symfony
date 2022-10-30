<?php

namespace App\Controller;

use App\Entity\Area;
use App\Entity\Donor;
use App\Repository\AreaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class AreaController extends AbstractController
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }


    #[Route('/areas', methods: ['GET'])]
    public function getAllArea(AreaRepository $areaRepository): JsonResponse
    {
        $areas = $areaRepository->findAll();

        return $this->json($areas);
    }


    #[Route('/areas/{id}', methods: ['GET'])]
    public function getSingleArea(AreaRepository $areaRepository, int $id): JsonResponse
    {
        $singleAreas = $areaRepository->find($id);
        return $this->json($singleAreas);
    }



    #[Route('/areas', methods: ['POST'])]
    public function createArea(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $area = new Area();
        $area->setName($data['name']);
        $entityManager->persist($area);
        $entityManager->flush();

        return $this->json($area);
    }



    #[Route('/areas/{id}', methods: ['PUT'])]
    public function PutSingleArea(
        Request                $request,
        EntityManagerInterface $entityManager,
        Area                   $area): JsonResponse
    {
        $area = $this->serializer->deserialize($request->getContent(), Area::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $area,
        ]);

        $violations = $this->validator->validate($area);
        if ($violations->count() > 0) {
            return $this->json($violations, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $entityManager->flush();

        return $this->json($area);
    }



    #[Route('/areas/{id}', methods: ['DELETE'])]
    public function deleteSingleArea(
        AreaRepository         $areaRepository,
        EntityManagerInterface $entityManager, int $id
    ): Response
    {
        $removeArea = $areaRepository->find($id);

        $entityManager->remove($removeArea);
        $entityManager->flush();

        return new Response('', 204);
    }

}
