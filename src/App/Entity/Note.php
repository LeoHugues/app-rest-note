<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 09/03/15
 * Time: 22:03
 */

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="notes")
 */
class Note extends Entity
{
    /**
     * @Column(type="float")
     * @var string
     */
    private $nbPoints;

    /**
     * @Column(type="integer")
     * @var int
     */
    private $coefficient;

    /**
     * @Column(type="date")
     */
    private $date;

    /**
     * @Column(type="string", length=255)
     * @var string
     */
    private $apreciation;

    /**
     * @ManyToOne(targetEntity="Eleve", inversedBy="notes")
     * @JoinColumn(name="eleve_id", referencedColumnName="id")
     */
    private $idEleve;

    /**
     * @ManyToOne(targetEntity="Matiere", inversedBy="notes")
     * @JoinColumn(name="matiere_id", referencedColumnName="id")
     */
    private $idMatiere;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNbPoints()
    {
        return $this->nbPoints;
    }

    /**
     * @param mixed $nbPoints
     */
    public function setNbPoints($nbPoints)
    {
        $this->nbPoints = $nbPoints;
    }

    /**
     * @return mixed
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * @param mixed $coefficient
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getApreciation()
    {
        return $this->apreciation;
    }

    /**
     * @param mixed $apreciation
     */
    public function setApreciation($apreciation)
    {
        $this->apreciation = $apreciation;
    }

    /**
     * @return mixed
     */
    public function getIdEleve()
    {
        return $this->idEleve;
    }

    /**
     * @param mixed $idEleve
     */
    public function setIdEleve($idEleve)
    {
        $this->idEleve = $idEleve;
    }

    /**
     * @return mixed
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param mixed $idMatiere
     */
    public function setIdMatiere($idMatiere)
    {
        $this->idMatiere = $idMatiere;
    }

}