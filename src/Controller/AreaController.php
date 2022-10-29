<?php

namespace App\Controller;

use App\Entity\Area;
use App\Repository\AreaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


class AreaController extends AbstractController
{
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
    public function PatchSingleArea(
        Request                $request,
        EntityManagerInterface $entityManager,
        AreaRepository         $areaRepository,
        int                    $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $updateArea = $areaRepository->find($id);
        if ($updateArea === null) {
            throw new NotFoundHttpException("Area pai nai vai");
        }
        $updateArea->setName($data['name']);

        $entityManager->flush();

        return $this->json($updateArea);
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
