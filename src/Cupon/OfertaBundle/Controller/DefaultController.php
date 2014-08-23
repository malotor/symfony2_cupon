<?php

namespace Cupon\OfertaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    
	public function portadaAction($ciudad)
  {

  	//$em = $this->getDoctrine()->getEntityManager();
    /*
    if (null == $ciudad) {
      $ciudad = $this->container->getParameter('cupon.ciudad_por_defecto');
      
      return new RedirectResponse(
        $this->generateUrl('portada', array('ciudad' => $ciudad))
      );
    }
    */
    $em = $this->getDoctrine()->getManager();
    
  	// $oferta = $em->getRepository('OfertaBundle:Oferta')->findOneBy(array(
   //    'ciudad' => $ciudad,
   //    //'fecha_publicacion' => new \DateTime('today')
   //  ));
    
    $oferta = $em->getRepository('OfertaBundle:Oferta')->findOfertaDelDia($ciudad);

    if (!$oferta) {
      throw $this->createNotFoundException('No se ha encontrado la oferta del día en la ciudad seleccionada'); 
    }

    $log = $this->get('logger');
    $log->addInfo('Generada la portada en  milisegundos');

		return $this->render(
      'OfertaBundle:Default:portada.html.twig',
      array('oferta' => $oferta)
		);

  }
  public function indexAction($name)
  {
      
    return $this->render('OfertaBundle:Default:index.html.twig', array('name' => $name));
  }

  public function ayudaAction()
  {
    // return new Response('Ayuda');

    return $this->render('OfertaBundle:Default:ayuda.html.twig');
  }


  public function OfertaAction($ciudad, $slug)
  {
    $em = $this->getDoctrine()->getManager();
    $oferta = $em->getRepository('OfertaBundle:Oferta')->findOferta($ciudad, $slug);

    $relacionadas = $em->getRepository('OfertaBundle:Oferta')->findRelacionadas($ciudad);

    if (!$oferta) {
      throw $this->createNotFoundException('No existe la oferta');
    }

    return $this->render('OfertaBundle:Default:detalle.html.twig', array(
      'oferta' => $oferta,
      'relacionadas' => $relacionadas
    ));
  }
 }
