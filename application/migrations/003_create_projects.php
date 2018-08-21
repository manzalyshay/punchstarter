<?php
/**
 * Created by IntelliJ IDEA.
 * User: shaym
 * Date: 8/7/18
 * Time: 12:05 AM
 */

class Migration_Create_projects extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'location' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'deadline' => array(
                'type' => 'DATE',
            ),
            'posterurl' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
            'funded' => array(
                'type' => 'INT',
                'constraint' => '100',
            ),
            'pledged' => array(
                'type' => 'INT',
                'constraint' => '100',
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'order' => array(
                'type' => 'INT',
                'constraint' => '100',
            ),
            'body' => array(
                'type' => 'TEXT',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('projects');
    }

    public function down()
    {
        $this->dbforge->drop_table('projects');
    }
}