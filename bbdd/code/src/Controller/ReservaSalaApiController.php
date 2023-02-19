<?php

namespace App\Controller;

use App\Entity\ReservaSala;
use App\Repository\SalaRepository;
use App\Repository\UsuarioRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ReservaSalaApiController extends AbstractController
{
    #[Route('/reservaSala', name: 'reservaSala_crud_get_all', methods: ['GET'])]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $reservas = $em->getRepository(ReservaSala::class)->findAll();
        $data = [];

        foreach ($reservas as $reserva) {
            $data[] = [
                "USUARIO_NOMBRE" => $reserva->getIdUsuario()->getNombreUsuario(),
                "NUMERO_SALA" => $reserva->getIdSala()->getId(),
                "HORARIO" => $reserva->getHorario(),
                "FECHA_RESERVA" => date('d/m/Y', strtotime($reserva->getFechaReserva())),
            ];
        }
        $result = ['reservas' => $data];
        return $this->json($result);
    }

    #[Route('/reservaSala/{id}/{id2}/{fecha}/{horario}', name: 'reservaSala_crud_get', methods: ['GET'])]
    public function index2(int $id, int $id2, String $fecha, string $horario, EntityManagerInterface $em): JsonResponse
    {
        $reservas = $em->getRepository(ReservaSala::class)->findAll();
        foreach ($reservas as $reserva) {
            $fechaBuena = date('d/m/Y', strtotime($reserva->getFechaReserva()));
            $fecha = str_replace("-", "/", $fecha);
            if ($reserva->getIdUsuario()->getId() == $id && $reserva->getIdSala()->getId() == $id2 && $fechaBuena == $fecha && $reserva->getHorario() == $horario) {
                $data = [
                    "USUARIO_NOMBRE" => $reserva->getIdUsuario()->getNombreUsuario(),
                    "NUMERO_SALA" => $reserva->getIdSala()->getId(),
                    "HORARIO" => $reserva->getHorario(),
                    "FECHA_RESERVA" => date('d/m/Y', strtotime($reserva->getFechaReserva())),
                ];
                return $this->json([$data]);
            }
        }
    }

    #[Route('/reservaSala', name: 'reservaSala_crud_post', methods: ['POST'])]
    public function index3(Request $request, EntityManagerInterface $em, UsuarioRepository $usuarioRepository, SalaRepository $salaRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $usuarioId = $usuarioRepository->find($data["USUARIO_ID"]);
        $salaId = $salaRepository->find($data["NUMERO_SALA"]);
        $newReserva = new ReservaSala();
        $newReserva
            ->setHorario($data['HORARIO'])
            ->setFechaReserva($data['FECHA_RESERVA']);
        $newReserva->setIdUsuario($usuarioId);
        $newReserva->setIdSala($salaId);
        $em->getRepository(ReservaSala::class)->save($newReserva, true);
        return $this->json([
            'message' => "Insertado correctamente."
        ]);
    }

    #[Route('/reservaSala/{id}/{id2}/{fecha}/{horario}', name: 'reservaSala_crud_delete', methods: ['DELETE'])]
    public function index4(int $id, int $id2, String $fecha, String $horario, EntityManagerInterface $em): JsonResponse
    {
        $reservas = $em->getRepository(ReservaSala::class)->findAll();

        foreach ($reservas as $reserva) {

            $fechaBuena = date('d/m/Y', strtotime($reserva->getFechaReserva()));
            $fecha = str_replace("-", "/", $fecha);
            if ($reserva->getIdUsuario()->getId() == $id && $reserva->getIdSala()->getId() == $id2 && $fechaBuena  == $fecha && $reserva->getHorario() == $horario) {
                $em->getRepository(ReservaSala::class)->remove($reserva, true);
                return $this->json([
                    'message' => "Borrado correctamente."
                ]);
            }
        }
    }
}
