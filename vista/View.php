<?php

class View

{ 


public function getInput(string $mensaje): string
{
    echo "\n\033[1;36m$mensaje\033[0m ";
    return trim(fgets(STDIN));          
}


public function showMessage(string $message): void
{
    echo "\n\033[1;31m$message\033[0m\n";
}
}
