<?php
declare(strict_types=1);

namespace Tests\Commands;

use App\Commands\Couter;
use App\Commands\CouterIcrementEvent;
use App\Commands\CouterStartedEvet;
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
        $couter = new Couter();
        $this->assertSame($couter->getValue(), 0);
        $this->assertCount(1, $couter->getEvets());
        $this->isInstanceOf(CouterStartedEvet::class, $couter->getEvets()[0]);

        $couter->increment();
        $this->assertSame($couter->getValue(), 1);
        $this->assertCount(2, $couter->getEvets());
        $this->isInstanceOf(CouterIcrementEvent::class, $couter->getEvets()[0]);
    }

    public function testIitialCouter()
    {
        $couter = new Couter(5);
        $this->assertSame($couter->getValue(), 5);
    }

    public function testCostructValuesFromEvets()
    {
        $evets = [
          new CouterStartedEvet(1),
          new CouterIcrementEvent(),
        ];

        $couter = new Couter(0, $evets);
        $this->assertSame($couter->getValue(), 2);
        $this->assertCount(2, $couter->getEvets());
    }
}
