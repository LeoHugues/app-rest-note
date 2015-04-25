<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 09/03/15
 * Time: 22:44
 */

namespace App\Resource;


use App\Resource;
use App\Service\Note as NoteService;
use Carbon\Carbon;

class Note extends Resource
{
    /**
     * @var \App\Service\Note
     */
    private $noteService;

    /**
     * Get note service
     */
    public function init()
    {
        $this->setNoteService(new NoteService($this->getEntityManager()));
    }

    /**
     * @param null $id
     */
    public function get($id = null)
    {
        if ($id === null) {
            $data = $this->getNoteService()->getNotes();
        } else {
            $data = $this->getNoteService()->getNote($id);
        }

        if ($data === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        $response = array('note' => $data);
        self::response(self::STATUS_OK, $response);
    }

    /**
     * Create note
     */
    public function post()
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);
        $date = Carbon::createFromFormat('d-m-Y', $params['date']);

        if(empty($params['nbPoint']) || empty($params['coefficient']) || empty($params['appreciation']) || empty($params['date']) || empty($params['idMatiere']) || empty($params['idEleve'])
            || $params['nbPoint'] === null || $params['coefficient'] === null || $params['appreciation'] === null || $params['date'] === null || $params['idMatiere'] === null || $params['idEleve'] === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $note = $this->getNoteService()->createNote(
            $params['nbPoint'],
            $params['coefficient'],
            $params['appreciation'],
            $date,
            $params['idMatiere'],
            $params['idEleve']
        );

        self::response(self::STATUS_CREATED, array('note', $note));
    }

    /**
     * Update note
     */
    public function put($id)
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);

        if (empty($params['nbPoint']) && empty($params['coefficient']) && empty($params['appreciation']) && empty($params['date']) && empty($params['idMatiere']) && empty($params['idEleve'])
            || $params['nbPoint'] === null && $params['coefficient'] === null && $params['appreciation'] === null && $params['date'] === null && $params['idMatiere'] === null && $params['idEleve'] === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $date = Carbon::createFromFormat('d-m-Y', $params['date']);

        $note = $this->getNoteService()->updateNote(
            $id,
            $params['nbPoint'],
            $params['coefficient'],
            $params['appreciation'],
            $date,
            $params['idMatiere'],
            $params['idEleve']
        );

        if ($note === null) {
            self::response(self::STATUS_NOT_IMPLEMENTED);
            return;
        }

        self::response(self::STATUS_NO_CONTENT);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $status = $this->getNoteService()->deleteNote($id);

        if ($status === false) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        self::response(self::STATUS_OK);
    }

    /**
     * Show options in header
     */
    public function options()
    {
        self::response(self::STATUS_OK, array(), array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'));
    }

    /**
     * @return \App\Service\Note
     */
    public function getNoteService()
    {
        return $this->noteService;
    }

    /**
     * @param \App\Service\Note $noteService
     */
    public function setNoteService($noteService)
    {
        $this->noteService = $noteService;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}