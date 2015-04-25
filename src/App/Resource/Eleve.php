<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 31/03/15
 * Time: 10:32
 */

namespace App\Resource;

use App\Resource;
use App\Service\Eleve as EleveService;
use Carbon\Carbon;

class Eleve extends Resource
{
    /**
     * @var \App\Service\Matiere
     */
    private $eleveService;

    /**
     * Get eleve service
     */
    public function init()
    {
        $this->setEleveService(new EleveService($this->getEntityManager()));
    }

    /**
     * @param null $id
     */
    public function get($id = null)
    {
        if ($id === null) {
            $data = $this->getEleveService()->getEleves();
        } else {
            $data = $this->getEleveService()->getEleve($id);
        }

        if ($data === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        $response = array('eleve' => $data);
        self::response(self::STATUS_OK, $response);
    }

    /**
     * Create Eleve
     */
    public function post()
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);

        if(array_key_exists("filtre", $params))
        {
            $data = $this->getEleveService()->getEleveWithFiltre($params['filtre']);

            if ($data === null) {
                self::response(self::STATUS_NOT_FOUND);
                return;
            }

            $response = array('eleves' => $data);
            self::response(self::STATUS_OK, $response);

        } else {

            if (empty($params['idClasse']) || empty($params['firstName']) || empty($params['lastName']) || empty($params['email']) || empty($params['dateOfBirth'])
                || $params['idClasse'] === null || $params['firstName'] === null || $params['lastName'] === null || $params['email'] === null || $params['dateOfBirth'] === null) {
                self::response(self::STATUS_BAD_REQUEST);
                return;
            }

            $note = $this->getEleveService()->createEleve(
                $params['idClasse'],
                $params['firstName'],
                $params['lastName'],
                $params['email'],
                Carbon::createFromFormat('d-m-Y', $params['dateOfBirth'])
            );

            self::response(self::STATUS_CREATED, array('eleve', $note));
        }
    }

    /**
     * Update matiere
     */
    public function put($id)
    {
        $params = json_decode($this->getSlim()->request()->getBody(), true);

        if (empty($params['idClasse']) && empty($params['firstName']) && empty($params['lastName']) && empty($params['email']) && empty($params['password']) && empty($params['dateOfBirth'])
            || $params['idClasse'] === null && $params['firsName'] === null && $params['lastName'] === null && $params['email'] === null && $params['password'] === null && $params['dateOfBirth'] === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $dateOfBirth = Carbon::createFromFormat('d-m-Y', $params['dateOfBirth']);

        $note = $this->getEleveService()->updateEleve(
            $id,
            $params['idClasse'],
            $params['firstName'],
            $params['lastName'],
            $params['email'],
            $dateOfBirth
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
        $status = $this->getEleveService()->deleteEleve($id);

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
     * @return \App\Service\Eleve
     */
    public function getEleveService()
    {
        return $this->eleveService;
    }

    /**
     * @param \App\Service\Eleve $eleveService
     */
    public function setEleveService($eleveService)
    {
        $this->eleveService = $eleveService;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}