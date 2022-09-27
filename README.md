# Doctrine DBAL 2 SQL Parser Utils Replacement

Replaces doctrine/dbal 2.x SQLParserUtils by "preloading" it via Composer "files" autoloading.
This solves the performance issues of the old implementation when no migration to Doctrine DBAL 3.4+
is possible in the short term.

```shell
$ composer require tideways/dbal-sqlparserutils-replacement
```

Nothing more needs to be done, unless you do not use MySQL then you must set early in bootstrap:

```php
\Doctrine\DBAL\SQLParserUtils::$isMySQL = false;
```
