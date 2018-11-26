<?php
declare(strict_types=1);

namespace Tests\Commands;

use App\Exceptions\NotImplementedException;
use PHPUnit\Framework\TestCase;
use App\Commands\DefaultCommand;
use Prophecy\Prophet;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DefaultCommandTest extends TestCase
{
    private $prophet;
    private $input;
    private $output;

    protected function setUp() {
        $this->prophet = new Prophet();
        $this->input = $this->prophet->prophesize(InputInterface::class);
        $this->output = $this->prophet->prophesize(OutputInterface::class);
    }

    public function testExecute()
    {
        $this->expectException(NotImplementedException::class);
        $command = new DefaultCommand();
        $command->execute($this->input->reveal(), $this->output->reveal());
    }
}
