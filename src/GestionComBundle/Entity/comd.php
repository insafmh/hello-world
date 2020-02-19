<?php

namespace GestionComBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * comd
 *
 * @ORM\Table(name="comd")
 * @ORM\Entity(repositoryClass="GestionComBundle\Repository\comdRepository")
 */
class comd
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
     * @var float
     *
     * @ORM\Column(name="prix_Tot", type="float")
     */
    private $prixTot;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommande", type="date")
     */
    private $dateCommande;


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
     * Set prixTot
     *
     * @param float $prixTot
     *
     * @return comd
     */
    public function setPrixTot($prixTot)
    {
        $this->prixTot = $prixTot;

        return $this;
    }

    /**
     * Get prixTot
     *
     * @return float
     */
    public function getPrixTot()
    {
        return $this->prixTot;
    }

    /**
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return comd
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="panierr")
     * @ORM\JoinColumn(name="panierr_id", referencedColumnName="id")
     */
    private $panierr;


    /**
     * @return mixed
     */
    public function getPanierr()
    {
        return $this->panierr;
    }

    /**
     * @param mixed $panierr
     */
    public function setPanierr($panierr)
    {
        $this->panierr = $panierr;
    }



}

