<?php

namespace Db\Adapter;

interface AdapterInterface
{
    // Basic functionality common to all databases
    public function connect(\Db\Config $config);

    public function disconnect();

    // Here I'm assuming that all databases have the basic functionality of reading and writing data.

    public function fetch($query);

    public function put($query);

    // other useful functions common to all data sources might go here
}
