<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/25
 * Time: 17:00
 */

namespace App\Repositories;


/**
 * Class EloquentRepository
 * @package App\Repositories
 */
abstract class EloquentRepository implements RepositoryInterface
{

    /**
     * 注入的model
     * @var
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    function __construct()
    {
        $this->setModel();
    }

    /**
     * @return mixed
     */
    abstract public function getModel();

    /**
     *
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }


    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->_model->all();
    }


    /**
     * 根据主键查找
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->_model->find($id);
    }


    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }


    /**
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }


    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if($result) {
            $result->delete();
            return true;
        }
        return false;
    }

}