<?php 
/**
 * User: LaMarca_Creative
 * Date: 1/24/2022
 * Time: 10:19 PM
 */

 class m0003_add_is_admin_column {
     public function up()
     {
         $db = \kb\phpmvc\Application::$app->db;
         $db->pdo->exec("ALTER TABLE users ADD COLUMN is_admin VARCHAR(512) NOT NULL;");
     }

     public function down()
     {
         $db = \kb\phpmvc\Application::$app->db;
         $db->pdo->exec("ALTER TABLE users DROP COLUMN is_admin;");
     }
 }