<?php

namespace App\Controller;

use App\Entity\ReservaSala;
use App\Repository\ReservaSalaRepository;
use App\Repository\SalaRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ReservaSalaController extends AbstractController
{
    #[Route('/verReservasSalas', name: 'app_reservasSalas')]
    public function index(ReservaSalaRepository $reservaSalaRepository): Response
    {
        $data = $reservaSalaRepository->findAll();
        return $this->render('reservasSalas.html.twig', [
            'data' => $data
        ]);
    }

    #[Route('/insertarReservaSala', name: 'app_insert_reservaSala')]
    public function insert(Request $request, ReservaSalaRepository $reservaSalaRepository, UsuarioRepository $usuarioRepository, SalaRepository $salaRepository): Response
    {
        if ($request->request->get('horario')) {
            $new = new ReservaSala();

            $usuario = $usuarioRepository->find($request->request->get('idUsuario'));
            $sala = $salaRepository->find($request->request->get('numeroSala'));
            $new->setHorario($request->request->get('horario'));
            $new->setFechaReserva($request->request->get('fechaReserva'));
            $new->setIdUsuario($usuario);
            $new->setIdSala($sala);

            $insertado = $reservaSalaRepository->save($new, true);

            $data = $reservaSalaRepository->findAll();
            return $this->redirectToRoute('app_reservasSalas', ['data' => $data]);
        } else {
            $usuarios = $usuarioRepository->findAll();
            $salas = $salaRepository->findAll();
            return $this->render('insertarReservaSala.html.twig', [
                'usuarios' => $usuarios,
                'salas' => $salas
            ]);
        }
    }

    #[Route('/actualizarReservaSala/{id}/{id2}/{fechaReserva}/{horario}', name: 'app_update_reservaSala')]
    public function update(EntityManagerInterface $em, Request $request, ReservaSalaRepository $reservaSalaRepository, UsuarioRepository $usuarioRepository, SalaRepository $salaRepository, string $id, string $id2, string $fechaReserva, string $horario): Response
    {
        if ($request->request->get('horario')) {

            $borrar = $reservaSalaRepository->findBy(array('idUsuario' => $id, 'idSala' => $id2, 'fechaReserva' => $fechaReserva, 'horario' => $horario));
            for ($i = 0; $i < count($borrar); $i++) {
                $em->getRepository(ReservaSala::class)->remove($borrar[$i], true);
            }
            $new = new ReservaSala();

            $usuario = $usuarioRepository->find($request->request->get('idUsuario'));
            $sala = $salaRepository->find($request->request->get('numeroSala'));
            $new->setHorario($request->request->get('horario'));
            $new->setFechaReserva($request->request->get('fechaReserva'));
            $new->setIdUsuario($usuario);
            $new->setIdSala($sala);

            $insertado = $reservaSalaRepository->save($new, true);

            $data = $reservaSalaRepository->findAll();
            return $this->redirectToRoute('app_reservasSalas', ['data' => $data]);
        } else {
            $usuarios = $usuarioRepository->findAll();
            $salas = $salaRepository->findAll();
            $buscados = $reservaSalaRepository->findBy(array('idUsuario' => $id, 'idSala' => $id2, 'fechaReserva' => $fechaReserva, 'horario' => $horario));
            for ($i = 0; $i < count($buscados); $i++){
                return $this->render('actualizarReservaSala.html.twig', [
                    'horario' => $buscados[$i]->getHorario(),
                    'fechaReserva' => $buscados[$i]->getFechaReserva(),
                    'idUsuario' => $buscados[$i]->getIdUsuario()->getId(),
                    'numeroSala' => $buscados[$i]->getIdSala()->getId(),
                    'usuarios' => $usuarios,
                    'salas' => $salas
                ]);
            }
        }
    }

    #[Route('/eliminarReservaSala/{id}/{id2}/{fechaReserva}/{horario}', name: 'app_delete_reservaSala')]
    public function delete(EntityManagerInterface $em, ReservaSalaRepository $reservaSalaRepository, string $id, string $id2, string $fechaReserva, string $horario): Response
    {
        $borrar = $reservaSalaRepository->findBy(array('idUsuario' => $id, 'idSala' => $id2, 'fechaReserva' => $fechaReserva, 'horario' => $horario));
        for ($i = 0; $i < count($borrar); $i++) {
            $em->getRepository(ReservaSala::class)->remove($borrar[$i], true);
        }

        $data = $reservaSalaRepository->findAll();
        return $this->redirectToRoute('app_reservasSalas', ['data' => $data]);
    }
}
