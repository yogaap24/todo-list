<?php

namespace App\Service;

interface AppInterfaceService
{
    public function getAll();

    public function getPaginated($search = null, $perPage = 15);

    public function getById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}
