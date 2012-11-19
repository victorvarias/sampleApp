<?php

namespace Omitsis\SampleAppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Omitsis\SampleAppBundle\Entity\City;
use Omitsis\SampleAppBundle\Entity\Boat;
use Omitsis\SampleAppBundle\Entity\User;

/**
 * Resume controller.
 *
 * @Route("/resume")
 */
class ResumeController extends Controller
{
    /**
     * Lists boats ordered by user and city.
     *
     * @Route("/", name="resume")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

		$query = $em->createQuery(
			'SELECT b.name AS name, c.name AS city, u.name AS user FROM OmitsisSampleAppBundle:Boat b, OmitsisSampleAppBundle:City c, OmitsisSampleAppBundle:User u
			WHERE b.active = 1 AND b.owner = u.id AND b.city = c.id 
			ORDER BY b.owner, b.city');
			
		$res = $query->getResult();
		
        $boats = $em->getRepository('OmitsisSampleAppBundle:Boat')->findAll();

        return array(
            'res' => $res,
        );
    }


}
