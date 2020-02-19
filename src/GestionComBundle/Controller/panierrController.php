<?php

namespace GestionComBundle\Controller;

use GestionComBundle\Entity\panierr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Panierr controller.
 *
 * @Route("panierr")
 */
class panierrController extends Controller
{
    /**
     * Lists all panierr entities.
     *
     * @Route("/", name="panierr_index")
     * @Method("GET")
     */


    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $panierrs = $em->getRepository('GestionComBundle:panierr')->findAll();

        return $this->render('@GestionCom/Default/indexC.html.twig', array(
            'panierrs' => $panierrs,
        ));
    }

    /**
     * Creates a new panierr entity.
     *
     * @Route("/new", name="panierr_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $panierr = new Panierr();
        $form = $this->createForm('GestionComBundle\Form\panierrType', $panierr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($panierr);
            $em->flush();

            return $this->redirectToRoute('panierr_show', array('id' => $panierr->getId()));
        }

        return $this->render('@GestionCom/Default/new.html.twig', array(
            'panierr' => $panierr,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a panierr entity.
     *
     * @Route("/{id}", name="panierr_show")
     * @Method("GET")
     */
    public function showAction(panierr $panierr)
    {
        $deleteForm = $this->createDeleteForm($panierr);

        return $this->render('@GestionCom/Default/show.html.twig', array(
            'panierr' => $panierr,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing panierr entity.
     *
     * @Route("/{id}/edit", name="panierr_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, panierr $panierr)
    {
        $deleteForm = $this->createDeleteForm($panierr);
        $editForm = $this->createForm('GestionComBundle\Form\panierrType', $panierr);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panierr_edit', array('id' => $panierr->getId()));
        }

        return $this->render('@GestionCom/Default/editC.html.twig', array(
            'panierr' => $panierr,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a panierr entity.
     *
     * @Route("/{id}", name="panierr_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, panierr $panierr)
    {
        $form = $this->createDeleteForm($panierr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panierr);
            $em->flush();
        }

        return $this->redirectToRoute('panierr_index');
    }

    /**
     * Creates a form to delete a panierr entity.
     *
     * @param panierr $panierr The panierr entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(panierr $panierr)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paniers_delete', array('id' => $panierr->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
