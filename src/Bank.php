<?php

namespace Fagai\ZenginCode;

class Bank
{
    /** @var string 金融機関コード */
    public $code;
    /** @var string 金融機関名 */
    public $name;
    /** @var string カタカナ表記 */
    public $katakana;
    /** @var string ひらがな表記 */
    public $hiragana;
    /** @var string ローマ字表記 */
    public $romaji;

    /**
     * Bank constructor.
     * @param string $code
     * @param string $name
     * @param string $katakana
     * @param string $hiragana
     * @param string $romaji
     */
    public function __construct(string $code, string $name, string $katakana, string $hiragana, string $romaji)
    {
        $this->code = $code;
        $this->name = $name;
        $this->katakana = $katakana;
        $this->hiragana = $hiragana;
        $this->romaji = $romaji;
    }

    /**
     * @return Branch[]
     */
    public function getBranches(): array
    {
        return ZenginCode::getBranches($this->code);
    }

    /**
     * @param $code
     * @return Branch
     */
    public function branch(string $code): Branch
    {
        return $this->getBranches()[$code];
    }

    /**
     * @param string $keyword
     * @return array
     */
    public function searchBranches(string $keyword): array
    {
        $prefix = mb_convert_kana($keyword, 'KA');
        return array_filter(
            $this->getBranches(),
            function ($branch) use ($keyword) {
                if (strpos($branch->code, $keyword) !== false) {
                    return true;
                }
                if (strpos($branch->name, $keyword) !== false) {
                    return true;
                }
                if (strpos($branch->hiragana, ZenginCode::kanaToUpper($keyword)) !== false) {
                    return true;
                }
                if (strpos($branch->katakana, ZenginCode::kanaToUpper($keyword)) !== false) {
                    return true;
                }
                if (strpos($branch->romaji, strtolower(mb_convert_kana($keyword, 'ak'))) !== false) {
                    return true;
                }
                return false;
            }
        );
    }

    /**
     * @param string $prefix
     * @return array
     */
    public function searchBranchesForStartWith(string $prefix): array
    {
        $prefix = mb_convert_kana($prefix, 'KA');
        return array_filter(
            $this->getBranches(),
            function ($branch) use ($prefix) {
                if (strpos($branch->name, $prefix) === 0) {
                    return true;
                }
                if (strpos($branch->hiragana, ZenginCode::kanaToUpper($prefix)) === 0) {
                    return true;
                }
                if (strpos($branch->katakana, ZenginCode::kanaToUpper($prefix)) === 0) {
                    return true;
                }
                if (strpos($branch->romaji, strtolower(mb_convert_kana($prefix, 'ak'))) === 0) {
                    return true;
                }
                return false;
            }
        );
    }
}
