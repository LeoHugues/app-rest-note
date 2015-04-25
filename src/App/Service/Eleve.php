<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 31/03/15
 * Time: 10:45
 */

namespace App\Service;

use App\Service;
use App\Entity\Eleve as EleveEntity;
use Carbon\Carbon;

class Eleve extends Service
{
    /**
     * @param $id
     * @return object
     */
    public function getEleve($id)
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Eleve');
        /**
         * @var \App\Entity\Eleve $eleve
         */
        $eleve = $repository->find($id);

        if ($eleve === null) {
            return null;
        }

        return array(
            'id'           => $eleve->getId(),
            'id_classe'    => $eleve->getClasse(),
            'created'      => $eleve->getCreated(),
            'updated'      => $eleve->getUpdated(),
            'firstName'    => $eleve->getFirstName(),
            'lastName'     => $eleve->getLastName(),
            'email'        => $eleve->getEmail(),
            'dateOfBirth'  => $eleve->getDateOfBirth()
        );
    }

    /**
     * @return array|null
     */
    public function getEleves()
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Eleve');
        $eleves = $repository->findAll();

        if (empty($eleves)) {
            return null;
        }

        /**
         * @var \App\Entity\Eleve $eleve
         */
        $data = array();
        foreach ($eleves as $eleve)
        {
            $data[] = array(
                'id'           => $eleve->getId(),
                'id_classe'    => $eleve->getClasse(),
                'created'      => $eleve->getCreated(),
                'updated'      => $eleve->getUpdated(),
                'firstName'    => $eleve->getFirstName(),
                'lastName'     => $eleve->getLastName(),
                'email'        => $eleve->getEmail(),
                'dateOfBirth'  => $eleve->getDateOfBirth()
            );
        }

        return $data;
    }

    /**
     * @param $idClasse
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $dateOfBirth
     * @return array
     */
    public function createEleve($idClasse, $firstName, $lastName, $email, $dateOfBirth)
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Classe');
        $classe = $repository->find($idClasse);

        $eleve = new EleveEntity();
        $eleve->setClasse($classe);
        $eleve->setFirstName($firstName);
        $eleve->setLastName($lastName);
        $eleve->setEmail($email);
        $eleve->setDateOfBirth($dateOfBirth);


        $this->getEntityManager()->persist($eleve);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $eleve->getId(),
            'classe'       => $eleve->getClasse(),
            'created'      => $eleve->getCreated(),
            'updated'      => $eleve->getUpdated(),
            'firstName'    => $eleve->getFirstName(),
            'lastName'     => $eleve->getLastName(),
            'email'        => $eleve->getEmail(),
            'dateOfBirth'  => $eleve->getDateOfBirth()
        );
    }

    /**
     * @param $id
     * @param $idClasse
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $dateOfBirth
     * @return array
     */
    public function updateEleve($id, $idClasse, $firstName, $lastName, $email, $dateOfBirth)
    {
        /**
         * @var \App\Entity\Eleve $eleve
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Eleve');
        $eleve = $repository->find($id);

        if ($eleve === null) {
            return null;
        }

        /**
         * @var \App\Entity\Classe $classe
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Classe');
        $classe = $repository->find($idClasse);

        $eleve->setClasse($classe);
        $eleve->setFirstName($firstName);
        $eleve->setLastName($lastName);
        $eleve->setEmail($email);
        $eleve->setDateOfBirth($dateOfBirth);

        $this->getEntityManager()->persist($eleve);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $eleve->getId(),
            'classe'       => $eleve->getClasse(),
            'created'      => $eleve->getCreated(),
            'updated'      => $eleve->getUpdated(),
            'firstName'    => $eleve->getFirstName(),
            'lastName'     => $eleve->getLastName(),
            'email'        => $eleve->getEmail(),
            'dateOfBirth'  => $eleve->getDateOfBirth()
        );
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteEleve($id)
    {
        /**
         * @var \App\Entity\Eleve $eleve
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Eleve');
        $eleve = $repository->find($id);

        if ($eleve === null) {
            return false;
        }

        $this->getEntityManager()->remove($eleve);
        $this->getEntityManager()->flush();

        return true;
    }
}