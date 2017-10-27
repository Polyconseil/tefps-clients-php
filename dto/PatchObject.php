<?php

namespace Tefps\TefpsClientsBundle\dto;

class PatchObject
{
    const ADD = 'add';
    const REPLACE = 'replace';
    const REMOVE = 'remove';

    private $op;

    private $path;

    private $index;

    private $value;

    public function getOp() {
        return $this->op;
    }

    public function setOp($op) {
        $this->op = $op;
    }

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function getIndex() {
        return $this->index;
    }

    public function setIndex($index) {
        $this->index = $index;
    }
}
