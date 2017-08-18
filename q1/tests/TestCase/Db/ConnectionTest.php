<?php

namespace Myapp\TestCase\Db;

include(dirname(dirname(dirname(__DIR__))) . '/src/autoload.php');
include(dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php');

//use PHPUnit\Framework\TestCase;

use Db\Adapter\Mongo;
use Db\Adapter\Mysql;
use Db\Adapter\Postgres;
use Db\Config;
use PHPUnit_Framework_TestCase;

class ConnectionTest extends PHPUnit_Framework_TestCase
{
    public function testMongoAdapter() {
        $expected = "blah blah...";

        $config = new Config();
        $config->driver = 'Mongo';
        $config->port = 27017;

        $mongo = new Mongo();
        $mongo->connect($config);
        $mongo->put($expected);
        $actual = $mongo->get($expected);

        $this->assertEquals($expected, $actual);
    }


    public function testMysqlAdapter() {
        $expected = "blah blah...";

        $config = new Config();
        $config->driver = 'Mysql';
        $config->port = 3306;

        $mongo = new Mysql();
        $mongo->connect($config);
        $mongo->put($expected);
        $actual = $mongo->get($expected);

        $this->assertEquals($expected, $actual);
    }

    public function testPostgresAdapter() {
        $expected = "blah blah...";

        $config = new Config();
        $config->driver = 'Postgres';
        $config->port = 5432;

        $mongo = new Postgres();
        $mongo->connect($config);
        $mongo->put($expected);
        $actual = $mongo->get($expected);

        $this->assertEquals($expected, $actual);
    }

    public function testRedisAdapter() {
        $expected = "blah blah...";

        $config = new Config();
        $config->driver = 'Redis';
        $config->port = 6379;

        $mongo = new Redis();
        $mongo->connect($config);
        $mongo->put($expected);
        $actual = $mongo->get($expected);

        $this->assertEquals($expected, $actual);
    }

}