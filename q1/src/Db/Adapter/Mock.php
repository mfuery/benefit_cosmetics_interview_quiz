<?php

namespace Db\Adapter;

class Mock implements AdapterInterface
{

    private $_dbh;

    public function getDbh() {
        return $this->_dbh;
    }

    public function connect(\Db\Config $config) {
        if (!$this->_dbh) {
            $dsn = sprintf('mongodb://%s:%s@%s:%s/%s',
                $config->user, $config->password, $config->host, $config->port, $config->schema);
            $this->_dbh = new \MongoClient($dsn);
        }

        return $this->_dbh;
    }

    public function disconnect() {
        $this->_dbh = null;
    }

    public function fetch($query) {
        return array('rows' => array(
            '1' => array(
                'col1' => 'col1value',
                'col2' => 'col2value'
            )
        ));
    }

    public function put($query) {
        // TODO: Implement put() method.
    }
}