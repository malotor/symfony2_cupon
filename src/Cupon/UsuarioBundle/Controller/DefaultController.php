<?php

namespace Cupon\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Core\SecurityContext;

use Cupon\UsuarioBundle\Entity\Usuario;
use Cupon\UsuarioBundle\Form\Frontend\UsuarioType;

use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
  public function comprasAction()
  {

    $usuario_id = 1;

    $em = $this->getDoctrine()->getManager();

    $compras = $em->getRepository('UsuarioBundle:Usuario')
      ->findTodasLasCompras($usuario_id);

    return $this->render('UsuarioBundle:Default:compras.html.twig', [
      'compras' => $compras
    ]);
  }

  public function loginAction()
  {
    $peticion = $this->getRequest();
    $sesion = $peticion->getSession();
    $error = $peticion->attributes->get(
      SecurityContext::AUTHENTICATION_ERROR,
      $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
    );

    return $this->render('UsuarioBundle:Default:login.html.twig', array(
      'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
      'error' => $error
    ));
  }

  public function cajaLoginAction()
  {
    $peticion = $this->getRequest();
    $sesion = $peticion->getSession();
    $error = $peticion->attributes->get(
      SecurityContext::AUTHENTICATION_ERROR,
      $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
    );

    return $this->render('UsuarioBundle:Default:login.html.twig', array(
      'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
      'error' => $error
    ));
  }

  public function registroAction()
  {

    $peticion = $this->getRequest();

    $usuario = new Usuario();

    $usuario->setPermiteEmail(true);
    //$usuario->setFechaNacimiento(new \DateTime());

    $formulario = $this->createForm(new UsuarioType(), $usuario);

    if ($peticion->getMethod() == 'POST') {
      $formulario->bind($peticion);

      if ($formulario->isValid()) {
        $encoder = $this->get('security.encoder_factory')->getEncoder($usuario);
        $usuario->setSalt(md5(time()));
        $passwordCodificado = $encoder->encodePassword(
          $usuario->getPassword(),
          $usuario->getSalt()
        );
        $usuario->setPassword($passwordCodificado);

        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($usuario);
        $em->flush();


        $sesion = $this->get('session')->getFlashBag();

        $sesion->set('info', '¡Enhorabuena! Te has registrado correctamente en Cupon');

        $token = new UsernamePasswordToken(
          $usuario,
          $usuario->getPassword(),
          'usuarios',
          $usuario->getRoles()
        );
        $this->container->get('security.context')->setToken($token);


        return $this->redirect($this->generateUrl('portada', array(
          'ciudad' => $usuario->getCiudad()->getSlug()
        )));

      }
    }

    return $this->render('UsuarioBundle:Default:registro.html.twig', array('formulario' => $formulario->createView()));
  }
}
