<?php

namespace App\Controller;

use App\Entity\Donor;
use App\Repository\AreaRepository;
use App\Repository\DonorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DonorsController extends AbstractController
{

    #[Route('/donors', methods: ['GET'])]
    public function getAllDonors(DonorRepository $donorRepository): JsonResponse
    {
        $donors = $donorRepository->findAll();

        return $this->json($donors);
    }

    #[Route('/donors/{id}', methods: ['GET'])]
    public function getSingleDonor(DonorRepository $donorRepository, int $id): JsonResponse
    {
        $singleDonor = $donorRepository->find($id);

        return $this->json($singleDonor);
    }


    #[Route('/donors', methods: ['POST'])]
    public function createDonor(Request $request, EntityManagerInterface $entityManager, AreaRepository $areaRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $donor = new Donor();

        dump($data, $data['area']);

        $donor->setBloodGroup($data['bloodGroup']);
        $donor->setName($data['name']);
        $donor->setMobile($data['mobile']);
        $donor->setMail($data['mail']);
        $donor->setLastDonateDate($data['lastDonateDate']);
        $donor->setNumberOfDonation($data['numberOfDonation']);
        $donor->setProfilePicture($data['profilePicture']);

        $area = $areaRepository ->find($data['area']);

        $donor->setArea($area);

        $entityManager->persist($donor);
        $entityManager->flush();

        return $this->json($donor);
    }





}



