<?php

use yii\db\Migration;

/**
 * Handles the creation of table `projects`.
 * Связь с пользователем: user_id
 * Название: name
 * Стоимость: cost
 * Дата начала: start_date
 * Дата сдачи: end_date
 */
class m241006_184700_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // Создание таблицы `projects` с необходимыми полями
        $this->createTable('projects', [
            'id' => $this->primaryKey(), // Первичный ключ
            'user_id' => $this->integer()->notNull()->comment('Связь с пользователем'), // Идентификатор пользователя
            'name' => $this->string(255)->notNull()->comment('Название проекта'), // Название проекта
            'cost' => $this->decimal(10, 2)->notNull()->comment('Стоимость проекта'), // Стоимость проекта (с двумя знаками после запятой)
            'start_date' => $this->date()->notNull()->comment('Дата начала'), // Дата начала проекта
            'end_date' => $this->date()->defaultValue(null)->comment('Дата сдачи'), // Дата окончания проекта
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Создано'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP')->comment('Обновлено'),
        ]);

        // Создание индекса на столбце `user_id` для повышения производительности запросов
        $this->createIndex(
            'idx-projects-user_id',
            'projects',
            'user_id'
        );

        // Добавление внешнего ключа для связи с таблицей `users`
        $this->addForeignKey(
            'fk-projects-user_id', // Имя внешнего ключа
            'projects',            // Таблица, в которой добавляется ключ
            'user_id',             // Столбец, который связывается с внешним ключом
            'users',               // Внешняя таблица (users)
            'id',                  // Столбец внешней таблицы
            'CASCADE',             // Удаление проектов при удалении пользователя
            'CASCADE'              // Обновление проектов при изменении user_id
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Удаление внешнего ключа
        $this->dropForeignKey('fk-projects-user_id', 'projects');

        // Удаление индекса
        $this->dropIndex('idx-projects-user_id', 'projects');

        // Удаление таблицы `projects`
        $this->dropTable('projects');
    }
}
