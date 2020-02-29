<?php

use \Fagai\ZenginCode\ZenginCode;

class ZenginTest extends PHPUnit\Framework\TestCase
{
    protected $zengin;

    public function setUp(): void
    {
        $this->zengin = new ZenginCode();
    }

    public function testGetBank()
    {
        $bank = $this->zengin::bank('0001');
        self::assertInstanceOf(\Fagai\ZenginCode\Bank::class, $bank);
    }

    public function testGetBranch()
    {
        $branch = $this->zengin::bank('0001')->branch('001');
        self::assertInstanceOf(\Fagai\ZenginCode\Branch::class, $branch);
    }
}