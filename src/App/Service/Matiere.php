<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 26/03/15
 * Time: 17:48
 */

namespace App\Service;

use App\Service;
use App\Entity\Matiere as MatiereEntity;

class Matiere extends Service {
    /**
     * @param $id
     * @return object
     */
    public function getMatiere($id)
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Matiere');
        /**
         * @var \App\Entity\Matiere $matiere
         */
        $matiere = $repository->find($id);

        if ($matiere === null) {
            return null;
        }

        return array(
            'id'           => $matiere->getId(),
            'created'      => $matiere->getCreated(),
            'updated'      => $matiere->getUpdated(),
            'name'         => $matiere->getName(),
            'coefficient'  => $matiere->getCoefficient(),
            'description'  => $matiere->getDescriptions(),
            'notes'        => $matiere->getNotes()
        );
    }

    /**
     * @return array|null
     */
    public function getMatieres()
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Matiere');
        $matieres = $repository->findAll();

        if (empty($matieres)) {
            return null;
        }

        /**
         * @var \App\Entity\Matiere $matiere
         */
        $data = array();
        foreach ($matieres as $matiere)
        {
            $data[] = array(
                'id'           => $matiere->getId(),
                'created'      => $matiere->getCreated(),
                'updated'      => $matiere->getUpdated(),
                'name'         => $matiere->getName(),
                'coefficient'  => $matiere->getCoefficient(),
                'description'  => $matiere->getDescriptions(),
                'notes'        => $matiere->getNotes()
            );
        }

        return $data;
    }

    /**
     * @param $name
     * @param $coefficient
     * @param $description
     * @return array
     */
    public function createMatiere($name, $coefficient, $description)
    {
        $matiere = new MatiereEntity();
        $matiere->setName($name);
        $matiere->setCoefficient($coefficient);
        $matiere->setDescriptions($description);

        $this->getEntityManager()->persist($matiere);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $matiere->getId(),
            'created'      => $matiere->getCreated(),
            'updated'      => $matiere->getUpdated(),
            'name'         => $matiere->getName(),
            'coefficient'  => $matiere->getCoefficient(),
            'description'  => $matiere->getDescriptions(),
            'notes'        => $matiere->getNotes()
        );
    }

    /**
     * @param $id
     * @param $name
     * @param $coefficient
     * @param $description
     * @return array|null
     */
    public function updateMatiere($id, $name, $coefficient, $description)
    {
        /**
         * @var \App\Entity\Matiere $matiere
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Matiere');
        $matiere = $repository->find($id);

        if ($matiere === null) {
            return null;
        }

        $matiere->setName($name);
        $matiere->setCoefficient($coefficient);
        $matiere->setDescriptions($description);
        $matiere->setUpdated(new \DateTime());

        $this->getEntityManager()->persist($matiere);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $matiere->getId(),
            'created'      => $matiere->getCreated(),
            'updated'      => $matiere->getUpdated(),
            'name'         => $matiere->getName(),
            'coefficient'  => $matiere->getCoefficient(),
            'description'  => $matiere->getDescriptions(),
        );
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteMatiere($id)
    {
        /**
         * @var \App\Entity\Matiere $matiere
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Matiere');
        $matiere = $repository->find($id);
        if ($matiere === null) {
            return false;
        }

        $this->getEntityManager()->remove($matiere);
        $this->getEntityManager()->flush();

        return true;
    }
}