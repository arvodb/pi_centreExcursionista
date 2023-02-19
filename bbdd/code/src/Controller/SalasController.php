<?php

namespace App\Controller;

use App\Entity\ReservaSala;
use App\Entity\Sala;
use App\Repository\ReservaSalaRepository;
use App\Repository\SalaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SalasController extends AbstractController
{
    #[Route('/verSalas', name: 'app_salas')]
    public function index(SalaRepository $salaRepository): Response
    {
        $data = $salaRepository->findAll();
        return $this->render('salas.html.twig', [
            'data' => $data
        ]);
    }

    #[Route('/insertarSala', name: 'app_insert_sala')]
    public function insert(Request $request, SalaRepository $salaRepository): Response
    {
        if ($request->request->get('numeroSala')) {
            $new = new Sala();

            $new->setId($request->request->get('numeroSala'));

            $insertado = $salaRepository->save($new, true);

            $data = $salaRepository->findAll();
            return $this->redirectToRoute('app_salas', ['data' => $data]);
        } else{
            return $this->render('insertarSala.html.twig', [
                'name' => 'List',
            ]);
        }
    }

    #[Route('/actualizarSala/{id}', name: 'app_update_sala')]
    public function update(Request $request, SalaRepository $salaRepository, string $id): Response
    {
        if ($request->request->get('numeroSala')) {
            $borrar = $salaRepository->find($id);
            $borrado = $salaRepository->remove($borrar, true);
            $new = new Sala();

            $new->setId($request->request->get('numeroSala'));

            $insertado = $salaRepository->save($new, true);

            $data = $salaRepository->findAll();
            return $this->redirectToRoute('app_salas', ['data' => $data]);
        } else {
            $buscado = $salaRepository->find($id);
            return $this->render('actualizarSala.html.twig', [
                'numeroSala' => $buscado->getId()
            ]);
        }
    }

    #[Route('/eliminarSala/{id}', name: 'app_delete_sala')]
    public function delete(EntityManagerInterface $em, SalaRepository $salaRepository, ReservaSalaRepository $reservaSalaRepository, string $id): Response
    {
        $borrar = $reservaSalaRepository->findBy(array('idSala' => $id));
        for ($i = 0; $i < count($borrar); $i++) {
            $em->getRepository(ReservaSala::class)->remove($borrar[$i], true);
        }

        $sala = $salaRepository->find($id);
        $borrado = $salaRepository->remove($sala, true);
        $data = $salaRepository->findAll();
        return $this->redirectToRoute('app_salas', ['data' => $data]);
    }
}
