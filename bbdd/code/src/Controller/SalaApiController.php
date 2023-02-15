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
                "NOMBRE_SALA" => $sala->getId(),
                "ESTADO" => $sala->getEstado(),
                "FECHA_RESERVA" => $sala->getFechaReserva()->format('d/m/Y H:i'),
                "USUARIO_NOMBRE" => $sala->getIdUsuario()->getNombreUsuario()
            ];
        }
        return $this->json([$data]);
    }

    #[Route('/salas/{id}', name: 'sala_crud_get', methods: ['GET'])]
    public function index2(int $id, EntityManagerInterface $em): JsonResponse
    {
        $sala = $em->getRepository(Sala::class)->find($id);
        $data = [
            "NOMBRE_SALA" => $sala->getID(),
            "ESTADO" => $sala->getEstado(),
            "FECHA_RESERVA" => $sala->getFechaReserva()->format('d/m/Y H:i'),
            "USUARIO_NOMBRE" => $sala->getIdUsuario()->getNombreUsuario()
        ];
        return $this->json([$data]);
    }

    #[Route('/salas', name: 'sala_crud_post', methods: ['POST'])]
    public function index3(Request $request, EntityManagerInterface $em, UsuarioRepository $usuarioRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $usuarioId = $usuarioRepository->find($data["USUARIO_ID"]);
        $newSala = new Sala();
        if($data['FECHA_RESERVA'] !== ""){
            $fecha = new DateTimeImmutable($data['FECHA_RESERVA']);
            $newSala->setFechaReserva($fecha);
        }
        $newSala
            ->setId($data['NOMBRE_SALA'])
            ->setEstado($data['ESTADO']);
        $newSala->setIdUsuario($usuarioId);
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

    #[Route('/salas/{id}', name: 'sala_crud_put', methods: ['PUT'])]
    public function index5(int $id, Request $request, EntityManagerInterface $em, UsuarioRepository $usuarioRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $sala = $em->getRepository(Sala::class)->find($id);
        if($data['FECHA_RESERVA'] !== ""){
            $fecha = new DateTimeImmutable($data['FECHA_RESERVA']);
            $sala->setFechaReserva($fecha);
        }
        $usuarioId = $usuarioRepository->find($data["USUARIO_ID"]);
        $sala
            ->setId($data['NOMBRE_SALA'])
            ->setEstado($data['ESTADO'])
            ->setFechaReserva($fecha);
        $sala->setIdUsuario($usuarioId);
        $em->getRepository(Sala::class)->save($sala, true);
        return $this->json([
            'message' => "Actualizado correctamente."
        ]);
    }
}
