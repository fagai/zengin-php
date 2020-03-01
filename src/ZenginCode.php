<?php

namespace Fagai\ZenginCode;

use Fagai\ZenginData\Loader;

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
        $banks = Loader::getBanks();
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
        $branches = Loader::getBranches($bankCode);
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
