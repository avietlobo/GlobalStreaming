<?php
/** User: Aviet Lobo ...
 * Date: 4/20/2023
 * Time: 9:52 PM
 */

class m_0001_initial  {


  public function up(){
      $db = \app\core\Application::$app->db;
      $SQL = "CREATE TABLE candidateDetails (
           id INT AUTO_INCREMENT PRIMARY KEY,
           recordDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
           mobile VARCHAR(255) NOT NULL,
           participant VARCHAR(255) NOT NULL,
           evangelist VARCHAR(255) NOT NULL,
           wgroup VARCHAR(255) NOT NULL,
           language VARCHAR(255) NOT NULL,
           expiryDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
           classFrom SMALLINT NOT NULL,
           classTo SMALLINT NOT NULL,
           status VARCHAR(255) NOT NULL,
           mediaType VARCHAR(255) NOT NULL,
           remark VARCHAR(255) NOT NULL,
           classLink VARCHAR(255) NOT NULL,
           feedback VARCHAR(255) NOT NULL
            ) ENGINE=INNODB;";
      $db->pdo->exec($SQL);
  }

    public function down(){
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE candidateDetails;";
        $db->pdo->exec($SQL);

    }


}
