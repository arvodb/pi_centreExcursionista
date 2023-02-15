<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UsuarioApiController extends AbstractController
{
    #[Route('/usuarios', name: 'usuario_crud_get_all', methods: ['GET'])]
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $usuarios = $em->getRepository(Usuario::class)->findAll();
        $data = [];

        foreach ($usuarios as $usurio) {
            $data[] = [
                "ID" => $usurio->getId(),
                "NOMBRE_USUARIO" => $usurio->getNombreUsuario(),
                "CONTRASEÑA" => $usurio->getContrasena(),
                "CORREO" => $usurio->getCorreo(),
                "PRIVILEGIO" => $usurio->getPrivilegio()
            ];
        }
        $response = [ 'result' => $data ];
        return $this->json($response );
    }

    #[Route('/usuarios/{id}', name: 'usuario_crud_get', methods: ['GET'])]
    public function index2(int $id, EntityManagerInterface $em): JsonResponse
    {
        $usuario = $em->getRepository(Usuario::class)->find($id);
        $data = [
            "ID" => $usuario->getId(),
            "NOMBRE_USUARIO" => $usuario->getNombreUsuario(),
            "CONTRASEÑA" => $usuario->getContrasena(),
            "CORREO" => $usuario->getCorreo(),
            "PRIVILEGIO" => $usuario->getPrivilegio()
        ];
        return $this->json($data);
    }

    #[Route('/usuarios', name: 'usuario_crud_post', methods: ['POST'])]
    public function index3(Request $request, EntityManagerInterface $em): JsonResponse
    {

        $data = json_decode($request->getContent(), true);
        $newUsuario = new Usuario();
        $newUsuario
            ->setNombreUsuario($data['NOMBRE_USUARIO'])
            ->setContrasena($data['CONTRASEÑA'])
            ->setCorreo($data['CORREO'])
            ->setPrivilegio($data['PRIVILEGIO']);
        $em->getRepository(Usuario::class)->save($newUsuario, true);
        return $this->json([
            'message' => "Insertado correctamente."
        ]);
    }

    #[Route('/usuarios/{id}', name: 'usuario_crud_delete', methods: ['DELETE'])]
    public function index4(int $id, EntityManagerInterface $em): JsonResponse
    {
        $usuario = $em->getRepository(Usuario::class)->find($id);
        $em->getRepository(Usuario::class)->remove($usuario, true);
        return $this->json([
            'message' => "Borrado correctamente."
        ]);
    }

    #[Route('/usuarios/{id}', name: 'usuario_crud_put', methods: ['PUT'])]
    public function index5(int $id, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $usuario = $em->getRepository(Usuario::class)->find($id);

        $usuario
            ->setNombreUsuario($data['NOMBRE_USUARIO'])
            ->setContrasena($data['CONTRASEÑA'])
            ->setCorreo($data['CORREO'])
            ->setPrivilegio($data['PRIVILEGIO']);
        $em->getRepository(Usuario::class)->save($usuario, true);
        return $this->json([
            'message' => "Actualizado correctamente."
        ]);
    }
}
