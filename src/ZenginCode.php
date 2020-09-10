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
        static $banks;
        if (is_array($banks) && count($banks)) {
            return $banks;
        }

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
     * @param string $keyword
     * @return Bank[]
     */
    public static function searchBanks(string $keyword): array
    {
        $keyword = mb_convert_kana($keyword, 'KA');
        return array_filter(
            self::getBanks(),
            function ($bank) use ($keyword) {
                if (strpos($bank->code, $keyword) !== false) {
                    return true;
                }
                if (strpos($bank->name, $keyword) !== false) {
                    return true;
                }
                if (strpos($bank->hiragana, ZenginCode::kanaToUpper($keyword)) !== false) {
                    return true;
                }
                if (strpos($bank->katakana, ZenginCode::kanaToUpper($keyword)) !== false) {
                    return true;
                }
                if (strpos($bank->romaji, mb_strtolower(mb_convert_kana($keyword, 'ak'))) !== false) {
                    return true;
                }
                return false;
            }
        );
    }

    /**
     * @param string $prefix
     * @return Bank[]
     */
    public static function searchBanksForStartWith(string $prefix): array
    {
        $prefix = mb_convert_kana($prefix, 'KA');
        return array_filter(
            self::getBanks(),
            function ($bank) use ($prefix) {
                if (strpos($bank->name, $prefix) === 0) {
                    return true;
                }
                if (strpos($bank->hiragana, ZenginCode::kanaToUpper($prefix)) === 0) {
                    return true;
                }
                if (strpos($bank->katakana, ZenginCode::kanaToUpper($prefix)) === 0) {
                    return true;
                }
                if (strpos($bank->romaji, strtolower(mb_convert_kana($prefix, 'ak'))) === 0) {
                    return true;
                }
                return false;
            }
        );
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

    /**
     * 小文字かな/カナを大文字に変えます。
     * @param string $string
     * @return string
     */
    public static function kanaToUpper(string $string): string
    {
        $low = ['ぁ','ぃ','ぅ','ぇ','ぉ','っ','ゃ','ゅ','ょ','ゎ','ァ','ィ','ゥ','ェ','ォ','ッ','ャ','ュ','ョ','ヮ'];
        $up = ['あ','い','う','え','お','つ','や','ゆ','よ','わ','ア','イ','ウ','エ','オ','ツ','ヤ','ユ','ヨ','ワ'];
        return str_replace($low, $up, $string);
    }
}
