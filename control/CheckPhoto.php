<?php

class CheckPhoto
{
    private $resultCheckDir;
    private $resultCheckFiles=[];
    private $rootDir;

    public function __construct($absRootDir)
    {
        $this->rootDir = $absRootDir;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    //На вход принимает строку из серии полича + номер полиса. Без пробела
    public function checkExist($polis) {
    }

    public function getCheckExistDir() {
        return $this->resultCheckDir;
    }

    public function getCheckExistFiles() {
        return $this->resultCheckFiles;
    }
}