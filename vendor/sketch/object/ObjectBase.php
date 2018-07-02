<?php
namespace sketch\object;

abstract class ObjectBase
{
    public $db = null;
    public $table = "";
    public $ref = 0;
    public $props = null;

    public function __construct($id=0)
    {
        if ($id === 0) {
            $this->createNew();
        } else {
            $this->ref = +$id;
            $this->load();
        }

    }

    public function __get($name)
    {
        if (isset($this->props[$name])) {
            return $this->props[$name];
        };
        return undefined;
    }

    public function save()
    {
        $this->db->setRecord($this->table, $this->props);
    }

    public function update()
    {
        $this->db->updateRecord($this->table, $this->ref, $this->props);
    }

    public function load()
    {
        $this->props = $this->db->getRecordById($this->table, $this->ref);
    }

    public function createNew()
    {
        $this->props = $this->db->createRecord($this->table);
    }

}