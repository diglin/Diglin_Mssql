# Diglin Mssql for Magento

Mssql Adapter for Magento.
Be aware that it is not attended to replace MySQL for Magento Database. It is not fully implemented to support such a case. 

## Requirements

- php-mssql

## Installation

### Via modman

- Install [modman](https://github.com/colinmollenhour/modman)
- Use the command from your Magento installation folder: `modman clone https://github.com/diglin/diglin_mssql.git`

### Via composer
- Install [composer](http://getcomposer.org/download/)
- Create a composer.json into your project like the following sample:

```json
{
    ...
    "require": {
        "diglin/diglin_mssql":"*"
    },
    "repositories": [
	    {
            "type": "vcs",
            "url": "https://github.com/diglin/diglin_mssql.git"
        }
    ],
    "extra":{
        "magento-root-dir": "./"
    }
}

```

- Then from your composer.json folder: `php composer.phar install` or `composer install`

### Manually
- You can copy the files from the folders of this repository to the same folders of your installation

## Configuration

Add into your `app/etc/local.xml` the following information and replace the placeholder with your own data

```
<config>
    <global>
        <resources>
            <default_mssql>
                <connection>
                    <host>{{db_host_mssql}}</host>
                    <username>{{db_user_mssql}}</username>
                    <password>{{db_pass_mssql}}</password>
                    <dbname>{{db_name_mssql}}</dbname>
                    <model>{{db_model_mssql}}</model>
                    <initStatements>{{db_init_statements_mssql}}</initStatements>
                    <type>{{db_type_mssql}}</type>
                    <active>1</active>
                </connection>
            </default_mssql>
        </resources>
    </global>
</config>
```

## Usage

In any location of your Magento Module:

```
$resource = Mage::getSingleton('core/resource');

/* @var $connection Diglin_Mssql_Model_Db_Adapter_Mssql */
$connection = $resource->getConnection('default_mssql');

var_dump($connection->fetchAll('SELECT @@VERSION'));
//var_dump($connection->fetchAll('exec sp_columns mytable'));
```

