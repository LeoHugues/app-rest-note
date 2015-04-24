<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 31/03/15
 * Time: 12:10
 */

namespace App\Service;

use App\Service;
use App\Entity\Classe as ClasseEntity;

class Classe extends Service
{
    /**
     * @param $id
     * @return object
     */
    public function getClasse($id)
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Classe');
        /**
         * @var \App\Entity\Classe $classe
         */
        $classe = $repository->find($id);

        if ($classe === null) {
            return null;
        }

        return array(
            'id'           => $classe->getId(),
            'created'      => $classe->getCreated(),
            'updated'      => $classe->getUpdated(),
            'name'         => $classe->getName(),
            'notes'        => $classe->getEleves()
        );
    }

    /**
     * @return array|null
     */
    public function getClasses()
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Classe');
        $classes = $repository->findAll();

        if (empty($classes)) {
            return null;
        }

        /**
         * @var \App\Entity\Classe $classe
         */
        $data = array();
        foreach ($classes as $classe)
        {
            $data[] = array(
                'id'           => $classe->getId(),
                'created'      => $classe->getCreated(),
                'updated'      => $classe->getUpdated(),
                'name'         => $classe->getName(),
                'notes'        => $classe->getEleves()
            );
        }

        return $data;
    }

    /**
     * @param $name
     * @return array
     */
    public function createMatiere($name)
    {
        $classe = new ClasseEntity();
        $classe->setName($name);

        $this->getEntityManager()->persist($classe);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $classe->getId(),
            'created'      => $classe->getCreated(),
            'updated'      => $classe->getUpdated(),
            'name'         => $classe->getName(),
            'notes'        => $classe->getEleves()
        );
    }

    /**
     * @param $id
     * @param $name
     * @return array|null
     */
    public function updateClasse($id, $name)
    {
        /**
         * @var \App\Entity\Classe $classe
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Classe');
        $classe = $repository->find($id);

        if ($classe === null) {
            return null;
        }

        $classe->setName($name);

        $this->getEntityManager()->persist($classe);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $classe->getId(),
            'created'      => $classe->getCreated(),
            'updated'      => $classe->getUpdated(),
            'name'         => $classe->getName(),
            'eleves'       => $classe->getEleves()
        );
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteClasse($id)
    {
        /**
         * @var \App\Entity\Classe $classe
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Classe');
        $classe = $repository->find($id);

        if ($classe === null) {
            return false;
        }

        $this->getEntityManager()->remove($classe);
        $this->getEntityManager()->flush();

        return true;
    }
}