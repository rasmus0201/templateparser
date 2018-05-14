<?php
/*Script to get execution time*/
//https://stackoverflow.com/questions/535020/tracking-the-script-execution-time-in-php

class ExecutionTime
{
    private $startTime;
    private $endTime;

    public function Start(){
        $this->startTime = getrusage();
    }

    public function End(){
        $this->endTime = getrusage();
    }

    private function runTime($ru, $rus, $index) {
        return (($ru["ru_$index.tv_sec"] + intval($ru["ru_$index.tv_usec"])) - ($rus["ru_$index.tv_sec"] + intval($rus["ru_$index.tv_usec"]))) / 1000;
    }

    public function __toString(){
        return "This process used " . $this->runTime($this->endTime, $this->startTime, "utime") .
        " ms for its computations\nIt spent " . $this->runTime($this->endTime, $this->startTime, "stime") .
        " ms in system calls\n";
    }
}
