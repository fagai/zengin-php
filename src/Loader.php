<?php

namespace Fagai\ZenginCode;

class Loader
{
    const DATA_PATH = __DIR__ . '/data';

    /**
     * @return array
     */
    public static function getBanks(): array
    {
        return json_decode(file_get_contents(self::DATA_PATH . '/banks.json'), true);
    }

    /**
     * @param string $bankCode
     * @return array
     */
    public static function getBranches(string $bankCode): array
    {
        return json_decode(file_get_contents(self::DATA_PATH . '/branches/' . $bankCode . '.json'), true);
    }
}
