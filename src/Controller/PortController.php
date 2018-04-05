<?php
/**
 * this is the name space
 */
namespace App\Controller;

use App\Entity\Port;
use App\Entity\Review;
use App\Form\PortType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/port", name="port_")
 */
class PortController extends Controller
{
    /**
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index()
    {
        $ports = $this->getDoctrine()
            ->getRepository(Port::class)
            ->findAll();


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $ports, /* query NOT result */
            (1)/*page number*/,
            1000/*limit per page*/
        );


        return $this->render('port/index.html.twig', ['ports' => $ports, 'pagination' => $pagination]);
    }

    /**
     * @Route("/new", name="new")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request)
    {
        $port = new Port();
        $form = $this->createForm(PortType::class, $port);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($port);
            $em->flush();

            return $this->redirectToRoute('homepage', ['id' => $port->getId()]);
        }

        return $this->render('port/new.html.twig', [
            'port' => $port,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="show")
     * @Method("GET")
     */
    public function show(Port $port)
    {
        return $this->render('port/show.html.twig', [
            'port' => $port,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Port $port)
    {
        $form = $this->createForm(PortType::class, $port);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('homepage', ['id' => $port->getId()]);
        }

        return $this->render('port/edit.html.twig', [
            'port' => $port,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delete")
     * @Method("DELETE")
     */
    public function delete(Request $request, Port $port)
    {
        if (!$this->isCsrfTokenValid('delete'.$port->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('port_index');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($port);
        $em->flush();

        return $this->redirectToRoute('port_index');
    }

//_________________________________________________________________________________________


    /**
     * @Route("/processSearch", name="processSearch")
     * @param Request $request
     * @return Response
     */
    public function processSearch(Request $request)
    {

        $filter = $request->query->get('q');
        $qb = $this->getDoctrine()
            ->getRepository(Port::class)
            ->findAllQueryBuilder($filter);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $qb,
            (1)/*page number*/,
            1000/*limit per page*/
        );

        return $this->render('port/index.html.twig', [ 'pagination' => $pagination]);

    }

    /**
     * @Route("/processDateSearch", name="processDateSearch")
     * @param Request $request
     * @return Response
     */
    public function processDateSearch(Request $request)
    {
        $date1St = $request->query->get('d1');

        $date2St = $request->query->get('d2');

        if($date1St!=""&&$date2St!=""){
            $date1 = new \DateTime($date1St);
            $date2 = new \DateTime($date2St);
            $qb = $this->getDoctrine()
                ->getRepository(Port::class)
                ->findAllByDateQueryBuilder($date1, $date2);

            $paginator  = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                $qb,
                (1)/*page number*/,
                1000/*limit per page*/
            );
            return $this->render('port/index.html.twig', [ 'pagination' => $pagination]);
        }else{
            return $this->index();
        }

    }















}
