<?php 
/**
 * User: LaMarca_Creative
 * Date: 1/24/2022
 * Time: 8:25 PM
 */

 class m0002_add_password_column {
     public function up()
     {
         $db = \kb\phpmvc\Application::$app->db;
         $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;");
     }

     public function down()
     {
         $db = \kb\phpmvc\Application::$app->db;
         $db->pdo->exec("ALTER TABLE users DROP COLUMN password;");
     }
 }