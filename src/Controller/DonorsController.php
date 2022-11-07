<?php

namespace App\Controller;

use App\Entity\Donor;
use App\Repository\AreaRepository;
use App\Repository\DonorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DonorsController extends AbstractController
{
    private ValidatorInterface $validator;
    private SerializerInterface $serializer;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer)
    {
        $this->validator = $validator;
        $this->serializer = $serializer;
    }

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
    public function createDonor(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): JsonResponse
    {

        /** @var Donor $donor */
        $donor = $this->serializer->deserialize($request->getContent(), Donor::class, 'json');


        $violations = $this->validator->validate($donor);
        if ($violations->count() > 0) {
            return $this->json($violations, Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        $entityManager->persist($donor);
        $entityManager->flush();


        //Send Email when user Create
        $name = $donor->getName();
        $email = $donor->getMail();

        $text = <<<Body
Hello $name;

Thank you for singing up to bloodBank!
Body;
        $email = (new Email())
            ->from('support@bloodbank.com')
            ->to($email)
            ->subject('Welcome to BloodBank!')
            ->text($text);


        $mailer->send($email);

        return $this->json($donor);
    }


    #[Route('/donors/{id}', methods: ['PUT'])]
    public function updateDonor(
        Donor                  $donor,
        Request                $request,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {

        $donor = $this->serializer->deserialize($request->getContent(), Donor::class, 'json', [
            AbstractNormalizer::OBJECT_TO_POPULATE => $donor,
        ]);

        $violations = $this->validator->validate($donor);
        if ($violations->count() > 0) {
            return $this->json($violations, Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        $entityManager->flush();

        return $this->json($donor);
    }


    #[Route('/donors/{id}', methods: ['DELETE'])]
    public function deleteDonorArea(
        DonorRepository        $donorRepository,
        EntityManagerInterface $entityManager, int $id
    ): Response
    {
        $removeDonor = $donorRepository->find($id);

        $entityManager->remove($removeDonor);
        $entityManager->flush();

        return new Response('', 204);
    }


}



