<?php

use yii\db\Migration;

/**
 * Class m230809_113357_rbac_roles
 */
class m230809_113357_rbac_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('admin');
        $auth->add($admin);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230809_113357_rbac_roles cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230809_113357_rbac_roles cannot be reverted.\n";

        return false;
    }
    */
}
