<?php
/** User: Aviet Lobo ...
 * Date: 4/20/2023
 * Time: 9:52 PM
 */

class m_0003
{


    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE candidate (
           id INT AUTO_INCREMENT PRIMARY KEY,
           mobile VARCHAR(255) NOT NULL,
           recordDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
           participantName VARCHAR(255) NOT NULL,
           country VARCHAR(255) NOT NULL,
           language VARCHAR(255) NOT NULL,
           evangelist VARCHAR(255) NOT NULL,
           source VARCHAR(255) NOT NULL,
           allotedDays VARCHAR(255) NOT NULL,
           mediaType VARCHAR(255) NOT NULL,
           activeStatus VARCHAR(255) NOT NULL,
           userid VARCHAR(255) NOT NULL,
           remark VARCHAR(255) NOT NULL
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE candidate;";
        $db->pdo->exec($SQL);
    }


}

