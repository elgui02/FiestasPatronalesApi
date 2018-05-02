<?php

namespace Tipsa\FiestasBundle\Controller;

use Tipsa\FiestasBundle\Entity\Departamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Departamento controller.
 *
 * @Route("departamento")
 */
class DepartamentoController extends Controller
{
    /**
     * Lists all departamento entities.
     *
     * @Route("/", name="departamento_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $departamentos = $em->getRepository('FiestasBundle:Departamento')->findAll();

        return $this->render('departamento/index.html.twig', array(
            'departamentos' => $departamentos,
        ));
    }

    /**
     * Creates a new departamento entity.
     *
     * @Route("/new", name="departamento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $departamento = new Departamento();
        $form = $this->createForm('Tipsa\FiestasBundle\Form\DepartamentoType', $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departamento);
            $em->flush();

            return $this->redirectToRoute('departamento_show', array('id' => $departamento->getId()));
        }

        return $this->render('departamento/new.html.twig', array(
            'departamento' => $departamento,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a departamento entity.
     *
     * @Route("/{id}", name="departamento_show")
     * @Method("GET")
     */
    public function showAction(Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);

        return $this->render('departamento/show.html.twig', array(
            'departamento' => $departamento,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing departamento entity.
     *
     * @Route("/{id}/edit", name="departamento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Departamento $departamento)
    {
        $deleteForm = $this->createDeleteForm($departamento);
        $editForm = $this->createForm('Tipsa\FiestasBundle\Form\DepartamentoType', $departamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('departamento_edit', array('id' => $departamento->getId()));
        }

        return $this->render('departamento/edit.html.twig', array(
            'departamento' => $departamento,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a departamento entity.
     *
     * @Route("/{id}", name="departamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Departamento $departamento)
    {
        $form = $this->createDeleteForm($departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departamento);
            $em->flush();
        }

        return $this->redirectToRoute('departamento_index');
    }

    /**
     * Creates a form to delete a departamento entity.
     *
     * @param Departamento $departamento The departamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Departamento $departamento)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('departamento_delete', array('id' => $departamento->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
