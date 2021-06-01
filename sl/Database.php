<?php
    class Database extends PDO {
        private  $dbtype = "mysql";
        private  $dbhost = "localhost";
        private  $dbname = "sl";
        private  $dbuser = "root";
        private  $dbpass = "";

        public function __construct()
        {
            try {
                parent::__construct($this->dbtype.':host='.$this->dbhost.';dbname='.$this->dbname, $this->dbuser, $this->dbpass);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->exec("SET NAMES 'utf8'");
                $this->exec('SET character_set_connection=utf8');
                $this->exec('SET character_set_client=utf8');
                $this->exec('SET character_set_results=utf8');
            } catch(PDOException $e) {
                die( 'ERROR: ' . $e->getMessage());
            }
        }

        private function resolve( $where, $prefix = null )
        {
            $sql = '';
            $i = 0;                
            $table = ($prefix) ? "{$prefix}." : "";
            foreach( $where as $key => $value ):
                $let = $i == 0 ? 'where' : 'and';
                if( is_array( $value ) ) :
                    $values = implode("','", $value);
                    $sql .= "{$let} {$table}`{$key}` in ('{$values}') ";
                else:
                    $sql .= "{$let} {$table}`{$key}` = :{$key} ";
                endif;
                $i++;
            endforeach;
            return $sql;
        }

        public function select($table, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
        {
            $sql = "select * from {$table} ";
            $sql .= $this->resolve($array);
            $sth = $this->prepare($sql);
		    if( count($array) > 0 ):
			    foreach ( $array as $key => $value ):
				    if( !is_array( $value ) )
	                    $sth->bindValue("$key", $value);
                endforeach;
		    endif;           
            $sth->execute();
            return $sth->fetchAll($fetchMode);
        }

        public function insert($table, $data)
        {
            ksort( $data );    
            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));    
            $sth = $this->prepare("INSERT INTO `$table` (`$fieldNames`) VALUES ($fieldValues)");
            foreach ($data as $key => $value) :
                $sth->bindValue(":$key", $value);
            endforeach;    
            $sth->execute();
            $sth = $this->prepare("select LAST_INSERT_ID() as uid");
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC)[0]['uid'];
        }

    }
?>