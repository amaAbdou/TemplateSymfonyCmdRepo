<?php
declare(strict_types=1);

namespace App\Commands;

/**
 * Class Couter
 */
class Couter
{

    private $value;

    /** @var Evet[] */
    private $evets = [];


    public function __construct($iValue = 0, array $evets = [])
    {
        if ( !empty($evets)) {
            foreach ($evets  as $evet) {
                $this->apply($evet);
            }
            $this->evets = $evets;
        }else {
            $evet = new CouterStartedEvet($iValue);
            $this->emit($evet);
        }
    }

    public function getValue()
    {
        return $this->value;
    }

    public function increment()
    {
        $evet = new CouterIcrementEvent();
        $this->emit($evet);
    }

    public function getEvets() : array
    {
        return $this->evets;
    }

    private function emit(Evet $evet)
    {
        switch (\get_class($evet)){
            case CouterStartedEvet::class:
                if ($this->value!==null) {
                    throw new \Exception('Couter already started');
                };
                $this->evets[] = $evet;
                $this->apply($evet);
                break;
            case CouterIcrementEvent::class:
                if ($this->value===null) {
                    throw new \Exception('Couter did not started');
                };
                $this->evets[] = $evet;
                $this->apply($evet);
                break;
            default:
                throw new \Exception(sprintf('Given evet [%s] is ot recogized', \get_class($evet)));
                break;
        }
    }

    private function apply($evet)
    {
        switch (\get_class($evet)){
            case CouterStartedEvet::class:
                $this->value = $evet->start();
                break;
            case CouterIcrementEvent::class:
                ++$this->value;
                break;
            default:
                throw new \Exception(sprintf('Given evet [%s] is ot recogized', \get_class($evet)));
                break;
        }    }
}