<?php

namespace Doctrine\DBAL;

use Doctrine\DBAL\SQL\Parser;

class SQLParserUtils
{
    public static bool $isMySQL = true;
    private static ?Parser $sqlParser = null;

    /**
     * For a positional query this method can rewrite the sql statement with regard to array parameters.
     *
     * @param string         $sql  The SQL query to execute.
     * @param mixed[]        $params The parameters to bind to the query.
     * @param int[]|string[] $types  The types the previous parameters are in.
     *
     * @return mixed[]
     *
     * @throws SQLParserUtilsException
     */
    public static function expandListParameters($sql, $params, $types)
    {
        if (self::$sqlParser === null) {
            self::$sqlParser = new Parser(self::$isMySQL);
        }

        $visitor = new ExpandArrayParameters($params, $types);

        self::$sqlParser->parse($sql, $visitor);

        return [
            $visitor->getSQL(),
            $visitor->getParameters(),
            $visitor->getTypes(),
        ];
    }
}
