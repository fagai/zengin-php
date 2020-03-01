<?php

namespace Fagai\ZenginCode;

class ZenginCode
{
    /**
     * @param $code
     * @return Bank
     */
    public static function bank($code): Bank
    {
        return self::getBanks()[$code];
    }

    /**
     * @return Bank[]
     */
    public static function getBanks(): array
    {
        $banks = json_decode(file_get_contents(self::getDataPath() . '/banks.json'), true);
        foreach ($banks as $code => $bank) {
            $banks[$code] = new Bank(
                $bank['code'],
                $bank['name'],
                $bank['kana'],
                $bank['hira'],
                $bank['roma']
            );
        }
        return $banks;
    }

    /**
     * @param string $bankCode
     * @return Branch[]
     */
    public static function getBranches(string $bankCode): array
    {
        $branches = json_decode(file_get_contents(self::getDataPath() . '/branches/' . $bankCode . '.json'), true);
        foreach ($branches as $code => $branch) {
            $branches[$code] = new Branch(
                $branch['code'],
                $branch['name'],
                $branch['kana'],
                $branch['hira'],
                $branch['roma']
            );
        }
        return $branches;
    }

    /**
     * @return string
     */
    public static function getDataPath(): string
    {
        $path = '/fagai/zengin-data/data';

        // project vendor directory
        if (file_exists(__DIR__ . '/../../..' . $path)) {
            return __DIR__ . '/../../..' . $path;
        }

        // package vendor directory
        return __DIR__ . '/../vendor' . $path;
    }
}
