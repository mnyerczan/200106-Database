<?php
namespace Database;
use Exception;


class LoadIni
{
    private $name,
            $pass,
            $host,
            $db;

    public function __get($name)
    {
        switch($name)
        {
            case "name": return $this->name;
            case "pass": return $this->pass; 
            case "host": return $this->host;
            case "db":   return $this->db;
        }
    }    
    
    public function loadDatas($file)
    {    
        $f = fopen($file, 'r');        
        while(!feof($f))
        {            
            $row = fgets($f);           
            if($row[0] != "#")
            {               
                $row = explode("=", $row);                
                if(sizeof($row) == 2)
                {   
                    $row[1] = trim($row[1]);
                    switch(trim($row[0]))
                    {
                        case "user":        $this->name = $row[1]; break; 
                        case "password":    $this->pass = $row[1]; break;
                        case "host":        $this->host = $row[1]; break;
                        case "database":    $this->db   = $row[1]; break;
                    }
                }
            }
        }
    }
}

?>