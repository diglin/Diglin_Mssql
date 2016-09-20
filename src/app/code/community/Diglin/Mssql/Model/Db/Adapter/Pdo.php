<?php
/**
 * Diglin GmbH - Switzerland
 *
 * @author      Sylvain Rayé <support at diglin.com>
 * @category    Diglin
 * @package     Diglin_Mssql
 * @copyright   Copyright (c) 2011-2016 Diglin (http://www.diglin.com)
 */

/**
 * Class Diglin_Mssql_Model_Db_Adapter_Pdo
 */
class Diglin_Mssql_Model_Db_Adapter_Pdo extends Zend_Db_Adapter_Pdo_Mssql implements Varien_Db_Adapter_Interface
{
    protected function _dsn()
    {
        if (isset($this->_config['type'])) {
            $this->_config['pdoType'] = $this->_config['type'];
        }

        return parent::_dsn();
    }

    public function newTable($tableName = null, $schemaName = null)
    {
        // TODO: Implement newTable() method.
    }

    public function createTable(Varien_Db_Ddl_Table $table)
    {
        // TODO: Implement createTable() method.
    }

    public function createTemporaryTable(Varien_Db_Ddl_Table $table)
    {
        // TODO: Implement createTemporaryTable() method.
    }

    public function dropTable($tableName, $schemaName = null)
    {
        // TODO: Implement dropTable() method.
    }

    public function dropTemporaryTable($tableName, $schemaName = null)
    {
        // TODO: Implement dropTemporaryTable() method.
    }

    public function truncateTable($tableName, $schemaName = null)
    {
        // TODO: Implement truncateTable() method.
    }

    public function isTableExists($tableName, $schemaName = null)
    {
        // TODO: Implement isTableExists() method.
    }

    public function showTableStatus($tableName, $schemaName = null)
    {
        $query = sprintf('exec sp_columns %s', $this->quote($tableName));

        return $this->fetchRow($query);
    }

    public function createTableByDdl($tableName, $newTableName)
    {
        // TODO: Implement createTableByDdl() method.
    }

    public function modifyColumnByDdl($tableName, $columnName, $definition, $flushData = false, $schemaName = null)
    {
        // TODO: Implement modifyColumnByDdl() method.
    }

    public function renameTable($oldTableName, $newTableName, $schemaName = null)
    {
        // TODO: Implement renameTable() method.
    }

    public function renameTablesBatch(array $tablePairs)
    {
        // TODO: Implement renameTablesBatch() method.
    }

    public function addColumn($tableName, $columnName, $definition, $schemaName = null)
    {
        // TODO: Implement addColumn() method.
    }

    public function changeColumn($tableName, $oldColumnName, $newColumnName, $definition, $flushData = false,
                                 $schemaName = null)
    {
        // TODO: Implement changeColumn() method.
    }

    public function modifyColumn($tableName, $columnName, $definition, $flushData = false, $schemaName = null)
    {
        // TODO: Implement modifyColumn() method.
    }

    public function dropColumn($tableName, $columnName, $schemaName = null)
    {
        // TODO: Implement dropColumn() method.
    }

    public function tableColumnExists($tableName, $columnName, $schemaName = null)
    {
        // TODO: Implement tableColumnExists() method.
    }

    public function addIndex($tableName, $indexName, $fields, $indexType = self::INDEX_TYPE_INDEX, $schemaName = null)
    {
        // TODO: Implement addIndex() method.
    }

    public function dropIndex($tableName, $keyName, $schemaName = null)
    {
        // TODO: Implement dropIndex() method.
    }

    public function getIndexList($tableName, $schemaName = null)
    {
        // TODO: Implement getIndexList() method.
    }

    public function addForeignKey($fkName, $tableName, $columnName, $refTableName, $refColumnName,
                                  $onDelete = self::FK_ACTION_CASCADE, $onUpdate = self::FK_ACTION_CASCADE,
                                  $purge = false, $schemaName = null, $refSchemaName = null)
    {
        // TODO: Implement addForeignKey() method.
    }

    public function dropForeignKey($tableName, $fkName, $schemaName = null)
    {
        // TODO: Implement dropForeignKey() method.
    }

    public function getForeignKeys($tableName, $schemaName = null)
    {
        // TODO: Implement getForeignKeys() method.
    }

    public function insertOnDuplicate($table, array $data, array $fields = array())
    {
        // TODO: Implement insertOnDuplicate() method.
    }

    public function insertMultiple($table, array $data)
    {
        // TODO: Implement insertMultiple() method.
    }

    public function insertArray($table, array $columns, array $data)
    {
        // TODO: Implement insertArray() method.
    }

    public function insertForce($table, array $bind)
    {
        // TODO: Implement insertForce() method.
    }

    public function insertIgnore($table, array $bind)
    {
        // TODO: Implement insertIgnore() method.
    }

    public function multiQuery($sql)
    {
        // TODO: Implement multiQuery() method.
    }

    public function formatDate($date, $includeTime = true)
    {
        // TODO: Implement formatDate() method.
    }

    public function startSetup()
    {
        // TODO: Implement startSetup() method.
    }

    public function endSetup()
    {
        // TODO: Implement endSetup() method.
    }

    public function setCacheAdapter($adapter)
    {
        // TODO: Implement setCacheAdapter() method.
    }

    public function allowDdlCache()
    {
        // TODO: Implement allowDdlCache() method.
    }

    public function disallowDdlCache()
    {
        // TODO: Implement disallowDdlCache() method.
    }

    public function resetDdlCache($tableName = null, $schemaName = null)
    {
        // TODO: Implement resetDdlCache() method.
    }

    public function saveDdlCache($tableCacheKey, $ddlType, $data)
    {
        // TODO: Implement saveDdlCache() method.
    }

    public function loadDdlCache($tableCacheKey, $ddlType)
    {
        // TODO: Implement loadDdlCache() method.
    }

    public function prepareSqlCondition($fieldName, $condition)
    {
        // TODO: Implement prepareSqlCondition() method.
    }

    public function prepareColumnValue(array $column, $value)
    {
        // TODO: Implement prepareColumnValue() method.
    }

    public function getCheckSql($condition, $true, $false)
    {
        // TODO: Implement getCheckSql() method.
    }

    public function getCaseSql($valueName, $casesResults, $defaultValue = null)
    {
        // TODO: Implement getCaseSql() method.
    }

    public function getIfNullSql($expression, $value = 0)
    {
        // TODO: Implement getIfNullSql() method.
    }

    public function getConcatSql(array $data, $separator = null)
    {
        // TODO: Implement getConcatSql() method.
    }

    public function getLengthSql($string)
    {
        // TODO: Implement getLengthSql() method.
    }

    public function getLeastSql(array $data)
    {
        // TODO: Implement getLeastSql() method.
    }

    public function getGreatestSql(array $data)
    {
        // TODO: Implement getGreatestSql() method.
    }

    public function getDateAddSql($date, $interval, $unit)
    {
        // TODO: Implement getDateAddSql() method.
    }

    public function getDateSubSql($date, $interval, $unit)
    {
        // TODO: Implement getDateSubSql() method.
    }

    public function getDateFormatSql($date, $format)
    {
        // TODO: Implement getDateFormatSql() method.
    }

    public function getDatePartSql($date)
    {
        // TODO: Implement getDatePartSql() method.
    }

    public function getSubstringSql($stringExpression, $pos, $len = null)
    {
        // TODO: Implement getSubstringSql() method.
    }

    public function getStandardDeviationSql($expressionField)
    {
        // TODO: Implement getStandardDeviationSql() method.
    }

    public function getDateExtractSql($date, $unit)
    {
        // TODO: Implement getDateExtractSql() method.
    }

    public function getTableName($tableName)
    {
        // TODO: Implement getTableName() method.
    }

    public function getIndexName($tableName, $fields, $indexType = '')
    {
        // TODO: Implement getIndexName() method.
    }

    public function getForeignKeyName($priTableName, $priColumnName, $refTableName, $refColumnName)
    {
        // TODO: Implement getForeignKeyName() method.
    }

    public function disableTableKeys($tableName, $schemaName = null)
    {
        // TODO: Implement disableTableKeys() method.
    }

    public function enableTableKeys($tableName, $schemaName = null)
    {
        // TODO: Implement enableTableKeys() method.
    }

    public function insertFromSelect(Varien_Db_Select $select, $table, array $fields = array(), $mode = false)
    {
        // TODO: Implement insertFromSelect() method.
    }

    public function selectsByRange($rangeField, Varien_Db_Select $select, $stepCount = 100)
    {
        // TODO: Implement selectsByRange() method.
    }

    public function updateFromSelect(Varien_Db_Select $select, $table)
    {
        // TODO: Implement updateFromSelect() method.
    }

    public function deleteFromSelect(Varien_Db_Select $select, $table)
    {
        // TODO: Implement deleteFromSelect() method.
    }

    public function getTablesChecksum($tableNames, $schemaName = null)
    {
        // TODO: Implement getTablesChecksum() method.
    }

    public function supportStraightJoin()
    {
        // TODO: Implement supportStraightJoin() method.
    }

    public function orderRand(Varien_Db_Select $select, $field = null)
    {
        // TODO: Implement orderRand() method.
    }

    public function forUpdate($sql)
    {
        // TODO: Implement forUpdate() method.
    }

    public function getPrimaryKeyName($tableName, $schemaName = null)
    {
        // TODO: Implement getPrimaryKeyName() method.
    }

    public function decodeVarbinary($value)
    {
        // TODO: Implement decodeVarbinary() method.
    }

    public function getSuggestedZeroDate()
    {
        // TODO: Implement getSuggestedZeroDate() method.
    }

    public function dropTrigger($triggerName)
    {
        // TODO: Implement dropTrigger() method.
    }

    public function getTransactionLevel()
    {
        // TODO: Implement getTransactionLevel() method.
    }

    public function getUnixTimestamp($date)
    {
        // TODO: Implement getUnixTimestamp() method.
    }

    public function fromUnixtime($timestamp)
    {
        // TODO: Implement fromUnixtime() method.
    }

    public function changeTableAutoIncrement($tableName, $increment, $schemaName = null)
    {
        // TODO: Implement changeTableAutoIncrement() method.
    }

    public function createTableFromSelect($tableName, Zend_Db_Select $select, $temporary = false)
    {
        // TODO: Implement createTableFromSelect() method.
    }


}