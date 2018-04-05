<?php

namespace Tipsa\FiestasBundle\Controller;

use Tipsa\FiestasBundle\Entity\FiestaPatronal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Fiestapatronal controller.
 *
 * @Route("fiestapatronal")
 */
class FiestaPatronalController extends Controller
{
    /**
     * Lists all fiestaPatronal entities.
     *
     * @Route("/", name="fiestapatronal_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fiestaPatronals = $em->getRepository('FiestasBundle:FiestaPatronal')->findAll();

        return $this->render('fiestapatronal/index.html.twig', array(
            'fiestaPatronals' => $fiestaPatronals,
        ));
    }

    /**
     * Creates a new fiestaPatronal entity.
     *
     * @Route("/new", name="fiestapatronal_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $fiestaPatronal = new Fiestapatronal();
        $form = $this->createForm('Tipsa\FiestasBundle\Form\FiestaPatronalType', $fiestaPatronal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fiestaPatronal);
            $em->flush();

            return $this->redirectToRoute('fiestapatronal_show', array('id' => $fiestaPatronal->getId()));
        }

        return $this->render('fiestapatronal/new.html.twig', array(
            'fiestaPatronal' => $fiestaPatronal,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a fiestaPatronal entity.
     *
     * @Route("/{id}", name="fiestapatronal_show")
     * @Method("GET")
     */
    public function showAction(FiestaPatronal $fiestaPatronal)
    {
        $deleteForm = $this->createDeleteForm($fiestaPatronal);

        return $this->render('fiestapatronal/show.html.twig', array(
            'fiestaPatronal' => $fiestaPatronal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing fiestaPatronal entity.
     *
     * @Route("/{id}/edit", name="fiestapatronal_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FiestaPatronal $fiestaPatronal)
    {
        $deleteForm = $this->createDeleteForm($fiestaPatronal);
        $editForm = $this->createForm('Tipsa\FiestasBundle\Form\FiestaPatronalType', $fiestaPatronal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fiestapatronal_edit', array('id' => $fiestaPatronal->getId()));
        }

        return $this->render('fiestapatronal/edit.html.twig', array(
            'fiestaPatronal' => $fiestaPatronal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a fiestaPatronal entity.
     *
     * @Route("/{id}", name="fiestapatronal_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FiestaPatronal $fiestaPatronal)
    {
        $form = $this->createDeleteForm($fiestaPatronal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fiestaPatronal);
            $em->flush();
        }

        return $this->redirectToRoute('fiestapatronal_index');
    }

    /**
     * Creates a form to delete a fiestaPatronal entity.
     *
     * @param FiestaPatronal $fiestaPatronal The fiestaPatronal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FiestaPatronal $fiestaPatronal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fiestapatronal_delete', array('id' => $fiestaPatronal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
