<?php

use yii\db\Migration;

class m170511_170333_add_profile_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'description', $this->text());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'description');
    }
}
