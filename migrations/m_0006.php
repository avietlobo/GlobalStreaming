<?php

/** User: Aviet Lobo ...
 * Date: 4/20/2023
 * Time: 9:52 PM
 */
class m_0006
{


    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE candidatedetails ADD COLUMN last_login DATETIME;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE candidatedetails DROP COLUMN last_login;";
        $db->pdo->exec($SQL);
    }


}

