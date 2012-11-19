<?php

namespace Omitsis\SampleAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Omitsis\SampleAppBundle\Entity\Boat;
use Omitsis\SampleAppBundle\Form\BoatType;

/**
 * Boat controller.
 *
 * @Route("/boat")
 */
class BoatController extends Controller
{
    /**
     * Lists all Boat entities.
     *
     * @Route("/", name="boat")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OmitsisSampleAppBundle:Boat')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Boat entity.
     *
     * @Route("/{id}/show", name="boat_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmitsisSampleAppBundle:Boat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Boat entity.
     *
     * @Route("/new", name="boat_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Boat();
        $form   = $this->createForm(new BoatType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Boat entity.
     *
     * @Route("/create", name="boat_create")
     * @Method("POST")
     * @Template("OmitsisSampleAppBundle:Boat:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Boat();
        $form = $this->createForm(new BoatType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boat_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Boat entity.
     *
     * @Route("/{id}/edit", name="boat_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmitsisSampleAppBundle:Boat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boat entity.');
        }

        $editForm = $this->createForm(new BoatType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Boat entity.
     *
     * @Route("/{id}/update", name="boat_update")
     * @Method("POST")
     * @Template("OmitsisSampleAppBundle:Boat:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmitsisSampleAppBundle:Boat')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Boat entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BoatType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('boat_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Boat entity.
     *
     * @Route("/{id}/delete", name="boat_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('OmitsisSampleAppBundle:Boat')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Boat entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('boat'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
