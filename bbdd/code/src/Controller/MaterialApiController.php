<?php

namespace App\Controller;

use App\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class MaterialApiController extends AbstractController
{
    #[Route('/materiales', name: 'material_crud_get_all', methods: ['GET'])]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $materiales = $em->getRepository(Material::class)->findAll();
        $data = [];

        foreach ($materiales as $material) {
            $data[] = [
                "ID" => $material->getId(),
                "NOMBRE" => $material->getNombre(),
                "STOCK" => $material->getStock(),
                "ARMARIO" => $material->getArmario()
            ];
        }
        $result = ['materials' => $data];
        return $this->json($result);
    }

    #[Route('/materiales/{id}', name: 'material_crud_get', methods: ['GET'])]
    public function index2(int $id, EntityManagerInterface $em): JsonResponse
    {
        $material = $em->getRepository(Material::class)->find($id);
        $data = [
            "ID" => $material->getId(),
            "NOMBRE" => $material->getNombre(),
            "STOCK" => $material->getStock(),
            "ARMARIO" => $material->getArmario()
        ];
        return $this->json([$data]);
    }

    #[Route('/materiales', name: 'material_crud_post', methods: ['POST'])]
    public function index3(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $newMaterial = new Material();
        $newMaterial
            ->setNombre($data['NOMBRE'])
            ->setStock($data['STOCK'])
            ->setArmario($data['ARMARIO']);
        $em->getRepository(Material::class)->save($newMaterial, true);
        return $this->json([
            'message' => "Insertado correctamente."
        ]);
    }

    #[Route('/materiales/{id}', name: 'material_crud_delete', methods: ['DELETE'])]
    public function index4(int $id, EntityManagerInterface $em): JsonResponse
    {
        $material = $em->getRepository(Material::class)->find($id);
        $em->getRepository(Material::class)->remove($material, true);
        return $this->json([
            'message' => "Borrado correctamente."
        ]);
    }

    #[Route('/materiales/{id}', name: 'material_crud_put', methods: ['PUT'])]
    public function index5(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $material = $em->getRepository(Material::class)->find($id);

        $material
            ->setNombre($data['NOMBRE'])
            ->setStock($data['STOCK'])
            ->setArmario($data['ARMARIO']);
        $em->getRepository(Material::class)->save($material, true);
        return $this->json([
            'message' => "Actualizado correctamente."
        ]);
    }
}
