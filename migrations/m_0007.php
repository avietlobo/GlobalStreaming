<?php

/** User: Aviet Lobo ...
 * Date: 4/20/2023
 * Time: 9:52 PM
 */
class m_0007
{



    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE evangelist (
           entryDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
           email VARCHAR(255) NOT NULL,
           mobile VARCHAR(255) NOT NULL,
           evngName VARCHAR(255) NOT NULL,
           designation VARCHAR(255) NOT NULL,
           gLeaderEmail VARCHAR(255) NOT NULL,
           wgroupId VARCHAR(255) NOT NULL,
           password VARCHAR(255) NOT NULL,
           last_login DATETIME
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE evangelist;";
        $db->pdo->exec($SQL);
    }



}

