<?php

namespace App\Controller;

use App\Entity\ReservaMaterial;
use App\Entity\ReservaSala;
use App\Entity\Usuario;
use App\Repository\ReservaMaterialRepository;
use App\Repository\ReservaSalaRepository;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UsuariosController extends AbstractController
{

    #[Route('/verUsuarios', name: 'app_usuarios')]
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        $data = $usuarioRepository->findAll();
        return $this->render('usuarios.html.twig', [
            'data' => $data
        ]);
    }

    #[Route('/insertarUsuario', name: 'app_insert_usuario')]
    public function insert(Request $request, UsuarioRepository $usuarioRepository): Response
    {
        if ($request->request->get('nombre')) {
            $new = new Usuario();

            $new->setNombreUsuario($request->request->get('nombre'));
            $new->setContrasena($request->request->get('contrasena'));
            $new->setCorreo($request->request->get('correo'));
            $new->setPrivilegio($request->request->get('privilegio'));

            $insertado = $usuarioRepository->save($new, true);

            $data = $usuarioRepository->findAll();
            return $this->redirectToRoute('app_usuarios', ['data' => $data]);
        } else{
            return $this->render('insertarUsuario.html.twig', [
                'name' => 'List',
            ]);
        }
    }

    #[Route('/actualizarUsuario/{id}', name: 'app_update_usuario')]
    public function update(Request $request, UsuarioRepository $usuarioRepository, string $id): Response
    {
        if ($request->request->get('nombre')) {
            $borrar = $usuarioRepository->find($id);
            $borrado = $usuarioRepository->remove($borrar, true);
            $new = new Usuario();

            $new->setNombreUsuario($request->request->get('nombre'));
            $new->setContrasena($request->request->get('contrasena'));
            $new->setCorreo($request->request->get('correo'));
            $new->setPrivilegio($request->request->get('privilegio'));

            $insertado = $usuarioRepository->save($new, true);

            $data = $usuarioRepository->findAll();
            return $this->redirectToRoute('app_usuarios', ['data' => $data]);
        } else {
            $buscado = $usuarioRepository->find($id);
            return $this->render('actualizarUsuario.html.twig', [
                'nombre' => $buscado->getNombreUsuario(),
                'contrasena' => $buscado->getContrasena(),
                'correo' => $buscado->getCorreo(),
                'privilegio' => $buscado->getPrivilegio()
            ]);
        }
    }

    #[Route('/eliminarUsuario/{id}', name: 'app_delete_usuario')]
    public function delete(EntityManagerInterface $em, UsuarioRepository $usuarioRepository, ReservaSalaRepository $reservaSalaRepository, ReservaMaterialRepository $reservaMaterialRepository,string $id): Response
    {
        $borrar = $reservaSalaRepository->findBy(array('idUsuario' => $id));
        for ($i = 0; $i < count($borrar); $i++) {
            $em->getRepository(ReservaSala::class)->remove($borrar[$i], true);
        }

        $borrar2 = $reservaMaterialRepository->findBy(array('idUsuario' => $id));
        for ($i = 0; $i < count($borrar2); $i++) {
            $em->getRepository(ReservaMaterial::class)->remove($borrar2[$i], true);
        }
        $usuario = $usuarioRepository->find($id);
        $borrado = $usuarioRepository->remove($usuario, true);
        $data = $usuarioRepository->findAll();
        return $this->redirectToRoute('app_usuarios', ['data' => $data]);
    }
}
