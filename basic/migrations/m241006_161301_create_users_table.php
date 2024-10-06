<?php

use yii\db\Migration;

class m241006_161301_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(100)->notNull(),
            'username' => $this->string(50)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32), // Для авторизации через токен
            'access_token' => $this->string(32), // Для API-авторизации
        ]);

        // Создание пользователя по умолчанию
        $this->insert('users', [
            'fio' => 'admin',
            'username' => 'admin',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('admin'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'access_token' => Yii::$app->security->generateRandomString(),
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
