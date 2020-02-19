<?php

namespace GestionComBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Panier_Produit
 *
 * @ORM\Table(name="panier__produit")
 * @ORM\Entity(repositoryClass="GestionComBundle\Repository\Panier_ProduitRepository")
 */
class Panier_Produit
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
     * @ORM\Column(name="qte", type="float")
     */
    private $qte;


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
     * Set qte
     *
     * @param float $qte
     *
     * @return Panier_Produit
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return float
     */
    public function getQte()
    {
        return $this->qte;
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




    /**
     * @var
     * @ORM\ManyToOne(targetEntity="produit")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    private $produit;



    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }




}

