<?php

use \Fagai\ZenginCode\ZenginCode;

class ZenginCodeTest extends PHPUnit\Framework\TestCase
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

    public function testBankSearch()
    {
        $banks = $this->zengin::searchBanks('みずほ');
        self::assertNotCount(0, $banks);
    }

    public function testBankSearchStartWith()
    {
        $banks = $this->zengin::searchBanksForStartWith('み');
        self::assertNotCount(0, $banks);
    }

    public function test小文字の英字で銀行取得できるか()
    {
        $banks = $this->zengin::searchBanks('UFJ');
        self::assertArrayHasKey('0005', $banks);
    }

    public function test小文字ひらがな銀行検索できるか()
    {
        $banks = $this->zengin::searchBanks('しょうない');
        self::assertNotCount(0, $banks);
    }
}
