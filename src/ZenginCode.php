<?php

namespace Fagai\ZenginCode;

class ZenginCode
{
    public const DATA_PATH = __DIR__ . '/../zengin/data';

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
        $banks = json_decode(file_get_contents(self::DATA_PATH . '/banks.json'), true);
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
        $branches = json_decode(file_get_contents(self::DATA_PATH . '/branches/' . $bankCode . '.json'), true);
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
}
