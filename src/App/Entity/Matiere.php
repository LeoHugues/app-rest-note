<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 26/03/15
 * Time: 16:45
 */

namespace App\Entity;

use App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping;

/**
 * @Entity @Table(name="matieres")
 */
class Matiere extends Entity
{
    /**
     * @Column(type="string", name="nom")
     * @var string
     */
    private $name;

    /**
     * @Column(type="integer", name="coefficient")
     * @var int
     */
    private $coefficient;

    /**
     * @Column(type="string", name="description")
     * @var string
     */
    private $descriptions;

    /**
     * @OneToMany(targetEntity="Note", mappedBy="matieres", cascade={"persist"})
     * @var ArrayCollection
     */
    private $notes;

    public function __construct() {
        parent::__construct();
        $this->notes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * @param mixed $descriptions
     */
    public function setDescriptions($descriptions)
    {
        $this->descriptions = $descriptions;
    }

    /**
     * @return ArrayCollection
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param ArrayCollection $notes
     */
    public function setNotes(ArrayCollection $notes)
    {
        $this->notes = $notes;
    }

}