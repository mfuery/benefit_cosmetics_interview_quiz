<?php

namespace Db\Adapter;

/**
 * Class Mysql
 * PDO is the best choice for PHP IMO. Mysqli is missing features and using built-in
 * MySQL functions is just flat bad to do (SQL Injection, among other reasons).
 *
 * @package Db\Adapter
 */
class Mysql implements AdapterInterface {

    private $_dbh;

    public function getDbh() {
        return $this->_dbh;
    }

    public function connect(\Db\Config $config) {
        if (!$this->_dbh) {
            $dsn = sprintf('mysql:host=%s;dbname=%s', $config->host, $config->schema);

            try {
                $this->_dbh = new \PDO($dsn, $config->user, $config->password);
            } catch (\PDOException $e) {
                // Log or handle error
                echo "Error connecting to PDO " . $e->getMessage();
            }
        }

        return $this->_dbh;
    }

    public function disconnect() {
        $this->_dbh = null;
    }

    /**
     * @param $query
     *
     * @return \PDOStatement result set
     */
    public function fetch($query) {
        $resultSet = $this->_dbh->query($query);
        return $resultSet;
    }

    /**
     * @param $query
     *
     * @return bool result of \PDOStatement->execute()
     */
    public function put($query) {
        $stmt = $this->_dbh->prepare($query);
        return $stmt->execute();
    }

    public function update($query) {

    }

    public function delete($query) {

    }
}