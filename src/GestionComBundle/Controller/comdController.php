<?php

namespace GestionComBundle\Controller;

use GestionComBundle\Entity\comd;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
/**
 * Comd controller.
 *
 * @Route("comd")
 */
class comdController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comds = $em->getRepository('GestionComBundle:comd')->findAll();

        return $this->render('@GestionCom/Default/indexC.html.twig', array(
            'comds' => $comds
        ));


    }

    public function excelAction()
    {
        $em = $this->getDoctrine()->getManager();

        $comds = $em->getRepository('GestionComBundle:comd')->findAll();

        $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject();

        $phpExcelObject->getProperties()->setCreator("insaf")
            ->setLastModifiedBy("insaf")
            ->setTitle("test")
            ->setSubject("Office 2005 XLSX Test Document")
            ->setDescription("Test document for Office 2005 XLSX, generated using PHP classes.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");
        for ($i=0; $i< count($comds); $i++){
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('A'.($i+1), $comds[$i]->getDateCommande()->format('Y-m-d H:i:s'))
                ->setCellValue('B'.($i+1),strval( $comds[$i]->getPrixTot()))
                ->setCellValue('c'.($i+1),strval( $comds[$i]->getPanierr()->getId()));
        }

        $phpExcelObject->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);
        $writer = $this->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');
        // create the response
        $response = $this->get('phpexcel')->createStreamedResponse($writer);
        // adding headers
        $dispositionHeader = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'stream-file.xls'
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Pragma', 'public');
        $response->headers->set('Cache-Control', 'maxage=1');
        $response->headers->set('Content-Disposition', $dispositionHeader);

        return $response;
    }

    /**
     * Creates a new comd entity.
     *
     * @Route("/new", name="comd_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $comd = new Comd();
        $form = $this->createForm('GestionComBundle\Form\comdType', $comd);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comd);
            $em->flush();

            return $this->redirectToRoute('commande_show', array('id' => $comd->getId()));
        }

        return $this->render('@GestionCom/Default/newC.html.twig', array(
            'comd' => $comd,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comd entity.
     *
     * @Route("/{id}", name="commande_Affiche")
     * @Method("GET")
     */
    public function showAction(comd $comd)
    {
        $deleteForm = $this->createDeleteForm($comd);

        return $this->render('@GestionCom/Default/showC.html.twig', array(
            'comd' => $comd
        ));
    }

    /**
     * Displays a form to edit an existing comd entity.
     *
     * @Route("/{id}/edit", name="comd_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, comd $comd)
    {
        $deleteForm = $this->createDeleteForm($comd);
        $editForm = $this->createForm('GestionComBundle\Form\comdType', $comd);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comd_edit', array('id' => $comd->getId()));
        }

        return $this->render('@GestionCom/Default/editC.html.twig', array(
            'comd' => $comd,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction($id)
    {
        $orm = $this->getDoctrine()->getManager();
        $comd = $orm->getRepository('GestionComBundle:comd')->find($id);
        $orm->remove($comd);
        $orm->flush();
        return $this->redirectToRoute("commande_Affiche");
    }






    /**
     * Creates a form to delete a comd entity.
     *
     * @param comd $comd The comd entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(comd $comd)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comd_delete', array('id' => $comd->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }







}
