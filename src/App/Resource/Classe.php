<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 31/03/15
 * Time: 12:10
 */

namespace App\Resource;

use App\Resource;
use App\Service\Classe as ClasseService;

class Classe extends Resource
{
    /**
     * @var \App\Service\Classe
     */
    private $classeService;

    /**
     * Get classe service
     */
    public function init()
    {
        $this->setClasseService(new ClasseService($this->getEntityManager()));
    }

    /**
     * @param null $id
     */
    public function get($id = null)
    {
        if ($id === null) {
            $data = $this->getClasseService()->getClasses();
        } else {
            $data = $this->getClasseService()->getClasse($id);
        }

        if ($data === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        $response = array('classe' => $data);
        self::response(self::STATUS_OK, $response);
    }

    /**
     * Create Eleve
     */
    public function post()
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);

        if (empty($params['name']) || $params['name'] === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $classe = $this->getClasseService()->createClasse(
            $params['name']
        );

        self::response(self::STATUS_CREATED, array('classe', $classe));
    }

    /**
     * Update classe
     */
    public function put($id)
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);

        if (empty($params['name']) || $params['name'] === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $classe = $this->getClasseService()->updateClasse(
            $id,
            $params['name']
        );

        if ($classe === null) {
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
        $status = $this->getClasseService()->deleteClasse($id);

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
     * @return \App\Service\Classe
     */
    public function getClasseService()
    {
        return $this->classeService;
    }

    /**
     * @param \App\Service\Classe $classeService
     */
    public function setClasseService($classeService)
    {
        $this->classeService = $classeService;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}