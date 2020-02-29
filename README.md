# Zengin-php

PHP implementation using [zengin-code/source-data](https://github.com/zengin-code/source-data)

# Requirements

* PHP7.2 or later

# Install

```
composer require fagai/zengin-code
```

# Usage

```php
Fagai\ZenginCode\ZenginCode::bank('0001');
/*
object(Fagai\ZenginCode\Bank) {
  ["code"]=>
  string(4) "0001"
  ["name"]=>
  string(9) "みずほ"
  ["katakana"]=>
  string(9) "ミズホ"
  ["hiragana"]=>
  string(9) "みずほ"
  ["romaji"]=>
  string(6) "mizuho"
}
 */
```

```php
Fagai\ZenginCode\ZenginCode::bank('0001')->branch('001');
/*
  object(Fagai\ZenginCode\Branch) {
     ["code"]=>
     string(3) "001"
     ["name"]=>
     string(15) "東京営業部"
     ["katakana"]=>
     string(15) "トウキヨウ"
     ["hiragana"]=>
     string(15) "とうきよう"
     ["romaji"]=>
     string(8) "toukiyou"
   }
 */
```

# License

MIT