<?php

namespace App\Controller;

use App\Entity\ReservaMaterial;
use App\Repository\MaterialRepository;
use App\Repository\UsuarioRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ReservaMaterialApiController extends AbstractController
{
    #[Route('/reservaMaterial', name: 'reservaMaterial_crud_get_all', methods: ['GET'])]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $reservas = $em->getRepository(ReservaMaterial::class)->findAll();
        $data = [];

        foreach ($reservas as $reserva) {
            $data[] = [
                "USUARIO_NOMBRE" => $reserva->getIdUsuario()->getNombreUsuario(),
                "MATERIAL_NOMBRE" => $reserva->getIdMaterial()->getNombre(),
                "CANTIDAD" => $reserva->getCantidad(),
                "ESTADO" => $reserva->getEstado(),
                "FECHA_RESERVA" => date('d/m/Y', strtotime($reserva->getFechaReserva())),
                "FECHA_DEVOLUCION" => $reserva->getFechaDevolucion()->format('d/m/Y')
            ];
        }
        $result = ['reservas' => $data];
        return $this->json($result);
    }

/*     #[Route('/reservaMaterial/{id}/{id2}/{fecha}', name: 'reservaMaterial_crud_get', methods: ['GET'])]
    public function index2(int $id, int $id2, String $fecha, EntityManagerInterface $em): JsonResponse
    {
        $reservas = $em->getRepository(ReservaMaterial::class)->findAll();
        foreach ($reservas as $reserva) {
            $fechaBuena = date('d/m/Y', strtotime($reserva->getFechaReserva()));
            $fecha = str_replace("-","/",$fecha);
            if ($reserva->getIdUsuario()->getId() == $id && $reserva->getIdMaterial()->getId() == $id2 && $fechaBuena  == $fecha) {
                $data = [
                    "USUARIO_NOMBRE" => $reserva->getIdUsuario()->getNombreUsuario(),
                    "MATERIAL_NOMBRE" => $reserva->getIdMaterial()->getNombre(),
                    "CANTIDAD" => $reserva->getCantidad(),
                    "ESTADO" => $reserva->getEstado(),
                    "FECHA_RESERVA" => $fechaBuena,
                    "FECHA_DEVOLUCION" => $reserva->getFechaDevolucion()->format('d/m/Y')
                ];
                return $this->json([$data]);
            }
        }
    } */

    #[Route('/reservaMaterial', name: 'reservaMaterial_crud_post', methods: ['POST'])]
    public function index3(Request $request, EntityManagerInterface $em, UsuarioRepository $usuarioRepository, MaterialRepository $materialRepository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $usuarioId = $usuarioRepository->find($data["USUARIO_ID"]);
        $materialId = $materialRepository->find($data["MATERIAL_ID"]);
        $fechaDevolucion = new DateTimeImmutable($data['FECHA_DEVOLUCION']);
        $newReserva = new ReservaMaterial();
        $newReserva
            ->setCantidad($data['CANTIDAD'])
            ->setEstado($data['ESTADO'])
            ->setFechaReserva($data['FECHA_RESERVA'])
            ->setFechaDevolucion($fechaDevolucion);
        $newReserva->setIdUsuario($usuarioId);
        $newReserva->setIdMaterial($materialId);
        $em->getRepository(ReservaMaterial::class)->save($newReserva, true);
        return $this->json([
            'message' => "Insertado correctamente."
        ]);
    }

    #[Route('/reservaMaterial/{id}/{id2}/{fecha}', name: 'reservaMaterial_crud_delete', methods: ['DELETE'])]
    public function index4(int $id, int $id2, String $fecha, EntityManagerInterface $em): JsonResponse
    {
        $reservas = $em->getRepository(ReservaMaterial::class)->findAll();
        
        foreach ($reservas as $reserva) {
            
            $fechaBuena = date('d/m/Y', strtotime($reserva->getFechaReserva()));
            $fecha = str_replace("-","/",$fecha);
            if ($reserva->getIdUsuario()->getId() == $id && $reserva->getIdMaterial()->getId() == $id2 && $fechaBuena  == $fecha) {
                $em->getRepository(ReservaMaterial::class)->remove($reserva, true);
                return $this->json([
                    'message' => "Borrado correctamente."
                ]);
            }
        }
    }

    #[Route('/reservaMaterial/{id}/{id2}/{fecha}', name: 'reservaMaterial_crud_put', methods: ['PUT'])]
    public function index5(int $id, int $id2, String $fecha, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $reservas = $em->getRepository(ReservaMaterial::class)->findAll();
        foreach ($reservas as $reserva) {
            $fechaBuena = date('d/m/Y', strtotime($reserva->getFechaReserva()));
            $fecha = str_replace("-","/",$fecha);
            if ($reserva->getIdUsuario()->getId() == $id && $reserva->getIdMaterial()->getId() == $id2 && $fechaBuena == $fecha) {
                $data = json_decode($request->getContent(), true);
                $fechaDevolucion = new DateTimeImmutable($data['FECHA_DEVOLUCION']);
                $reserva
                    ->setCantidad($data['CANTIDAD'])
                    ->setEstado($data['ESTADO'])
                    ->setFechaDevolucion($fechaDevolucion);
                $em->getRepository(ReservaMaterial::class)->save($reserva, true);
                return $this->json([
                    'message' => "Actualizado correctamente."
                ]);
            }
        }
    }
}
