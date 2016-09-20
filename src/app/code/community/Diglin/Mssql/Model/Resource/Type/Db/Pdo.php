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
 * Class Diglin_Mssql_Model_Resource_Type_Db_Pdo
 */
class Diglin_Mssql_Model_Resource_Type_Db_Pdo extends Mage_Core_Model_Resource_Type_Db
{
    /**
     * Get Connection
     *
     * @param array $config
     * @return Varien_Db_Adapter_Mysqli
     */
    public function getConnection($config)
    {
        $configArr = (array)$config;
        $configArr['profiler'] = !empty($configArr['profiler']) && $configArr['profiler'] !== 'false';
        $configArr['pdoType'] = str_replace('pdo_', '', $configArr['type']);

        $conn = new Zend_Db_Adapter_Pdo_Mssql($configArr);

        if (!empty($configArr['initStatements']) && $conn) {
            $conn->query($configArr['initStatements']);
        }

        return $conn;
    }
}