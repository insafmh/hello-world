<?php

namespace GestionComBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use UserBundle\Entity\User;

/**
 * panierr
 *
 * @ORM\Table(name="panierr")
 * @ORM\Entity(repositoryClass="GestionComBundle\Repository\panierrRepository")
 */
class panierr
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataMod", type="date")
     */
    private $dataMod;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dataMod
     *
     * @param \DateTime $dataMod
     *
     * @return panierr
     */
    public function setDataMod($dataMod)
    {
        $this->dataMod = $dataMod;

        return $this;
    }

    /**
     * Get dataMod
     *
     * @return \DateTime
     */
    public function getDataMod()
    {
        return $this->dataMod;
    }


    /**
     * @var
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="User_id", referencedColumnName="id")
     */
    private $User;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     */
    public function setUser($User)
    {
        $this->User = $User;
    }




}

