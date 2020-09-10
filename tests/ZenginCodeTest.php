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
        $banks = $this->zengin::searchBanks('0001');
        self::assertCount(1, $banks);

        $banks = $this->zengin::searchBanks('みずほ');
        self::assertNotCount(0, $banks);
        self::assertArrayHasKey('0001', $banks);

        $banks = $this->zengin::searchBanks('ミズホ');
        self::assertNotCount(0, $banks);
        self::assertArrayHasKey('0001', $banks);

        $banks = $this->zengin::searchBanks('UFJ');
        self::assertArrayHasKey('0005', $banks);

        $banks = $this->zengin::searchBanks('mizuho');
        self::assertArrayHasKey('0001', $banks);

        $banks = $this->zengin::searchBanks('しょうない');
        self::assertNotCount(0, $banks);
        self::assertArrayHasKey('0121', $banks);
    }

    public function testBankSearchStartWith()
    {
        $banks = $this->zengin::searchBanksForStartWith('み');
        self::assertNotCount(0, $banks);
        self::assertArrayHasKey('0001', $banks);

        $banks = $this->zengin::searchBanksForStartWith('ミ');
        self::assertNotCount(0, $banks);
        self::assertArrayHasKey('0001', $banks);

        $banks = $this->zengin::searchBanksForStartWith('mi');
        self::assertNotCount(0, $banks);
        self::assertArrayHasKey('0001', $banks);
    }

    public function testBranchSearch()
    {
        $branches = $this->zengin::bank('0001')->searchBranches('001');
        self::assertCount(1, $branches);

        $branches = $this->zengin::bank('0001')->searchBranches('とうきょう');
        self::assertNotCount(0, $branches);
        self::assertArrayHasKey('001', $branches);

        $branches = $this->zengin::bank('0001')->searchBranches('トウキョウ');
        self::assertNotCount(0, $branches);
        self::assertArrayHasKey('001', $branches);

        $branches = $this->zengin::bank('0001')->searchBranches('東京営業部');
        self::assertCount(1, $branches);
        self::assertArrayHasKey('001', $branches);

        $branches = $this->zengin::bank('0001')->searchBranches('toukiyoutochiyou');
        self::assertCount(1, $branches);

        $branches = $this->zengin::bank('0001')->searchBranchesForStartWith('東');
        self::assertNotCount(0, $branches);
        self::assertArrayHasKey('001', $branches);

        $branches = $this->zengin::bank('0001')->searchBranchesForStartWith('とうきょ');
        self::assertNotCount(0, $branches);
        self::assertArrayHasKey('001', $branches);

        $branches = $this->zengin::bank('0001')->searchBranchesForStartWith('トウキョ');
        self::assertNotCount(0, $branches);
        self::assertArrayHasKey('001', $branches);

        $branches = $this->zengin::bank('0001')->searchBranchesForStartWith('tou');
        self::assertNotCount(0, $branches);
        self::assertArrayHasKey('001', $branches);
    }
}
