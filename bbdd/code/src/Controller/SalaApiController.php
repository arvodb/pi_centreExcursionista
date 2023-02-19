<?php

namespace App\Controller;

use App\Entity\Sala;
use App\Repository\UsuarioRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class SalaApiController extends AbstractController
{
    #[Route('/salas', name: 'sala_crud_get_all', methods: ['GET'])]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $salas = $em->getRepository(Sala::class)->findAll();
        $data = [];

        foreach ($salas as $sala) {
            $data[] = [
                "NUMERO_SALA" => $sala->getId()
            ];
        }
        return $this->json([$data]);
    }

    #[Route('/salas/{id}', name: 'sala_crud_get', methods: ['GET'])]
    public function index2(int $id, EntityManagerInterface $em): JsonResponse
    {
        $sala = $em->getRepository(Sala::class)->find($id);
        $data = [
            "NUMERO_SALA" => $sala->getId()
        ];
        return $this->json([$data]);
    }

    #[Route('/salas', name: 'sala_crud_post', methods: ['POST'])]
    public function index3(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $newSala = new Sala();
        $newSala
            ->setId($data['NUMERO_SALA']);
        $em->getRepository(Sala::class)->save($newSala, true);
        return $this->json([
            'message' => "Insertado correctamente."
        ]);
    }

    #[Route('/salas/{id}', name: 'sala_crud_delete', methods: ['DELETE'])]
    public function index4(int $id, EntityManagerInterface $em): JsonResponse
    {
        $sala = $em->getRepository(Sala::class)->find($id);
        $em->getRepository(Sala::class)->remove($sala, true);
        return $this->json([
            'message' => "Borrado correctamente."
        ]);
    }
}
