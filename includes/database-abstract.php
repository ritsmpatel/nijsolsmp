<?php abstract class DataBase
{

    var $objDB;
    var $_result;

   public function DataBase() {
        $this->_result = array();
        $this->objDB = $this->Db_Connect(DB_SERVER, DB_NAME, DB_USER, DB_PASSWORD);
    }
	
	/*Database connection*/
	
   public function Db_Connect($server, $dbname, $user, $pass) {
        try {
			 global $dbconn;
            $dbconn = new PDO('mysql:host=' . $server . ';dbname=' . $dbname, $user, $pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            $dbconn = $e->getMessage();
            
        }
        return $dbconn;
    }

	/*Fetching rows from database*/

    function Get_Rows($table_name, $where = "1=1", $query = "*", $order_by = "") {
        $sql = "select " . $query . " from " . $table_name;
        if (is_array($where)) {

            $sql .= (" where 1=1");
            while (list($columns, $value) = each($where)) {
                $sql .= (" and `" . $columns . "`='" . $value . "'");
            }
        } else {
            $sql .=(" where $where");
        }
        if ($order_by != '') {
            $sql .= " order by " . $order_by;
        }
        /*echo $sql;exit;*/
        $query_obj = $this->objDB->query($sql);
        $result = $query_obj->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

  /*Insert data into database*/

    function Insert_Row($table_name, $columns) {
        $columnstring = implode(',', array_keys($columns));
        $valuestring = ":" . implode(',:', array_keys($columns));
        $query = "INSERT INTO $table_name (" . $columnstring . ") VALUES (" . $valuestring . ")";
        $query_obj = $this->objDB->prepare($query);
        foreach ($columns as $key => $value) {
            $query_obj->bindValue(':' . $key, $value);
        }
        $query_obj->execute();
        return $this->objDB->lastInsertId();
    }

/* Update record on database*/

    function Update_Row($table_name, $columns, $where = "1=1") {
        $query = "UPDATE " . $table_name . " SET ";
        foreach ($columns as $key => $value) {
            $phaseone[] = $key . "=:" . $key;
        }
        $polishedvals = implode(", ", $phaseone);
        $query.=$polishedvals;
        if (is_array($where)) {
            $query.= (" where 1=1");
            while (list($column, $value) = each($where)) {
                $query.= (" and `" . $column . "`='" . $value . "'");
            }
        } else {
            $query.=(" where $where");
        }
       /* echo $query;exit;*/
        $query_obj = $this->objDB->prepare($query);
        foreach ($columns as $key => $value) {
            $query_obj->bindValue(':' . $key, $value);
        }
        $query_obj->execute();
        return $query_obj->rowCount();
    }

/* Delete record from database*/

    function Delete_Row($table_name, $where = "1=1") {
        $query = "DELETE FROM $table_name";
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                $phaseone[] = $key . "=:" . $key;
            }
            $polishedvals = implode(", ", $phaseone);
            $query.=" WHERE " . $polishedvals;
            $query_obj = $this->objDB->prepare($query);
            foreach ($where as $key => $value) {
                $query_obj->bindValue(':' . $key, $value);
            }
        } else {
            $query.=(" where $where");
            $query_obj = $this->objDB->prepare($query);
        }
        $query_obj->execute();
        return $query_obj->rowCount();
    }

/* Check table exits or not*/

    private function Check_Table_Exits($tablename) {
        $query_obj = $this->objDB->query("SHOW TABLES LIKE '{$tablename}'");
        $checktable = $query_obj->fetchAll(PDO::FETCH_ASSOC);        
        if (count($checktable) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
/* Delete table from database	*/
	
	function Delete_Table($tablename) {
		
		$checktable = $this->Check_Table_Exits($tablename);
		if(!empty($checktable))
		{
			$this->objDB->query("DROP TABLE $tablename");
			return TRUE;
		}
		else
		{
			return FALSE;	
		}
	}
	
/* Create new table on database	*/
	
	private function Create_Table($tablename, $columnname){
		$columnquery = "";
		
		$query = "CREATE TABLE ".$tablename." ( ";
		
			foreach($columnname as $_columnname)
		    {
				$columnquery.=$this->Create_Column($tablename, $_columnname, $newtable="new");				
			}
		$query.=rtrim($columnquery,',');
		$query.= " ) ENGINE=InnoDB AUTO_INCREMENT=1";
		
		$createtable = $this->objDB->query($query);
		return $createtable;
	
	}

/* Check column on current exits or not*/
	
	private function Check_Column_Exits($tablename, $columnname) {
		
		$column_check = count($this->objDB->query("SHOW COLUMNS FROM ".$tablename." LIKE '".$columnname['field']['name']."'")->fetchAll());
		if($column_check != 0 && (empty($columnname['field']['new_name'])))
		{
			$check_column = $this->Check_Column_Attribute($tablename, $columnname);		
			return TRUE;
		}
		else if($column_check != 0 && (!empty($columnname['field']['new_name'])))
		{
			$check_column = $this->Check_Column_Attribute($tablename, $columnname, "update");		
			return TRUE;
		}
		else if($column_check == 0 && (empty($columnname['field']['new_name'])))
		{
			return FALSE;
		}
		else if ($column_check == 0 && (!empty($columnname['field']['new_name'])))
		{
			
			$new_column_check = count($this->objDB->query("SHOW COLUMNS FROM ".$tablename." LIKE '".$columnname['field']['new_name']."'")->fetchAll());
			if($new_column_check != 0)
			{
				$check_column = $this->Check_Column_Attribute($tablename, $columnname, "newcolumn");	
				return TRUE;	
			}
			else
			{
				return FALSE;
			}
		}
		return FALSE;
	}

/* Create new column on current table*/

	private function Create_Column($tablename, $column, $newtable="") {
		$columntype = "";
		
		foreach($column['attributes'] as $key=>$_attributes)
		{
			
				switch ($key)
				{
					
					/*$columntype = "";*/
											
					case "type":
					$columntype.= $_attributes;
					break;
					
					case "null":
					 if($_attributes == "NO") { $columntype.= " NOT NULL";}	
					break;
					
					case "default":
					 if(!empty($_attributes) or ($_attributes == 0)) { $columntype.= " DEFAULT '".$_attributes."'"; }
					break;
					
					case "auto_increment":
					if($_attributes == "YES") { $columntype.= " AUTO_INCREMENT";}	
					break;
					
					case "primary_key":
					if($_attributes == "YES") { $columntype.= " PRIMARY KEY";}	
					break;
					
					case "unique_key":
					if($_attributes == "YES") { $columntype.= " UNIQUE KEY";}	
					break;
					
					case "index":
					if($_attributes == "YES") { $columntype.= " KEY";}	
					break;
					
				}
		}
		if($newtable == "new")
		{
			return $column['field']['name']." ".$columntype.",";
		}
		else
		{
			return $this->objDB->query("ALTER TABLE ".$tablename." ADD ".$column['field']['name']." ".$columntype);	
		}
		
		
				
	}
	
/* Update column name and their attributes	*/
	
	private function Check_Column_Attribute($tablename, $columnname, $update="") {
		$columntype = "";
		if($update == "newcolumn")
		{
			$column_old_attribute = $this->objDB->query("DESCRIBE ".$tablename." ".$columnname['field']['name']);
		}
		else
		{
			$column_old_attribute = $this->objDB->query("DESCRIBE ".$tablename." ".$columnname['field']['new_name']);
		}
		$result = $column_old_attribute->fetchAll(PDO::FETCH_ASSOC);

		foreach($columnname['attributes'] as $key=>$_attributes)
		{
			
			
			switch ($key)
				{
					
					/*$columntype = "";*/
											
					case "type":
					$columntype.= $_attributes;
					break;
					
					case "null":
					 if($_attributes == "NO") { $columntype.= " NOT NULL";}	
					break;
					
					case "default":
					 if(!empty($_attributes) or ($_attributes == 0)) { $columntype.= " DEFAULT '".$_attributes."'"; }
					break;
					
					case "auto_increment":
					if($_attributes == "YES") { $columntype.= " AUTO_INCREMENT";}	
					break;
					
					case "primary_key":
					if($_attributes == "YES") { $columntype.= " PRIMARY KEY";}	
					break;
					
					case "unique_key":
					if($_attributes == "YES") { $columntype.= " UNIQUE KEY";}	
					break;
					
					case "index":
					if($_attributes == "YES") { $columntype.= " KEY";}	
					break;
					
				}			
		}
		
		if($update == "update")
		{
			$this->objDB->query("ALTER TABLE ".$tablename." CHANGE ".$columnname['field']['name']." ".$columnname['field']['new_name']." ".$columntype);	
			return TRUE;
		}
		else
		{
			if($update == "newcolumn")
			{
				 $this->objDB->query("ALTER TABLE ".$tablename." modify ".$columnname['field']['new_name']." ".$columntype);	
				 return TRUE;
			}
			else 
			{
				 $this->objDB->query("ALTER TABLE ".$tablename." modify ".$columnname['field']['name']." ".$columntype);	
				return TRUE;
			}
			
		}
		
	}
	
/* Main database table function	*/
	
	function Db_Delta($tablename, $columnname) {
		
		$checktable = $this->Check_Table_Exits($tablename);
		if(!empty($checktable))
		{
			
		    foreach($columnname as $_columnname)
		    {
				
				$checkcoloum = $this->Check_Column_Exits($tablename, $_columnname);	

				if(empty($checkcoloum))
				{
					$this->Create_Column($tablename, $_columnname);
				}
				else
				{
					$this->Check_Column_Attribute($tablename, $_columnname);
				}
				
			}
			$message = "Table updated";
		}
		else
		{
			$this->Create_Table($tablename, $columnname);
			$message = "Table create";
		}
			
		return $message;
	}
	
/* General query for select record from database*/
    
    function Direct_Query($query) {
        $data = $this->objDB->query($query);
		$getdata = $data->fetchAll(PDO::FETCH_ASSOC);
		return $getdata;
	}
    

    
/* Get data in json format*/
    
   function Select_Forjson($sql="")
   {
        
       if(empty($sql))
       {
           return false;
       }
       if(empty($this->objDB))
       {
           return false;
       }
       
       $conn=$this->objDB;
       $data=array();
      
       $count = 0;
        
       $results=$conn->prepare($sql);
       $n= $results->execute();
       
      $number_of_record=$results->fetchAll(PDO::FETCH_ASSOC);
      $data[$count]= $number_of_record;
     
      $count_record=sizeof($number_of_record);
     
     /* foreach ($data as $data1)
      {
        
      }*/
      return json_encode($data);       
   }
    
	/* check login user exits in database.*/
	
   function Check_User_Exitsindb ($tablename,$column,$id)
   {
     $strquery = ('SELECT * FROM ' . $tablename . ' WHERE 1=1 AND '.$column.'="'.$id.'"');
  	 $getdata=$this->Direct_Query($strquery);
  	 return count($getdata);
   }

}

?>
