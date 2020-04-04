<?php

namespace Application\Controller;

use Application\Model\AttributeModel;
use Application\Repository\AttributeRepository;

// responsible for handling request associated with attribute entity
class AttributeController
{
    public $attributeRepository;

    public function __construct($database)
    {
        $this->attributeRepository = new AttributeRepository($database->pdo);
    }

    public function create($request)
    {
        $attribute = AttributeModel::fromArray($request->getJSON());

        if ($this->attributeRepository->create($attribute)) {
            echo json_encode($attribute);
        } else {
            http_response_code(409);
        }
    }

    public function findAll($request)
    {
        echo json_encode($this->attributeRepository->findAll());
    }

    public function update($request)
    {
        $attribute = AttributeModel::fromArray($request->getJSON());

        if ($this->attributeRepository->update($attribute)) {
            echo json_encode($attribute);
        } else {
            http_response_code(409);
        }
    }

    public function delete($request)
    {
        if (!$this->attributeRepository->delete($request->getJSON())) {
            http_response_code(404);
        }
    }
}
