<?php
namespace Kazoo\Api\Collection;

class Cdrs extends AbstractCollection
{
    public function legs($cdrId) {
        $response = $this->get(array(), "/legs/$cdrId");
        $this->setCollection($response->getData());
        return $this;
    }
}
