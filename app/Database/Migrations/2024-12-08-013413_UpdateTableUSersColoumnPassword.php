<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTableUSersColoumnPassword extends Migration
{
    public function up()
    {
        $hash_password_function = "
            CREATE OR REPLACE FUNCTION hash_password()
            RETURNS TRIGGER AS $$
            BEGIN
                IF TG_OP = 'INSERT' THEN
                    NEW.password = crypt(NEW.password, gen_salt('bf'));
                END IF;

                IF TG_OP = 'UPDATE' AND NEW.password IS DISTINCT FROM OLD.password THEN
                    NEW.password = crypt(NEW.password, gen_salt('bf'));
                END IF;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ";

        $this->db->query($hash_password_function);

        // Buat trigger untuk memanggil fungsi hashing password
        $hash_password_trigger = "
            CREATE TRIGGER hash_password_trigger
            BEFORE INSERT OR UPDATE ON users
            FOR EACH ROW
            EXECUTE FUNCTION hash_password();
        ";

        $this->db->query($hash_password_trigger);
    }

    public function down()
    {
        $this->db->query("DROP TRIGGER IF EXISTS hash_password_trigger ON users");
        $this->db->query("DROP FUNCTION IF EXISTS hash_password");
    }
}
