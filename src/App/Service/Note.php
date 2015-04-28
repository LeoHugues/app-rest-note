<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 09/03/15
 * Time: 22:25
 */

namespace App\Service;

use App\Service;
use App\Entity\Note as NoteEntity;
use Carbon\Carbon;

class Note extends Service
{
    /**
     * @param $id
     * @return object
     */
    public function getNote($id)
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Note');
        /**
         * @var \App\Entity\Note $note
         */
        $note = $repository->find($id);

        if ($note === null) {
            return null;
        }

        return array(
            'id'           => $note->getId(),
            'matiere_id'   => $note->getIdMatiere(),
            'eleve_id'     => $note->getIdEleve(),
            'created'      => $note->getCreated(),
            'updated'      => $note->getUpdated(),
            'nbPoint'      => $note->getNbPoints(),
            'coefficient'  => $note->getCoefficient(),
            'appreciation' => $note->getApreciation(),
            'date'         => $note->getDate()
        );
    }

    /**
     * @return array|null
     */
    public function getNotes()
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Note');
        $notes = $repository->findAll();

        if (empty($notes)) {
            return null;
        }

        /**
         * @var \App\Entity\Note $note
         */
        $data = array();
        foreach ($notes as $note)
        {
            $data[] = array(
                'id'           => $note->getId(),
                'matiere_id'   => $note->getIdMatiere(),
                'eleve_id'     => $note->getIdEleve(),
                'created'      => $note->getCreated(),
                'updated'      => $note->getUpdated(),
                'nbPoint'      => $note->getNbPoints(),
                'coefficient'  => $note->getCoefficient(),
                'appreciation' => $note->getApreciation(),
                'date'         => $note->getDate()
            );
        }

        return $data;
    }

    /**
     * @param $id
     * @return array
     */
    public function getNoteByIdEleve($id) {
        $em = $this->getEntityManager();
        $connection = $em->getConnection();

        $statement = $connection->prepare('SELECT * from notes WHERE eleve_id = '.$id);

        $statement->execute();
        $notes = $statement->fetchAll();

        return $notes;
    }

    /**
     * @param $nbPoint
     * @param $coefficient
     * @param $appreciation
     * @param $date
     * @param $idMatiere
     * @param $idEleve
     * @return array
     */
    public function createNote($nbPoint, $coefficient, $appreciation, $date, $idMatiere, $idEleve)
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Matiere');
        $matiere = $repository->find($idMatiere);

        $repository = $this->getEntityManager()->getRepository('App\Entity\Eleve');
        $eleve = $repository->find($idEleve);

        $note = new NoteEntity();
        $note->setIdMatiere($matiere);
        $note->setIdEleve($eleve);
        $note->setNbPoints($nbPoint);
        $note->setCoefficient($coefficient);
        $note->setApreciation($appreciation);
        $note->setDate($date);

        $this->getEntityManager()->persist($note);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $note->getId(),
            'matiere_id'   => $note->getIdMatiere(),
            'eleve_id'     => $note->getIdEleve(),
            'created'      => $note->getCreated(),
            'updated'      => $note->getUpdated(),
            'nbPoint'      => $note->getNbPoints(),
            'coefficient'  => $note->getCoefficient(),
            'appreciation' => $note->getApreciation(),
            'date'         => $note->getDate()
        );
    }

    /**
     * @param $id
     * @param $nbPoint
     * @param $coefficient
     * @param $appreciation
     * @param $date
     * @param $idMatiere
     * @param $idEleve
     * @return array|null
     */
    public function updateNote($id, $nbPoint, $coefficient, $appreciation, $date, $idMatiere, $idEleve)
    {
        $em = $this->getEntityManager();
        /**
         * @var \App\Entity\Note $note
         */
        $note = $em->getRepository('App\Entity\Note')->find($id);

        if ($note === null) {
            return null;
        }

        $matiere = $em->getRepository('App\Entity\Matiere')->find($idMatiere);
        $eleve = $em->getRepository('App\Entity\Eleve')->find($idEleve);

        $note->setIdMatiere($matiere);
        $note->setIdEleve($eleve);
        $note->setNbPoints($nbPoint);
        $note->setCoefficient($coefficient);
        $note->setApreciation($appreciation);
        $note->setDate($date);
        $note->setUpdated(Carbon::now());

        $this->getEntityManager()->persist($note);
        $this->getEntityManager()->flush();

        return array(
            'id'           => $note->getId(),
            'matiere_id'   => $note->getIdMatiere(),
            'eleve_id'     => $note->getIdEleve(),
            'created'      => $note->getCreated(),
            'updated'      => $note->getUpdated(),
            'nbPoint'      => $note->getNbPoints(),
            'coefficient'  => $note->getCoefficient(),
            'appreciation' => $note->getApreciation(),
            'date'         => $note->getDate()
        );
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteNote($id)
    {

        /**
         * @var \App\Entity\Note $note
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Note');
        $note = $repository->find($id);

        if ($note === null) {
            return false;
        }

        $this->getEntityManager()->remove($note);
        $this->getEntityManager()->flush();

        return true;
    }
}