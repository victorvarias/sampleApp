<?php

namespace Omitsis\SampleAppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Omitsis\SampleAppBundle\Entity\City;

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

}
