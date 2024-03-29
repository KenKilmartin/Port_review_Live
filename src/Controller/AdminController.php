<?php
/**
 * this is the name space
 */
namespace App\Controller;

use App\Entity\Port;
use App\Entity\Review;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * this is the admin controler
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * this loads the first page of myadmin
     * @Route("/myadmin", name="myadmin")
     * @Security("has_role('ROLE_ADMIN')")
     *@return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
//        $template = 'admin/index.html.twig';
//        $args = [];
//        return $this->render($template, $args);

        $ports = $this->getDoctrine()
            ->getRepository(Port::class)
            ->findAll();
        $reviews = $this->getDoctrine()
            ->getRepository(Review::class)
            ->findAll();
        $template = 'admin/index.html.twig';
        $args = [
            'ports' => $ports,
            'reviews' => $reviews,
        ];
        return $this->render($template, $args);

    }
    /**
     * To make review public
     * @Route("/makeReviewPublic/{id}", name="makeReviewPublic")
     * @param Review $review
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makeReviewPublic(Review $review)
    {
        $review->setIsPublic(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($review);

        $em->flush();

        return $this->index();

    }

    /**
     * To make {port public
     * @Route("/makePortPublic/{id}", name="makePortPublic")
     * @param Port $port
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makePortPublic(Port $port)
    {
        $port->setIsPublic(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($port);

        $em->flush();


        return $this->index();

    }


}
