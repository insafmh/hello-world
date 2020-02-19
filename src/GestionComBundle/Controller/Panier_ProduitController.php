<?php

namespace GestionComBundle\Controller;

use GestionComBundle\Entity\Panier_Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Panier_produit controller.
 *
 * @Route("panier_produit")
 */
class Panier_ProduitController extends Controller
{
    /**
     * Lists all panier_Produit entities.
     *
     * @Route("/", name="panier_produit_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $panier_Produits = $em->getRepository('GestionComBundle:Panier_Produit')->findAll();

        return $this->render('panier_produit/indexC.html.twig', array(
            'panier_Produits' => $panier_Produits,
        ));
    }

    /**
     * Creates a new panier_Produit entity.
     *
     * @Route("/new", name="panier_produit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $panier_Produit = new Panier_produit();
        $form = $this->createForm('GestionComBundle\Form\Panier_ProduitType', $panier_Produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($panier_Produit);
            $em->flush();

            return $this->redirectToRoute('panier_produit_show', array('id' => $panier_Produit->getId()));
        }

        return $this->render('panier_produit/newC.html.twig', array(
            'panier_Produit' => $panier_Produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a panier_Produit entity.
     *
     * @Route("/{id}", name="panier_produit_show")
     * @Method("GET")
     */
    public function showAction(Panier_Produit $panier_Produit)
    {
        $deleteForm = $this->createDeleteForm($panier_Produit);

        return $this->render('panier_produit/showC.html.twig', array(
            'panier_Produit' => $panier_Produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing panier_Produit entity.
     *
     * @Route("/{id}/edit", name="panier_produit_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Panier_Produit $panier_Produit)
    {
        $deleteForm = $this->createDeleteForm($panier_Produit);
        $editForm = $this->createForm('GestionComBundle\Form\Panier_ProduitType', $panier_Produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panier_produit_edit', array('id' => $panier_Produit->getId()));
        }

        return $this->render('panier_produit/editC.html.twig', array(
            'panier_Produit' => $panier_Produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a panier_Produit entity.
     *
     * @Route("/{id}", name="panier_produit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Panier_Produit $panier_Produit)
    {
        $form = $this->createDeleteForm($panier_Produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($panier_Produit);
            $em->flush();
        }

        return $this->redirectToRoute('panier_produit_index');
    }

    /**
     * Creates a form to delete a panier_Produit entity.
     *
     * @param Panier_Produit $panier_Produit The panier_Produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Panier_Produit $panier_Produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('panier_produit_delete', array('id' => $panier_Produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
