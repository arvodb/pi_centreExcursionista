<?php

namespace App\Controller;

use App\Entity\ReservaMaterial;
use App\Repository\MaterialRepository;
use App\Repository\ReservaMaterialRepository;
use App\Repository\TotalReservasRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ReservaMaterialController extends AbstractController
{
    #[Route('/verReservasMateriales', name: 'app_reservasMateriales')]
    public function index(ReservaMaterialRepository $reservaMaterialRepository): Response
    {
        $data = $reservaMaterialRepository->findAll();
        return $this->render('reservasMateriales.html.twig', [
            'data' => $data
        ]);
    }

    #[Route('/insertarReservaMaterial', name: 'app_insert_reservaMaterial')]
    public function insert(Request $request, ReservaMaterialRepository $reservaMaterialRepository, UsuarioRepository $usuarioRepository, MaterialRepository $materialRepository, TotalReservasRepository $totalReservasRepository): Response
    {
        if ($request->request->get('estado')) {

            $usuario = $usuarioRepository->find($request->request->get('idUsuario'));
            $material = $materialRepository->find($request->request->get('idMaterial'));
            $num = 0;

            $totales = $totalReservasRepository->findAll();
            for ($i = 0; $i < count($totales); $i++) {
                if ($material->getNombre() == $totales[$i]->getNombre()) {
                    $numTotal = $request->request->get('cantidad') + $totales[$i]->getTotal();
                    $totales[$i]->setTotal($numTotal);
                }
            }

            if ($request->request->get('estado') == "Reservado") {
                if ($material->getStock() == 0) {
                    $num = 0;
                } elseif ($material->getStock() < $request->request->get('cantidad')) {
                    $num = $material->getStock();
                    $material->setStock(0);
                } else {
                    $numFinal = $material->getStock() - $request->request->get('cantidad');
                    $material->setStock($numFinal);
                    $num = $request->request->get('cantidad');
                }
            } else {
                $numFinal2 = $material->getStock() + $request->request->get('cantidad');
                $material->setStock($numFinal2);
            }

            $new = new ReservaMaterial();

            $new->setCantidad($num);
            $new->setEstado($request->request->get('estado'));
            $new->setFechaReserva($request->request->get('fechaReserva'));
            $new->setFechaDevolucion(new DateTime($request->request->get('fechaDevolucion')));
            $new->setIdUsuario($usuario);
            $new->setIdMaterial($material);

            $insertado = $reservaMaterialRepository->save($new, true);


            $data = $reservaMaterialRepository->findAll();
            return $this->redirectToRoute('app_reservasMateriales', ['data' => $data]);
        } else {
            $usuarios = $usuarioRepository->findAll();
            $materiales = $materialRepository->findAll();
            return $this->render('insertarReservaMaterial.html.twig', [
                'usuarios' => $usuarios,
                'materiales' => $materiales
            ]);
        }
    }

    #[Route('/actualizarReservaMaterial/{id}/{id2}/{fechaReserva}', name: 'app_update_reservaMaterial')]
    public function update(EntityManagerInterface $em, Request $request, ReservaMaterialRepository $reservaMaterialRepository, UsuarioRepository $usuarioRepository, MaterialRepository $materialRepository, string $id, string $id2, string $fechaReserva): Response
    {
        if ($request->request->get('estado')) {

            $usuario = $usuarioRepository->find($request->request->get('idUsuario'));
            $material = $materialRepository->find($request->request->get('idMaterial'));
            $materialADevolver = $materialRepository->find($id2);
            $num = 0;
            $borrar = $reservaMaterialRepository->findBy(array('idUsuario' => $id, 'idMaterial' => $id2, 'fechaReserva' => $fechaReserva));

            for ($i = 0; $i < count($borrar); $i++) {
                if ($request->request->get('estado') == "Reservado") {
                    $cantidadADevolver = $borrar[$i]->getCantidad() + $material->getStock();
                    $materialADevolver->setStock($cantidadADevolver);

                    if ($material->getStock() == 0) {
                        $num = 0;
                    } elseif ($material->getStock() < $request->request->get('cantidad')) {
                        $num = $material->getStock();
                        $material->setStock(0);
                    } else {
                        $numFinal = $material->getStock() - $request->request->get('cantidad');
                        $material->setStock($numFinal);
                        $num = $request->request->get('cantidad');
                    }
                } else {
                    $numFinal2 = $material->getStock() + $request->request->get('cantidad');
                    $material->setStock($numFinal2);
                }
            }

            for ($i = 0; $i < count($borrar); $i++) {
                $em->getRepository(ReservaMaterial::class)->remove($borrar[$i], true);
            }

            $new = new ReservaMaterial();

            $new->setCantidad($num);
            $new->setEstado($request->request->get('estado'));
            $new->setFechaReserva($request->request->get('fechaReserva'));
            $new->setFechaDevolucion(new DateTime($request->request->get('fechaDevolucion')));
            $new->setIdUsuario($usuario);
            $new->setIdMaterial($material);

            $insertado = $reservaMaterialRepository->save($new, true);

            $data = $reservaMaterialRepository->findAll();
            return $this->redirectToRoute('app_reservasMateriales', ['data' => $data]);
        } else {
            $usuarios = $usuarioRepository->findAll();
            $materiales = $materialRepository->findAll();
            $buscados = $reservaMaterialRepository->findBy(array('idUsuario' => $id, 'idMaterial' => $id2, 'fechaReserva' => $fechaReserva));
            for ($i = 0; $i < count($buscados); $i++) {
                return $this->render('actualizarReservaMaterial.html.twig', [
                    'estado' => $buscados[$i]->getEstado(),
                    'fechaDevolucion' => $buscados[$i]->getFechaDevolucion(),
                    'cantidad' => $buscados[$i]->getCantidad(),
                    'fechaReserva' => $buscados[$i]->getFechaReserva(),
                    'idUsuario' => $buscados[$i]->getIdUsuario()->getId(),
                    'idMaterial' => $buscados[$i]->getIdMaterial()->getId(),
                    'usuarios' => $usuarios,
                    'materiales' => $materiales
                ]);
            }
        }
    }

    #[Route('/eliminarReservaMaterial/{id}/{id2}/{fechaReserva}', name: 'app_delete_reservaMaterial')]
    public function delete(EntityManagerInterface $em, ReservaMaterialRepository $reservaMaterialRepository, string $id, string $id2, string $fechaReserva): Response
    {
        $borrar = $reservaMaterialRepository->findBy(array('idUsuario' => $id, 'idMaterial' => $id2, 'fechaReserva' => $fechaReserva));
        for ($i = 0; $i < count($borrar); $i++) {
            $em->getRepository(ReservaMaterial::class)->remove($borrar[$i], true);
        }

        $data = $reservaMaterialRepository->findAll();
        return $this->redirectToRoute('app_reservasMateriales', ['data' => $data]);
    }
}
