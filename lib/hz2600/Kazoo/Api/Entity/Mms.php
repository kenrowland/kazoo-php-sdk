<?php

namespace Kazoo\Api\Entity;

use RuntimeException;

class Mms extends AbstractEntity
{
    protected function getCollectionName()
    {
        return 'mms';
    }

    protected function getPayload()
    {
        if ($this->to && $this->from && $this->body)
        {
            $payload = "{ \"data\":{ \"to\": \"{$this->to}\", \"from\": \"{$this->from}\", \"body\": \"{$this->body}\" } }";
            return $payload;
        }
        else
        {
            throw new RuntimeException('Send MMS missing one or more of to, from, or body');
        }
    }


}