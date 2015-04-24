<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 31/03/15
 * Time: 09:03
 */

namespace App\Entity;

use App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping;

/**
 * @Entity @Table(name="eleve")
 */
class Eleve extends Entity
{
    /**
     * @Column(type="string")
     * @var string
     */
    private $firstName;

    /**
     * @Column(type="string")
     * @var string
     */
    private $lastName;

    /**
     * @Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @OneToMany(targetEntity="Note", mappedBy="idEleve", cascade={"persist", "remove"})
     */
    private $notes;

    /**
     * @Column(type="string")
     * @var string
     */
    private $email;

    /**
     * @ManyToOne(targetEntity="Classe", inversedBy="eleve")
     * @JoinColumn(name="classe_id", referencedColumnName="id")
     */
    private $Classe;

    public function __construct() {
        parent::__construct();
        $this->notes = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
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
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->Classe;
    }

    /**
     * @param mixed $Classe
     */
    public function setClasse($Classe)
    {
        $this->Classe = $Classe;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}