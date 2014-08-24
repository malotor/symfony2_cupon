<?php

namespace Cupon\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Cupon\UsuarioBundle\Entity\Usuario
 *
 * @ORM\Entity(repositoryClass="Cupon\UsuarioBundle\Entity\UsuarioRepository")
 */
class Usuario implements UserInterface {
	/**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue
   */
  protected $id;

	/** @ORM\Column(type="string", length=255) */
	protected $nombre;

	/** @ORM\Column(type="string", length=255) */
	protected $apellidos;

	/** @ORM\Column(type="string", length=255) */
	protected $email;

	/** @ORM\Column(type="string", length=255) */
	protected $password;

	/** @ORM\Column(type="string", length=255) */
	protected $salt;

	/**	@ORM\Column(type="text") */
	protected $direccion;

	/**	@ORM\Column(type="boolean") */
	protected $permite_email;

	/**	@ORM\Column(type="datetime") */
	protected $fecha_alta;

	/**	@ORM\Column(type="datetime") */
	protected $fecha_nacimiento;

	/**	@ORM\Column(type="string", length=9) */
	protected $dni;

	/**	@ORM\Column(type="string", length=20) */
	protected $numero_tarjeta;

	/** @ORM\ManyToOne(targetEntity="Cupon\CiudadBundle\Entity\Ciudad") */
	protected $ciudad;

    public function __construct()
    {
        $this->fecha_alta = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }



    /**
     * Set permite_email
     *
     * @param boolean $permiteEmail
     * @return Usuario
     */
    public function setPermiteEmail($permiteEmail)
    {
        $this->permite_email = $permiteEmail;

        return $this;
    }

    /**
     * Get permite_email
     *
     * @return boolean 
     */
    public function getPermiteEmail()
    {
        return $this->permite_email;
    }

    /**
     * Set fecha_alta
     *
     * @param \DateTime $fechaAlta
     * @return Usuario
     */
    public function setFechaAlta($fechaAlta)
    {
        $this->fecha_alta = $fechaAlta;

        return $this;
    }

    /**
     * Get fecha_alta
     *
     * @return \DateTime 
     */
    public function getFechaAlta()
    {
        return $this->fecha_alta;
    }

    /**
     * Set fecha_nacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Usuario
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fecha_nacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set dni
     *
     * @param \DateTime $dni
     * @return Usuario
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return \DateTime 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set numero_tarjeta
     *
     * @param string $numeroTarjeta
     * @return Usuario
     */
    public function setNumeroTarjeta($numeroTarjeta)
    {
        $this->numero_tarjeta = $numeroTarjeta;

        return $this;
    }

    /**
     * Get numero_tarjeta
     *
     * @return string 
     */
    public function getNumeroTarjeta()
    {
        return $this->numero_tarjeta;
    }

    public function setCiudad(\Cupon\CiudadBundle\Entity\Ciudad $ciudad)
    {
        $this->ciudad = $ciudad;
    }

    public function __toString()
    {
        return $this->getNombre().' '.$this->getApellidos();
    }

    /**
     * Get ciudad
     *
     * @return \Cupon\CiudadBundle\Entity\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

  function eraseCredentials()
  {
  }
  function getRoles()
  {
    return array('ROLE_USUARIO');
  }
  function getUsername()
  {
    return $this->getEmail();
  }
}
