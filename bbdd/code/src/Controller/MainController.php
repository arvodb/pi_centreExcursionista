<?php

namespace App\Controller;

use App\Repository\ReservaMaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ReservaMaterialRepository $reservaMaterialRepository): Response
    {
        $reservas = $reservaMaterialRepository->findAll();
        $fechaActual = date('Y/m/d');
        $actualizado = new DateTime();
        $actualizado->modify('+1 hours');
        $actualizado = $actualizado->format('d/m/Y H:i');
        $fechaActual = str_replace("/", "-", $fechaActual);
        $actualizado = str_replace("/", "-", $actualizado);
        

        return $this->render('index.html.twig', [
            'reservas' => $reservas,
            'fechaActual' => $fechaActual,
            'actualizado' => $actualizado
        ]);
    }
}
