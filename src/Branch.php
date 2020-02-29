<?php

namespace Fagai\ZenginCode;

class Branch
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
     * Branch constructor.
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
}
