<?php

/** User: Aviet Lobo ...
 * Date: 4/20/2023
 * Time: 9:52 PM
 */
class m_0005
{


    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE candidatedetails ADD COLUMN login_attempts INT DEFAULT 0;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "ALTER TABLE candidatedetails DROP COLUMN login_attempts;";
        $db->pdo->exec($SQL);
    }


}

