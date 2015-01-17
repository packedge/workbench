<?php namespace Packedge\Workbench\Console;

use Illuminate\Console\Command;

class BaseCommand extends Command
{
    public function askForArgument($name, $question)
    {
        if($value = $this->argument($name)) return $value;
        return $this->ask($question);
    }

    public function chooseAnOption($question, array $data)
    {
        return $this->choice($question, $data);
    }
} 