<?php

use yii\db\Schema;
use yii\db\Migration;

class m160222_185209_login_history extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->execute("
            CREATE TABLE IF NOT EXISTS `clndr_login_history` (
              `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
              `user_id` INT NOT NULL COMMENT '',
              `date_time` DATETIME NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
              PRIMARY KEY (`id`)  COMMENT '',
              INDEX `fk_clndr_login_history_1_idx` (`user_id` ASC)  COMMENT '',
              CONSTRAINT `fk_clndr_login_history_1`
                FOREIGN KEY (`user_id`)
                REFERENCES `clndr_user` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB CHARACTER SET UTF8
        ");
    }

    public function safeDown()
    {
        $this->execute("
            DROP TABLE IF EXISTS `clndr_login_history`;
        ");
    }
}
