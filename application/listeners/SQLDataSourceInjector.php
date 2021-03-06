<?php
require_once("vendor/lucinda/framework-engine/src/datasource_detection/SQLDataSourceBinder.php");
        require_once("application/models/DB.php");

/**
 * Binds STDOUT MVC with SQL Data Access API and contents of 'sql' subtag of 'servers' tag @ configuration.xml
 * in order to be able to operate with a sql database (via PDO).
 * Sets up and injects a Lucinda\SQL\DataSource object that will be used automatically when querying database via
 * Lucinda\SQL\ConnectionSingleton or Lucinda\SQL\ConnectionFactory.
 */
class SQLDataSourceInjector extends \Lucinda\MVC\STDOUT\ApplicationListener
{
    /**
     * {@inheritDoc}
     * @see \Lucinda\MVC\STDOUT\Runnable::run()
     */
    public function run()
    {
        new Lucinda\Framework\SQLDataSourceBinder($this->application->getTag("servers")->sql, ENVIRONMENT);

        $parentSchema = (string) $this->application->getTag("servers")->sql->{ENVIRONMENT}->server["parent_schema"];
        $this->application->attributes("parent_schema", $parentSchema);
    }
}
