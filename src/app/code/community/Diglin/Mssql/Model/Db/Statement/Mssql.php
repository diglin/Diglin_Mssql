<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Db
 * @subpackage Statement
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * Extends for Microsoft SQL Server Driver for PHP
 *
 * @category   Zend
 * @package    Zend_Db
 * @subpackage Statement
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Diglin_Mssql_Model_Db_Statement_Mssql extends Zend_Db_Statement
{

    /**
     * The connection_stmt object original string.
     */
    protected $_originalSQL;

    /**
     * Column names.
     */
    protected $_keys;

    /**
     * Query executed
     */
    protected $_executed = false;

    /**
     * @var
     */
    protected $_result;

    /**
     * Prepares statement handle
     *
     * @param string $sql
     * @return void
     * @throws Exception
     */
    protected function _prepare($sql)
    {
        $connection = $this->_adapter->getConnection();
        $this->_stmt = mssql_init(uniqid('StatementSQL'), $connection);

        if (!$this->_stmt) {
            throw new Exception(mssql_get_last_message());
        }

        $this->_originalSQL = $sql;
    }

    /**
     * Binds a parameter to the specified variable name.
     *
     * @param mixed $parameter Name the parameter, either integer or string.
     * @param mixed $variable  Reference to PHP variable containing the value.
     * @param mixed $type      OPTIONAL Datatype of SQL parameter.
     * @param mixed $length    OPTIONAL Length of SQL parameter.
     * @param mixed $options   OPTIONAL Other options.
     * @return bool
     * @throws Zend_Db_Statement_Exception
     */
    protected function _bindParam($parameter, &$variable, $type = null, $length = null, $options = null)
    {
        $is_output = $is_null = null;

        if(isset($options['is_null'])) {
            $is_null = $options['is_null'];
        }

        if(isset($options['is_output'])) {
            $is_output = $options['is_output'];
        }

        if ($length === NULL) {
            $length = -1;
        }

        if ($is_output === NULL) {
            $is_output = false;
        }

        if ($is_null === NULL) {
            $is_null = false;
        }

        try {
            if ($type === null) {
                if (is_bool($variable)) {
                    $type = SQLINT1;
                } elseif ($variable === null) {
                    $type = SQLCHAR;
                } elseif (is_integer($variable)) {
                    $type = SQLINT4;
                } elseif (mb_strlen($variable) > 255) {
                    $type = SQLTEXT;
                } else {
                    $type = SQLVARCHAR;
                }
            }
            return mssql_bind($this->_stmt, $parameter, $variable, $type, $is_output, $is_null, $length);
        } catch (Exception $e) {
            throw new Zend_Db_Statement_Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Closes the cursor, allowing the statement to be executed again.
     *
     * @return bool
     */
    public function closeCursor()
    {
        if (!$this->_stmt) {
            return false;
        }

        mssql_free_statement($this->_stmt);
        $this->_stmt = false;
        return true;
    }

    /**
     * Returns the number of columns in the result set.
     * Returns null if the statement has no result set metadata.
     *
     * @return int The number of columns.
     */
    public function columnCount()
    {
        if ($this->_stmt && $this->_executed) {
            return mssql_num_fields($this->_stmt);
        }

        return 0;
    }


    /**
     * Retrieves the string code, if any, associated with the last operation on
     * the statement handle.
     *
     * @return string error code.
     */
    public function errorCode()
    {
        if (!$this->_stmt) {
            return false;
        }

        $error = mssql_get_last_message();
        if (!$error) {
            return false;
        }

        return $error;
    }


    /**
     * Retrieves a string of error information, if any, associated with the
     * last operation on the statement handle.
     *
     * @return string
     */
    public function errorInfo()
    {
        if (!$this->_stmt) {
            return false;
        }

        $error = mssql_get_last_message();
        if (!$error) {
            return false;
        }

        return $error;
    }


    /**
     * Executes a prepared statement.
     *
     * @param array $params OPTIONAL Values to bind to parameter placeholders.
     * @return bool
     * @throws Zend_Db_Statement_Exception
     */
    public function _execute(array $params = null)
    {
        if (!$this->_stmt) {
            return false;
        }

        if ($params !== null) {
            if (!is_array($params)) {
                $params = array($params);
            }
            if (array_key_exists(0, $params)) {
                array_unshift($params, null);
                unset($params[0]);
            }
            foreach ($params as $param => $value) {
                $this->bindParam($param, $value);
            }

            // @todo Works only with store procedure, handle how to deal with bindParam with mssql_query if needed
//            $this->_result = mssql_execute($this->_stmt);
        }

        $this->_result = mssql_query($this->_originalSQL, $this->getAdapter()->getConnection());

        if (!$this->_result) {
            throw new Exception(mssql_get_last_message());
        }

        $this->_executed = true;

        return (!$this->_result);
    }

    /**
     * Fetches a row from the result set.
     *
     * @param  int $style  OPTIONAL Fetch mode for this fetch operation.
     * @param  int $cursor OPTIONAL Absolute, relative, or other.
     * @param  int $offset OPTIONAL Number for absolute or relative cursors.
     * @return mixed Array, object, or scalar depending on fetch mode.
     * @throws Zend_Db_Statement_Exception
     */
    public function fetch($style = null, $cursor = null, $offset = null)
    {
        if (!$this->_stmt) {
            return false;
        }

        if (null === $style) {
            $style = $this->_fetchMode;
        }

        $values = mssql_fetch_array($this->_result, MSSQL_ASSOC);

        if (false === $values) {
            return false;
        }

        if (!$this->_keys) {
            foreach ($values as $key => $value) {
                $this->_keys[] = $this->_adapter->foldCase($key);
            }
        }

        $values = array_values($values);

        switch ($style) {
            case Zend_Db::FETCH_NUM:
                $row = $values;
                break;
            case Zend_Db::FETCH_ASSOC:
                $row = array_combine($this->_keys, $values);
                break;
            case Zend_Db::FETCH_BOTH:
                $assoc = array_combine($this->_keys, $values);
                $row   = array_merge($values, $assoc);
                break;
            case Zend_Db::FETCH_OBJ:
                $row = (object) array_combine($this->_keys, $values);
                break;
            case Zend_Db::FETCH_BOUND:
                $assoc = array_combine($this->_keys, $values);
                $row   = array_merge($values, $assoc);
                $row   = $this->_fetchBound($row);
                break;
            default:
                throw new Zend_Db_Statement_Exception("Invalid fetch mode '$style' specified");
                break;
        }

        return $row;
    }

    /**
     * Returns a single column from the next row of a result set.
     *
     * @param int $col OPTIONAL Position of the column to fetch.
     * @return string
     * @throws Zend_Db_Statement_Exception
     */
    public function fetchColumn($col = 0)
    {
        if (!$this->_stmt) {
            return false;
        }

        // @todo only in case of multiple results or stored procdure
//        if (!mssql_next_result($this->_result)) {
//            if (null !== $error = mssql_get_last_message()) {
//                throw new Zend_Db_Statement_Exception($error);
//            }
//
//            // If no error, there is simply no record
//            return false;
//        }

        $data = mssql_fetch_array($this->_result, MSSQL_NUM);
        if ($data === false) {
            throw new Zend_Db_Statement_Exception(mssql_get_last_message());
        }

        return $data[$col];
    }

    /**
     * Fetches the next row and returns it as an object.
     *
     * @param string $class  OPTIONAL Name of the class to create.
     * @param array  $config OPTIONAL Constructor arguments for the class.
     * @return mixed One object instance of the specified class.
     * @throws Zend_Db_Statement_Exception
     */
    public function fetchObject($class = 'stdClass', array $config = array())
    {
        if (!$this->_stmt) {
            return false;
        }

        $obj = mssql_fetch_object ($this->_result);

        if ($error = mssql_get_last_message()) {
            throw new Zend_Db_Statement_Exception($error);
        }

        if (null === $obj) {
            return false;
        }

        return $obj;
    }

    /**
     * Returns metadata for a column in a result set.
     *
     * @param int $column
     * @return stdClass
     * @throws Zend_Db_Statement_Exception
     */
    public function getColumnMeta($column)
    {
        $fields = mssql_fetch_field($this->_result, $column);

        if (!$fields) {
            throw new Zend_Db_Statement_Exception('Column metadata can not be fetched');
        }

        return $fields;
    }

    /**
     * Retrieves the next rowset (result set) for a SQL statement that has
     * multiple result sets.  An example is a stored procedure that returns
     * the results of multiple queries.
     *
     * @return bool
     * @throws Zend_Db_Statement_Exception
     */
    public function nextRowset()
    {
        if (mssql_next_result($this->_result) === false) {
            throw new Zend_Db_Statement_Exception(mssql_get_last_message());
        }
        
        // reset column keys
        $this->_keys = null;

        return true;
    }

    /**
     * Returns the number of rows affected by the execution of the
     * last INSERT, DELETE, or UPDATE statement executed by this
     * statement object.
     *
     * @return int     The number of rows affected.
     * @throws Zend_Db_Statement_Exception
     */
    public function rowCount()
    {
        if (!$this->_stmt) {
            return false;
        }

        if (!$this->_executed) {
            return 0;
        }

        $num_rows = mssql_num_rows($this->_result);

        // Strict check is necessary; 0 is a valid return value
        if ($num_rows === false) {
            throw new Zend_Db_Statement_Exception(mssql_get_last_message());
        }

        return $num_rows;
    }
    
    /**
     * Returns an array containing all of the result set rows.
     *
     * @param int $style OPTIONAL Fetch mode.
     * @param int $col   OPTIONAL Column number, if fetch mode is by column.
     * @return array Collection of rows, each in a format by the fetch mode.
     *
     * Behaves like parent, but if limit()
     * is used, the final result removes the extra column
     * 'zend_db_rownum'
     */
    public function fetchAll($style = null, $col = null)
    {
        $data = parent::fetchAll($style, $col);
        $results = array();
        $remove = $this->_adapter->foldCase('ZEND_DB_ROWNUM');

        foreach ($data as $row) {
            if (is_array($row) && array_key_exists($remove, $row)) {
                unset($row[$remove]);
            }
            $results[] = $row;
        }
        return $results;
    }
}
