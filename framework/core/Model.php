<?php
/**
 * User: Hércules
 * Date: 19/01/2019
 * Time: 09:40
 */

namespace Core;

abstract class Model
{
    private static $conn = null;
    private $query;
    private $whereStr;
    private $whereValues;
    private $fromStr;
    private $selectStr;

    
    /**
     * Estabelece conexão com o banco de dados ou retorna uma, caso já esteja aberta.
     * @access private
     * @return PDO
     */
    private function connect()
    {
        if(self::$conn == null) {

            // Configurações (informações necessárias à conexão)
            $driver = Config::get("database")["driver"];
            $host = Config::get("database")["host"];
            $user = Config::get("database")["user"];
            $password = Config::get("database")["password"];
            $db = Config::get("database")["dbname"];

            // Estabelece conexão
            $strConn = $driver . ":host=" . $host . ";dbname=" . $db;
            self::$conn = new \PDO($strConn, $user, $password);
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return self::$conn;

        }else {

            return self::$conn;

        }
    }
    
    
    /**
     * Limpa o estado do objeto para que seja possível realizar a próxima operação
     * @access private
     * @return void
     */
    private function clear()
    {
        $this->query = null;
        $this->whereStr = null;
        $this->fromStr = null;
        $this->selectStr = null;
        $this->whereValues = array();
    }
    
    
    /**
     * Adiciona cláusula WHERE a uma consulta SQL (WHERE coluna = valor)
     * @param string - coluna
     * @param string - valor
     * @param boolean - comparaçao entre colunas? ex "WHERE coluna1 = coluna2"
     * @access private
     * @return void
     */
    protected function addWhere($column, $value, $valueIsColumn = false)
    {
        if(empty($this->whereStr)) {
            // Comparação é entre colunas ou valor literal?
            if($valueIsColumn) {
                $this->whereStr = "WHERE {$column} = {$value}";
            }else {
                $this->whereStr = "WHERE {$column} = :wv0";
                $this->whereValues[] = $value;
            }
            return;
        }

        $vCount = count($this->whereValues);

        // Comparação é entre colunas ou valor literal?
        if($valueIsColumn) {
            $this->whereStr .= " AND {$column} = {$value}";
        }else {
            $this->whereStr .= " AND {$column} = :wv{$vCount}";
            $this->whereValues[] = $value;
        }

    }
    
    
    /**
     * Substitui de forma segura os parâmetros da parte WHERE da consulta (preparedStatements)
     * @param PDOStatement
     * @access private
     * @return PDOStatement - Statement com os parâmetros substituídos
     */
    private function bindWhereValues($statement)
    {
        if(empty($statement))
            throw new \Exception("Null PDOStatement");

        for($i = 0; $i < count($this->whereValues); $i++)
            $statement->bindValue(":wv{$i}", $this->whereValues[$i]);

        return $statement;

    }
    
    
    /**
     * Executa operação básica INSERT no banco de dados
     * @param string $table - tabela em que se deseja fazer a inserção
     * @param array(string) $assocArray - array associativo com as colunas e dados para inserção
     * exemplo: array("coluna1" => "valor1", "coluna2" => "valor2" . . .)
     * @access private
     * @return void
     */
    protected function create($table, $assocArray)
    {
        if(empty($table) || empty($assocArray))
            throw new \Exception("Table or associative array is empty");

        $this->query = "INSERT INTO {$table} (";

        $valuesStr = "VALUES(";
        $insertValues = array();
        $i = 0;
        foreach($assocArray as $key => $value)
        {
            $this->query .= $key . ",";
            $valuesStr .= ":iv{$i},";
            $insertValues[] = $value;
            $i++;
        }

        // Remove última vírgula de "$this->query" e de "$valuesStr"
        $this->query = substr($this->query, 0, strlen($this->query)-1);
        $valuesStr = substr($valuesStr, 0, strlen($valuesStr)-1);

        $this->query .= ") " . $valuesStr . ")";

        try {
            $pdo = $this->connect();
            $statement = $pdo->prepare($this->query);

            // Bind dos parâmtros da query
            for($i = 0; $i < count($insertValues); $i++)
                $statement->bindValue(":iv{$i}", $insertValues[$i]);

            $statement->execute();
            $this->clear(); // prepara o objeto para próxima operação

        }catch(\PDOException $e) {
            throw $e;
        }


        echo $this->query;
    }
    
    
    /**
     * Executa a operação básica SELECT no banco de dados
     * @param string $table - tabela em que se desejar fazer o select
     * @param array(string) - array com as colunas ex: array("coluna1", "coluna2" . . .) ou null para todos
     * @access private
     * @return array associativo com o resultado da busca
     */
    protected function read($table, $columns = null)
    {
        if(empty($columns))
            $this->query = "SELECT * ";
        else
            $this->query = "SELECT ";

        // Insere na string as colunas
        $numColumns = count($columns);
        for($i = 0; $i < $numColumns; $i++)
            $this->query .= $columns[$i] . ',';

        // Remove a última vírgula
        if(!empty($columns))
            $this->query = substr($this->query, 0, strlen($this->query)-1);

        $this->query .= " FROM {$table}";

        // Se existir, inclui cláusula WHERE
        if(!empty($this->whereStr))
            $this->query .= " " . $this->whereStr;

        try {
            $pdo = $this->connect();
            $statement = $pdo->prepare($this->query);

            // Se existir valores para cláusula where, faça o bind
            if(!empty($this->whereValues))
                $statement = $this->bindWhereValues($statement);

            $statement->execute();
            $this->clear(); // prepara o objeto para próxima operação
            return $statement->fetchAll();

        }catch(\PDOException $e) {
            throw $e;
        }
    }
    
    
    /**
     * Executa a operação básica UPDATE no banco de dados
     * @param string $table - tabela em que se deseja fazer o update
     * @param array(string) $assocArray - Array associativo com colunas e valores que deseja atualizar
     * exemplo: array("coluna1" => "valor1", "coluna2" => "valor2" . . .)
     * @access private
     * @return void
     */
    protected function update($table, $assocArray)
    {
        if(empty($table) || empty($assocArray))
            throw new \Exception("Table or associative array is empty");

        $this->query = "UPDATE {$table} SET ";

        $upValues = array();
        $i= 0;
        foreach($assocArray as $key => $value)
        {
            $this->query .= $key . '=' . ":up{$i},";
            $upValues[] = $value;
            $i++;
        }

        // Remove a última vírgula
        $this->query = substr($this->query, 0, strlen($this->query)-1);

        // Se existir, inclui cláusula WHERE
        if(!empty($this->whereStr))
            $this->query .= " " . $this->whereStr;

        try {
            $pdo = $this->connect();
            $statement = $pdo->prepare($this->query);

            // Bind dos parâmtros da query
            for($i = 0; $i < count($upValues); $i++)
                $statement->bindValue(":up{$i}", $upValues[$i]);

            // Se existir valores para cláusula where, faça o bind
            if(!empty($this->whereValues))
                $statement = $this->bindWhereValues($statement);

            $statement->execute();
            $this->clear(); // prepara o objeto para próxima operação

        }catch(\PDOException $e) {
            throw $e;
        }
    }
    
    
    /**
     * Executa a operação básica DELETE no banco de dados (não deve ser usada sem antes executar addWhere())
     * @param string $table - tabela em que se deseja apagar um registro
     * @access private
     * @return void
     */
    protected function delete($table)
    {
        if(empty($table))
            throw new \Exception('Table param is empty');

        $this->query = "DELETE FROM {$table} ";

        // Se existir, inclui cláusula WHERE
        if(!empty($this->whereStr))
            $this->query .= $this->whereStr;

        try {
            $pdo = $this->connect();
            $statement = $pdo->prepare($this->query);

            // Se existir valores para cláusula where, faça o bind
            if(!empty($this->whereValues))
                $statement = $this->bindWhereValues($statement);

            $statement->execute();
            $this->clear(); // prepara o objeto para próxima operação
        }catch(\PDOException $e) {
            throw $e;
        }
    }
    
    
    /**
     * Seleciona conlunas para realizar operação SELECT no banco de dados e pode ser chamada várias vezes se necessário
     * @params array(string) $columns - array com as colunas que deseja selecionar
     * @access private
     * @return void
     */
    protected function select($columns)
    {
        if(empty($columns))
            throw new \Exception("Empty columns");

        if(empty($this->selectStr))
            $this->selectStr = "SELECT ";
        else
            $this->selectStr .= ",";

        if($columns == "*")
            $this->selectStr  .= "* "; // espaço no final é necessário para que a rotina que remove a última vírgula não remova o asterísco
        else
            for($i = 0; $i < count($columns); $i++)
                $this->selectStr .= $columns[$i] . ",";

        // Remove última vírgula
        $this->selectStr = substr($this->selectStr, 0, strlen($this->selectStr)-1);
    }
    
    
    /**
     * Adiciona a parte "FROM tabelas" da consulta, método auxiliar da função select(), pode ser usado mais de uma vez se necessário
     * @param string $table - tabela em que deseja selecionar o registro
     * @param string $alias - apelido para a tabela (opicional)
     * @access private
     * @return void
     */
    protected function from($table, $alias = null)
    {
        if (empty($table))
            throw new \Exception("Empty table");

        if(empty($this->fromStr))
            $this->fromStr = "FROM {$table}";
        else
            $this->fromStr .= ", {$table}";

        if(!empty($alias))
            $this->fromStr .= " AS {$alias}";
    }
    
    
    /**
     * Executa query montada pelos métodos select(), from() e addWhere()
     * @access private
     * @return void
     */
    protected function execSelect()
    {
        if(empty($this->selectStr))
            throw  new \Exception("'SELECT' part of query is missing");

        if(empty($this->fromStr))
            throw  new \Exception("'FROM' part of query is missing");

        $this->query = $this->selectStr . " " . $this->fromStr;

        if(!empty($this->whereStr))
            $this->query .= " " . $this->whereStr;

        try {
            $pdo = $this->connect();
            $statement = $pdo->prepare($this->query);

            // Se existir valores para cláusula where, faça o bind
            if(!empty($this->whereValues))
                $statement = $this->bindWhereValues($statement);

            $statement->execute();
            $this->clear();
            return $statement->fetchAll();
        }catch(\PDOException $e) {
            throw $e;
        }
        echo $this->query;
    }
    
    
    /**
     * Executa procedimentos armazenados no banco (Stored Procedures)
     * @param string $procedure - nome da stored procedure que deseja executar
     * @param array(string) $params - array de string com os argumentos da procedure
     * @access protected
     * @return array associativo com o resultado ou void
     */
    protected function exec($procedure, $params)
    {
        $this->query = "call {$procedure}( ";
        
        if(!empty($params))
            if(is_array($params))
                for($i = 0; $i < count($params); $i++)
                    $this->query .= "?,";
            else
                $this->query .= "?";

        // Remove última vírgula
        if(is_array($params))
            $this->query = substr($this->query, 0, strlen($this->query)-1);

        $this->query .= ')';
        
        try {
            $pdo = $this->connect();
            $statement = $pdo->prepare($this->query);
            
            if(is_array($params))
                for($i = 0; $i < count($params); $i++)
                    $statement->bindValue($i+1, $params[$i]);
            if(!empty($params))
                $statement->bindValue(1, $params);
            
            $statement->execute();
            $this->clear(); // prepara a classe para a próxima operação
            return is_array($statement->fetchAll) ? $statement->fetchAll : null;               
                
        }catch(\PDOException $e) {
            throw $e;
        }
    }
}