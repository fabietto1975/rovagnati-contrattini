<?php

namespace backend\common\dao;

/**
 *
 * @author surinif
 */
interface DAOInterface
{
    public function read();
    public function readByID($id);
    public function create($item);
    public function update($item);
    public function delete($id);
}
