<?php

namespace sketch\database;

class DBSQL
{
    protected $db;
    protected $dsn;
    protected $user;
    protected $password;

    public function setAttributes($attr)
    {
        foreach ($attr as $key => $val){
            $this->$key = $val;
        }
    }

    public function connect($attr = null)
    {
        if ($attr !== null){
            $this->setAttributes($attr);
        }

        $this->db = new \PDO(
            $this->dsn,
            $this->user,
            $this->password,
            [
                // возвращать ассоциативные массивы
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                // возвращать Exception в случае ошибки
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]
        );
    }
    public function query($query, $params = array())
    {
        $res = $this->db->prepare($query);
        $res->execute($params);
        return $res;
    }
    public function select($query, $params = array())
    {
        $result = $this->query($query, $params);
        if ($result) {
            return $result->fetchAll();
        }
        return null;
    }
    public function selectOne($query, $params = array())
    {
        $result = $this->query($query, $params);
        if ($result) {
            return $result->fetch();
        }
        return null;
    }

    public function createTable($table, $params=null, $options=null)
    {
        $paramsText = '';
        if ($params !== null){

            foreach ($params as $key=>$val){
                $paramsText .= $key.' '.$val.',';
            }
        }
        if ($options !== null){
            foreach ($options as $val){
                $paramsText .= $val.',';
            }
        }

        if (strlen($paramsText)>0){
            $paramsText = substr($paramsText, 0, -1);
        }

        $queryText = 'CREATE TABLE "'.$table.'" ('.$paramsText.')';
        $this->Query($queryText);
    }
    public function dropTable($table)
    {
        $this->Query('DELETE TABLE '.$table);
    }
    public function tableIsExist($table)
    {
        $result = $this->select(
            "SELECT table_name 
                  FROM information_schema.tables  
                  where table_schema='public' and table_name='{$table}'"
        );
        return Count($result) === 1;
    }

    public function recordIsExist($table, $condition)
    {
        $result = $this->select(
            "SELECT * FROM {$table} where {$condition}"
        );
        return Count($result) !== 0;
    }
    public function getRecords($table, $condition)
    {
        $result = $this->select("SELECT * FROM {$table} where {$condition}");
        return $result;
    }
    public function getRecord($table, $condition)
    {
        $result = $this->selectOne(
            "SELECT * FROM {$table} WHERE {$condition}"
        );
        if ($result) {
            return $result;
        }
        return null;
    }
    public function getRecordById($table, $id)
    {
        return  $this->getRecord($table, "id = {$id} ");
    }

    public function setRecord($table, $params)
    {
        $symbol = "";
        $paramsName = "";
        $valueName = "";
        foreach ($params as $key=>$val) {
            if ($key === "id") {
                unset($params["id"]);
                continue;
            }
            $paramsName .= $symbol.$key;
            $valueName .= $symbol." :".$key;
            $symbol = ", ";
        }

        var_dump("INSERT INTO {$table} ({$paramsName}) VALUES ({$valueName})");
        $this->query(
            "INSERT INTO {$table} ({$paramsName}) VALUES ({$valueName})",
            $params
        );
    }
    public function updateRecord($table, $id, $params)
    {
        $symbol = "";
        $paramsValuesName = "";
        foreach ($params as $key=>$val) {
            $paramsValuesName .= $symbol.$key."=:".$key;
            $symbol = ", ";
        }

        $this->query(
          "UPDATE {$table} SET {$paramsValuesName} WHERE id = {$id}",
          $params
        );
    }
    public function createRecord($table)
    {
        $columns = $this->select(
            "SELECT column_name, column_default 
                  FROM information_schema.columns 
                  WHERE table_schema='public' and table_name='{$table}'"
        );

        $items = [];
        foreach ($columns as $column) {
            $items[$column["column_name"]]=$column["column_default"];
        }
        return $items;
    }
}
