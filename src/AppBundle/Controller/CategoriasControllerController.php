<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Categoria;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\{Request, Response};

class CategoriasControllerController extends Controller
{
    /**
     * @Route("/categorias", name="listar_categorias")
     */
    public function listarAction(): Response
    {
        $categorias = $this->getDoctrine()->getRepository('AppBundle:Categoria')->findBy([], ['nome' => 'asc']);
        return $this->render('categorias/listar.html.twig', ['categorias' => $categorias]);
    }

    /**
     * @Route("/categorias/remover", name="remover_categoria")
     */
    public function removerAction(Request $request): Response
    {
        $idCategoria = $request->request->get('id');
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getPartialReference(Categoria::class, ['id' => $idCategoria]);
        $em->remove($categoria);
        $em->flush();

        $this->addFlash('success', 'Categoria removida com sucesso');

        return $this->redirectToRoute('listar_categorias');
    }
}
