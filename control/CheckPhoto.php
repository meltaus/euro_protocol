<?php

class CheckPhoto
{
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
        $number = 0;
        $outputDir = $this->rootDir . "/" . $polis . "/";
        if (file_exists($outputDir)) {
            //пропускаем точки
            $skip = array('.', '..');
            $files = scandir($outputDir);
            foreach ($files as $file) {
                if (!in_array($file, $skip))
                    $this->resultCheckFiles[$number][] = $file;
            }
            if (count($this->resultCheckFiles[$number]) != 0) {
                $number++;
            }
        }
    }

    public function getCheckExistFiles() {
        return $this->resultCheckFiles;
    }
}