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
			'SELECT b.name AS name, c.name AS city, u.name AS owner FROM OmitsisSampleAppBundle:Boat b, OmitsisSampleAppBundle:City c, OmitsisSampleAppBundle:User u
			WHERE b.active = 1 AND b.owner = u.id AND b.city = c.id 
			ORDER BY u.name, c.name');
			
		$query2 = $em->createQuery(
			'SELECT b FROM OmitsisSampleAppBundle:Boat b
			WHERE b.active = 1  
			ORDER BY b.owner, b.city');
			
		$query3 = $em->createQuery(
			'SELECT b FROM OmitsisSampleAppBundle:Boat b
			JOIN b.city c
			JOIN b.owner o
			WHERE b.active = 1  
			ORDER BY o.name, c.name');
			
		$queryGroup = $em->createQuery(
			'SELECT COUNT(b) AS n, o.name AS owner, c.name AS city FROM OmitsisSampleAppBundle:Boat b
			JOIN b.city c
			JOIN b.owner o
			WHERE b.active = 1  
			GROUP BY b.owner, b.city
			ORDER BY o.name, c.name');
			
		$results = $query3->getResult();
		$resultsGroup = $queryGroup->getResult();

        return array(
            'results' => $results,
			'resultsGroup' => $resultsGroup,
        );
    }


}
