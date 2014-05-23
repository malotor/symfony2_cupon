<?php

namespace Cupon\OfertaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SitioController extends Controller
{
    
    public function estaticaAction($pagina)
    {
        // return new Response('Ayuda');
    		/*
			  $em = $this->getDoctrine()->getEntityManager();
			  $oferta = $em->getRepository('OfertaBundle:Oferta')->find(1);
			  $precio = $oferta->getPrecio();
  			$ofertas = $em->getRepository('OfertaBundle:Oferta')->findAll();
  			// Encontrar todas las ofertas revisadas
				$ofertasRevisadas = $em->getRepository('OfertaBundle:Oferta')->findBy(array(
				  'revisada' => true
				));
				*/
        return $this->render('OfertaBundle:Sitio:'.$pagina.'.html.twig');
    }
}
