<?php

namespace object\DBMain\migration\migrate_files;

use object\DBMain\migration\Migrate;

class m130524_201442_create_user_table extends Migrate
{
    public function up()
    {
        $this->db->createTable('user', [
                'id' => 'serial NOT NULL',
                'username' => 'character varying(255) NOT NULL',
                'auth_key' => 'character varying(32) NOT NULL',
                'password_hash' => 'character varying(255) NOT NULL',
                'password_reset_token' => ' character varying(255)',
                'email' => 'character varying(255) NOT NULL',
                'status' =>'smallint NOT NULL DEFAULT 10',
                'created_at' => 'integer NOT NULL',
                'updated_at' => 'integer NOT NULL'
            ],
            [
                'CONSTRAINT user_pkey PRIMARY KEY (id)',
                'CONSTRAINT user_email_key UNIQUE (email)',
                'CONSTRAINT user_password_reset_token_key UNIQUE (password_reset_token)',
                'CONSTRAINT user_username_key UNIQUE (username)'
            ]
        );
    }

    public function down()
    {
        $this->db->dropTable('user');
    }
}
