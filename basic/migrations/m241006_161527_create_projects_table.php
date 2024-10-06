<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m241006_161527_create_projects_table extends Migration
{
    public function up()
    {
        $this->createTable('projects', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(), // Связь с пользователем
            'name' => $this->string(100)->notNull(),
            'cost' => $this->decimal(10, 2)->notNull(),
            'start_date' => $this->date()->notNull(),
            'end_date' => $this->date(),
        ]);

        // Создание внешнего ключа для связи с таблицей users
        $this->addForeignKey(
            'fk-projects-user_id',
            'projects',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-projects-user_id', 'projects');
        $this->dropTable('projects');
    }
}
