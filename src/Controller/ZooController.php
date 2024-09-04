<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/zoo', name: 'app_api_zoo_')]
class ZooController extends AbstractController
{
    
    public function __construct(private EntityManagerInterface $manager, private ZooRepository $repository)
    {
    }

    #[Route(name: 'new', methods: 'POST')]
    public function new(): Response
    {
        $zoo = new Zoo();
        $zoo->setName('Zoo_Argenta');
        $zoo->setDescription('Des animaux fantastiques à découvrir');
        $zoo->setCreatedAt(new DateTimeImmutable());

        // Tell Doctrine you want to (eventually) save the restaurant (no queries yet)
        $this->manager->persist($zoo);
        // Actually executes the queries (i.e. the INSERT query)
        $this->manager->flush();

        return $this->json(
            ['message' => "Zoo resource created with {$zoo->getId()} id"],
            Response::HTTP_CREATED,
        );
    }
    #[Route('/{id}', name: 'show', methods: 'GET')]
    public function show(int $id): Response
    {
        $zoo = $this->repository->findOneBy(['id' => $id]);

        if (!$zoo) {
            throw $this->createNotFoundException("No Zoo found for {$id} id");
        }

        return $this->json(
            ['message' => "A Zoo was found : {$zoo->getName()} for {$zoo->getId()} id"]
        );
    } 
    #[Route('/{id}', name: 'edit', methods: 'PUT')]
    public function edit(int $id): Response
    {
        $zoo = $this->repository->findOneBy(['id' => $id]);

        if (!$zoo) {
            throw $this->createNotFoundException("No Zoo found for {$id} id");
        }

        $zoo->setName('Zoo name updated');
        $this->manager->flush();

        return $this->redirectToRoute('app_api_zoo_show', ['id' => $zoo->getId()]);
    }
    #[Route('/{id}', name: 'delete', methods: 'DELETE')]
    public function delete(int $id): Response
    {
        $zoo = $this->repository->findOneBy(['id' => $id]);
        if (!$zoo) {
            throw $this->createNotFoundException("No Zoo found for {$id} id");
        }

        $this->manager->remove($zoo);
        $this->manager->flush();

        return $this->json(['message' => "Zoo resource deleted"], Response::HTTP_NO_CONTENT);
    }





}
