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
 * Class Diglin_Mssql_Model_Resource_Type_Db_Mssql
 */
class Diglin_Mssql_Model_Resource_Type_Db_Mssql extends Mage_Core_Model_Resource_Type_Db
{
    /**
     * Get Connection
     *
     * @param Array $config
     * @return Varien_Db_Adapter_Mysqli
     */
    public function getConnection($config)
    {
        $configArr = (array)$config;
        $configArr['profiler'] = !empty($configArr['profiler']) && $configArr['profiler']!=='false';

        $conn = new Diglin_Mssql_Model_Db_Adapter_Mssql($configArr);

        if (!empty($configArr['initStatements']) && $conn) {
            $conn->query($configArr['initStatements']);
        }

        return $conn;
    }
}