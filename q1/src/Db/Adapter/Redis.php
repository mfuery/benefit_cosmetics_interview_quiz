<?php

namespace Db\Adapter;

require "predis/autoload.php";
PredisAutoloader::register();

class Redis implements AdapterInterface
{

    private $_dbh;

    public function getDbh() {
        return $this->_dbh;
    }

    public function connect(\Db\Config $config) {
        if (!$this->_dbh) {
            try {

                $this->_dbh = new \PredisClient(array(
                    'scheme' => 'tcp',
                    'host' => $config->host,
                    'port' => $config->port
                ));
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        }

        return $this->_dbh;
    }

    public function disconnect() {
        // TODO: Implement disconnect() method.
    }

    public function fetch($key) {
        return $this->_dbh->get($key);
    }

    public function put($query) {
        $this->_dbh->set($query->key, $query->value);
    }
}