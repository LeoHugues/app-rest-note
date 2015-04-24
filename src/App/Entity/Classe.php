<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 31/03/15
 * Time: 10:04
 */

namespace App\Entity;

use App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping;

/**
 * @Entity @Table(name="classe")
 */
class Classe extends Entity
{
    /**
     * @Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @OneToMany(targetEntity="Eleve", mappedBy="Classe", cascade={"persist", "remove"})
     * @var ArrayCollection
     */
    private $eleves;

    public function __construct() {
        parent::__construct();
        $this->eleves = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection
     */
    public function getEleves()
    {
        return $this->eleves;
    }

    /**
     * @param ArrayCollection $eleves
     */
    public function setEleves($eleves)
    {
        $this->eleves = $eleves;
    }
}