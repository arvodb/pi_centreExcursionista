<?php

namespace App\Controller;

use App\Entity\TotalReservas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TotalReservasApiController extends AbstractController
{
    #[Route('/totalReservados', name: 'app_total_reservas_api')]
    public function index(EntityManagerInterface $em): Response
    {
        $reservas = $em->getRepository(TotalReservas::class)->findAll();
        $data = [];

        foreach ($reservas as $reserva) {
            $data[] = [
                "NOMBRE" => $reserva->getNombre(),
                "TOTAL" => $reserva->getTotal()
            ];
        }
        return $this->json([$data]);
    }
}
