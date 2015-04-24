<?php

namespace Proxy\__CG__\App\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Eleve extends \App\Entity\Eleve implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getFirstName()
    {
        $this->__load();
        return parent::getFirstName();
    }

    public function setFirstName($firstName)
    {
        $this->__load();
        return parent::setFirstName($firstName);
    }

    public function getLastName()
    {
        $this->__load();
        return parent::getLastName();
    }

    public function setLastName($lastName)
    {
        $this->__load();
        return parent::setLastName($lastName);
    }

    public function getDateOfBirth()
    {
        $this->__load();
        return parent::getDateOfBirth();
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->__load();
        return parent::setDateOfBirth($dateOfBirth);
    }

    public function getNotes()
    {
        $this->__load();
        return parent::getNotes();
    }

    public function setNotes($notes)
    {
        $this->__load();
        return parent::setNotes($notes);
    }

    public function getClasse()
    {
        $this->__load();
        return parent::getClasse();
    }

    public function setClasse($Classe)
    {
        $this->__load();
        return parent::setClasse($Classe);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function setUpdatedValue()
    {
        $this->__load();
        return parent::setUpdatedValue();
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setCreated($created)
    {
        $this->__load();
        return parent::setCreated($created);
    }

    public function getCreated()
    {
        $this->__load();
        return parent::getCreated();
    }

    public function setUpdated($updated)
    {
        $this->__load();
        return parent::setUpdated($updated);
    }

    public function getUpdated()
    {
        $this->__load();
        return parent::getUpdated();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'firstName', 'lastName', 'dateOfBirth', 'email', 'id', 'created', 'updated', 'notes', 'Classe');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}