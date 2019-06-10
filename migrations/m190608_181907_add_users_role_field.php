<?php

use yii\db\Migration;

/**
 * Class m190608_181907_add_users_role_field
 */
class m190608_181907_add_users_role_field extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'role', $this->smallInteger()->after('email')->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}
