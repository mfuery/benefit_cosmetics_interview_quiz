<?php

namespace Db\Adapter;

class Mongo implements AdapterInterface
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
        // TODO: Implement disconnect() method.
    }

    public function fetch($query) {
        // TODO: Implement fetch() method.
    }

    public function put($query) {
        // TODO: Implement put() method.
    }
}