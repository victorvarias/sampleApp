<?php

namespace Omitsis\SampleAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Omitsis\SampleAppBundle\Entity\City;
use Omitsis\SampleAppBundle\Form\CityType;

/**
 * City controller.
 *
 * @Route("/city")
 */
class CityController extends Controller
{
    /**
     * Lists all City entities.
     *
     * @Route("/", name="city")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('OmitsisSampleAppBundle:City')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a City entity.
     *
     * @Route("/{id}/show", name="city_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('OmitsisSampleAppBundle:City')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find City entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
	
	/**
     * Displays a form to create a new City entity.
     *
     * @Route("/new", name="city_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new City();
        $form   = $this->createForm(new CityType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new City entity.
     *
     * @Route("/create", name="city_create")
     * @Method("POST")
     * @Template("OmitsisSampleAppBundle:City:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new City();
        $form = $this->createForm(new CityType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('city_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

}
