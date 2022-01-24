<?php
/**
 * User: LaMarca_Creative
 * Date: 1/23/2022
 * Time: 1:20 PM
 */

namespace app\core;
/**
 * Class Database
 * 
 * @author Keith Barreras <keith.barreras@gmail.com>
 * @package app\core
 */
class Database {
    public $pdo;
    /**
     * Database constructor.
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'/migrations'); 
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            echo "Applying migration $migration".PHP_EOL;
            $instance->up();
            echo "Migration $migration applied".PHP_EOL;
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            echo "All migrations are applied";
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchALL(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {  
        $newMigrations = array_map(function($m) {$migrations, ($m)});
       


                   

       //$str = implode(',', array_map(fn($m) => "('$m')", $migrations); 
        $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
             ('m0001_initial.php'),
             ('m0002_migration.php')        
             ");
        // $str = implode(',', array_map->(fn($m) =>  "('$m')", $migrations); 
        // $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
        //     $str ");
        // $statement->execute();
    }

}

// want to return "('$m')"; second argument is $migrations file which we want to map.