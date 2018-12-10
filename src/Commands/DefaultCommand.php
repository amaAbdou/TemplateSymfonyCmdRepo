<?php
namespace App\Commands;

use App\Exceptions\NotImplementedException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DefaultCommand extends Command
{
    protected static $defaultName = 'default';

    public function __construct() {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $couter = new Couter();
        $couter->increment();

        file_put_contents(serialize($couter->getEvets()));
    }
}