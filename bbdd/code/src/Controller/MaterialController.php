<?php

namespace App\Controller;

use App\Entity\Material;
use App\Entity\ReservaMaterial;
use App\Repository\MaterialRepository;
use App\Repository\ReservaMaterialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MaterialController extends AbstractController
{
    #[Route('/verMateriales', name: 'app_materiales')]
    public function index(MaterialRepository $materialRepository): Response
    {
        $data = $materialRepository->findAll();
        return $this->render('materiales.html.twig', [
            'data' => $data
        ]);
    }

    #[Route('/insertarMaterial', name: 'app_insert_material')]
    public function insert(Request $request, MaterialRepository $materialRepository): Response
    {
        if ($request->request->get('nombre')) {
            $new = new Material();

            $new->setNombre($request->request->get('nombre'));
            $new->setStock($request->request->get('stock'));
            $new->setArmario($request->request->get('armario'));

            $insertado = $materialRepository->save($new, true);

            $data = $materialRepository->findAll();
            return $this->redirectToRoute('app_materiales', ['data' => $data]);
        } else{
            return $this->render('insertarMaterial.html.twig', [
                'name' => 'List',
            ]);
        }
    }

    #[Route('/actualizarMaterial/{id}', name: 'app_update_material')]
    public function update(Request $request, MaterialRepository $materialRepository, string $id): Response
    {
        if ($request->request->get('nombre')) {
            $borrar = $materialRepository->find($id);
            $borrado = $materialRepository->remove($borrar, true);
            $new = new Material();

            $new->setNombre($request->request->get('nombre'));
            $new->setStock($request->request->get('stock'));
            $new->setArmario($request->request->get('armario'));

            $insertado = $materialRepository->save($new, true);

            $data = $materialRepository->findAll();
            return $this->redirectToRoute('app_materiales', ['data' => $data]);
        } else {
            $buscado = $materialRepository->find($id);
            return $this->render('actualizarMaterial.html.twig', [
                'nombre' => $buscado->getNombre(),
                'stock' => $buscado->getStock(),
                'armario' => $buscado->getArmario()
            ]);
        }
    }

    #[Route('/eliminarMaterial/{id}', name: 'app_delete_material')]
    public function delete(EntityManagerInterface $em, MaterialRepository $materialRepository, ReservaMaterialRepository $reservaMaterialRepository, string $id): Response
    {
        $borrar = $reservaMaterialRepository->findBy(array('idMaterial' => $id));
        for ($i = 0; $i < count($borrar); $i++) {
            $em->getRepository(ReservaMaterial::class)->remove($borrar[$i], true);
        }

        $material = $materialRepository->find($id);
        $borrado = $materialRepository->remove($material, true);
        $data = $materialRepository->findAll();
        return $this->redirectToRoute('app_materiales', ['data' => $data]);
    }
}
