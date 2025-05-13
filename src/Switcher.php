<?php

namespace Luminee\Switcher;

use Closure;
use Illuminate\Database\DatabaseManager;

class Switcher
{
    /**
     * @var DatabaseManager
     */
    protected $db;

    /**
     * Bootstrap the console application.
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = app()->get('db');
        $this->appendExtraConnections();
    }

    protected function appendExtraConnections()
    {
        $extra_connections = config('switcher.extra_connections');

        if (!empty($extra_connections)) {
            app()['config']['database.connections'] = array_merge(
                app()['config']['database.connections'],
                $this->handleExtraConnections($extra_connections)
            );
        }
    }

    protected function handleExtraConnections($extra_connections)
    {
        $connections = [];
        foreach ($extra_connections as $name => $config) {
            $name = strtolower($name);
            if ($this->isConnectionConfig($config)) {
                $connections[$name] = $config;
            } else {
                foreach ($config as $conn => $connection_config) {
                    $connections[$name . '_' . $conn] = $connection_config;
                }
            }
        }

        return $connections;
    }

    protected function isConnectionConfig($config)
    {
        foreach ($config as $value) {
            if (!is_array($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Runs the current command.
     *
     * @return int 0 if everything went fine, or an error code
     */
    public function run(Closure $command, $connection)
    {
        $previousConnection = $this->db->getDefaultConnection();

        $this->db->setDefaultConnection($connection);

        return tap($command(), function () use ($previousConnection) {
            $this->db->setDefaultConnection($previousConnection);
        });
    }
}
