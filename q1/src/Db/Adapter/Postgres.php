<?php

namespace Db\Adapter;

class Postgres implements AdapterInterface
{
    private $_dbh;

    public function getDbh() {
        return $this->_dbh;
    }

    public function connect(\Db\Config $config) {
        if (!$this->_dbh) {
            $dsn = sprintf('pgsql:host=%s %port=%s user=%s dbname=%s password=%s',
                $config->host, $config->port, $config->user, $config->password, $config->schema);
            $this->_dbh = pg_connect($dsn);
        }
    }

    public function disconnect() {
        // TODO: Implement disconnect() method.
    }

    public function fetch($query) {
        // In production we'd use prepare/execute and handle errors, but for this simple example we won't.
        return pg_query($query);
    }

    public function put($query) {
        // TODO: Implement put() method.
    }
}