<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 26/03/15
 * Time: 17:47
 */

namespace App\Resource;

use App\Resource;
use App\Service\Matiere as MatiereService;
use Carbon\Carbon;

class Matiere extends Resource {
    /**
     * @var \App\Service\Matiere
     */
    private $matiereService;

    /**
     * Get matiere service
     */
    public function init()
    {
        $this->setNoteService(new MatiereService($this->getEntityManager()));
    }

    /**
     * @param null $id
     */
    public function get($id = null)
    {
        if ($id === null) {
            $data = $this->getMatiereService()->getMatieres();
        } else {
            $data = $this->getMatiereService()->getMatiere($id);
        }

        if ($data === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        $response = array('matiere' => $data);
        self::response(self::STATUS_OK, $response);
    }

    /**
     * Create matiere
     */
    public function post()
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);

        if (empty($params['nom']) || empty($params['coefficient'])
            || $params['nom'] === null || $params['coefficient'] === null || $params['description'] === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $note = $this->getMatiereService()->createMatiere(
            $params['nom'],
            $params['coefficient'],
            $params['description']
        );

        self::response(self::STATUS_CREATED, array('matieres', $note));
    }

    /**
     * Update matiere
     */
    public function put($id)
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);

        if (empty($params['nom']) && empty($params['coefficient']) && empty($params['description'])
            || $params['nom'] === null && $params['coefficient'] === null && $params['description'] === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $matiere = $this->getMatiereService()->updateMatiere(
            $id,
            $params['nom'],
            $params['coefficient'],
            $params['description']
        );

        if ($matiere === null) {
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
        $status = $this->getMatiereService()->deleteMatiere($id);

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
     * @return \App\Service\Matiere
     */
    public function getMatiereService()
    {
        return $this->matiereService;
    }

    /**
     * @param \App\Service\Matiere $matiereService
     */
    public function setNoteService($matiereService)
    {
        $this->matiereService = $matiereService;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}