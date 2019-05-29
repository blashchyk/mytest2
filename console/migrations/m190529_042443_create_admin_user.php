<?php

use yii\db\Migration;

/**
 * Class m190529_042443_create_admin_user
 */
class m190529_042443_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'username' => 'admin',
            'auth_key' => 'vVBQ4PZ-Tqo1XW7opVXn9NN81AtaIOux',
            'password_hash' => '$2y$13$IgsHJPl4tym4DCs7jjGyouAzkfSVB8pzStl40ypBW1LjenzKIE9Iq',
             'email' => 'admin@admin.com',
            'status' => 10,
            'created_at' => 1558888284,
            'updated_at' => 1558888284,
            'verification_token' => 'jEGtYajn9KquiiwQFOs8LAeExDdqFZp4_1558888284']
            );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190529_042443_create_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190529_042443_create_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
