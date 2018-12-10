<?php
declare(strict_types=1);

namespace App\Commands;

/**
 * Class CouterStarted
 */
class CouterStartedEvet implements Evet
{
    private $start;

    /**
     * CouterStarted constructor.
     */
    public function __construct(int $start)
    {
        $this->start = $start;
    }

    public function start() :int
    {
        return $this->start;
    }
}