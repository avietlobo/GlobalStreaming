<?php

/** User: Aviet Lobo ...
 * Date: 4/20/2023
 * Time: 9:52 PM
 */
class m_0004
{


    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE candidatedetails ADD COLUMN password VARCHAR(512);";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE candidatedetails DROP COLUMN password;";
        $db->pdo->exec($SQL);
    }


}

