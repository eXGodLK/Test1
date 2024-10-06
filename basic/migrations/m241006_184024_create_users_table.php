<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m241006_184024_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // Создание таблицы `users` с необходимыми полями
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'surname' => $this->string(100)->notNull()->comment('Фамилия'),
            'name' => $this->string(100)->notNull()->comment('Имя'),
            'patronymic' => $this->string(100)->defaultValue(null)->comment('Отчество'),
            'username' => $this->string(50)->notNull()->unique()->comment('Логин'),
            'password' => $this->string(255)->notNull()->comment('Пароль'),
            'auth_key' => $this->string(32)->comment('Ключ авторизации'),
            'access_token' => $this->string(32)->comment('Токен доступа'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->comment('Создано'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP')->comment('Обновлено'),
        ]);

        // Добавление пользователя по умолчанию (admin/admin)
        $this->insert('users', [
            'surname' => 'admin',
            'name' => 'admin',
            'patronymic' => 'admin',
            'username' => 'admin',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'), // Хэшируем пароль
            'auth_key' => Yii::$app->security->generateRandomString(),
            'access_token' => Yii::$app->security->generateRandomString(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Удаление таблицы `users`
        $this->dropTable('users');
    }
}