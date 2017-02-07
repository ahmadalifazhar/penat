<?php

/**
PinCloud - Author faridyusof727@gmail.com
*/

define("USERNAME", "marhazk_pinnew"); 
define("PASSWORD", "Missida890"); 
define("DB_NAME", "marhazk_pinnew"); 
define("DB_HOST", "localhost"); 

class dbcon
{
	private $host;
    private $user;
    private $pass;
    private $name;
    private $link;
    private $error;
    private $errno;
    private $query;
    private $status = 1;
	
	function __construct($host, $user, $pass, $name = "", $conn = 1) {
//        $this -> host = $host;
//        $this -> user = $user;
//        $this -> pass = $pass;
//        if (!empty($name)) $this -> name = $name;       
//        if ($conn == 1) $this -> connect();
    }
	
    function __destruct() {
        @mysql_close($this->link);
    }
	
	public function resetdbdata($host, $user, $pass, $name = "", $conn = 1)
	{
        $this -> host = $host;
        $this -> user = $user;
        $this -> pass = $pass;
        if (!empty($name)) $this -> name = $name;       
        if ($conn == 1) $this -> connect();
	}
	public function setStatus($stat)
	{
		$this->status = $stat;
	}
    public function connect() {
        if ($this -> link = mysql_connect($this -> host, $this -> user, $this -> pass)) {
            if (!empty($this -> name)) {
                if (!mysql_select_db($this -> name)) $this -> exception("Could not connect to the database!");
            }
        } else {
            $this -> exception("Could not create database connection!");
        }
    }

    public function close() {
        @mysql_close($this->link);
    }

    public function query($sql) {
        if ($this->query = @mysql_query($sql)) {
            return $this->query;
        } else {
            $this->exception("Could not query database!");
            return false;
        }
    }

    public function num_rows($qid) {
        if (empty($qid)) {          
            $this->exception("Could not get number of rows because no query id was supplied!");
            return false;
        } else {
            return mysql_numrows($qid);
        }
    }

    public function fetch_array($qid) {
        if (empty($qid)) {
            $this->exception("Could not fetch array because no query id was supplied!");
            return false;
        } else {
            $data = mysql_fetch_array($qid);
        }
        return $data;
    }

    public function fetch_array_assoc($qid) {
        if (empty($qid)) {
            $this->exception("Could not fetch array assoc because no query id was supplied!");
            return false;
        } else {
            $data = mysql_fetch_array($qid, MYSQL_ASSOC);
        }
        return $data;
    }

    public function fetch_all_array($sql, $assoc = true) {
        $data = array();
        if ($qid = $this->query($sql)) {
            if ($assoc) {
                while ($row = $this->fetch_array_assoc($qid)) {
                    $data[] = $row;
                }
            } else {
                while ($row = $this->fetch_array($qid)) {
                    $data[] = $row;
                }
            }
        } else {
            return false;
        }
        return $data;
    }
	

    public function last_id() {
        if ($id = mysql_insert_id()) {
            return $id;
        } else {
            return false;
        }
    }

    public function exception($message) {
       if ($this->status == 1)
	   {
			if ($this->link) {
				$this->error = mysql_error($this->link);
				$this->errno = mysql_errno($this->link);
			} else {
				$this->error = mysql_error();
				$this->errno = mysql_errno();
			}
			if (PHP_SAPI !== 'cli') {
			?>
	
				<div class="alert-bad">
					<div>
						Database Error
					</div>
					<div>
						Message: <?php echo $message; ?>
					</div>
					<?php if (strlen($this->error) > 0): ?>
						<div>
							<?php echo $this->error; ?>
						</div>
					<?php endif; ?>
					<div>
						Script: <?php echo @$_SERVER['REQUEST_URI']; ?>
					</div>
					<?php if (strlen(@$_SERVER['HTTP_REFERER']) > 0): ?>
						<div>
							<?php echo @$_SERVER['HTTP_REFERER']; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php
			} else {
				echo "+-------+ +-------+\n";
				echo "| +---+ | |       |\n";
				echo "| |   | | |  +----+\n";
				echo "| |   | | |  |     \n";
				echo "| |   | | |  +----+\n";
				echo "| |   | | |       |\n";
				echo "| +---+ | |  +----+\n";
				echo "|  ___  | |  |     \n";
				echo "| (   ) | |  +----+\n";
				echo "|  ---  | |       |\n";
				echo "+-------+ +-------+\n";
				echo "MYSQL ERROR: " . ((isset($this->error) && !empty($this->error)) ? $this->error:'') . "\n";
			};
	   }
	}
	
	
	

}

if (isset($_REQUEST[skey]))
{
			$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$db = new dbcon("localhost","root","", "blur");
		$db->setStatus(1);
		$db->resetdbdata(DB_HOST, USERNAME, PASSWORD, DB_NAME);
		$q = "call get_file_share('".$_REQUEST[skey]."');";
		$r = $db->query($q);
		if ($db->num_rows($r) == 1) {
				$path;
				$cloud_type;
				while ($data = $db->fetch_array_assoc($r)) 
				{		
					$owner = $data["owner"];
					$location = $data["location"];
					$cloud_type = $data["type"];
					$path = "modules/pages/cloud/files/".$owner."/".$location; 
					
					//header("Location: ".$path."");
					//$path = 'C:/wamp/www/test.avi'; // the file made available for download via this PHP file
					$mm_type="application/octet-stream"; // modify accordingly to the file type of $path, but in most cases no need to do so
					$basefile = basename($path);
					
					$basefile = explode("_",$basefile);
					$filename_temp = array_pop($basefile);
					$filename_temp2 = array_pop($basefile);
					$a_size = count($basefile);
				
					if ($a_size > 1)
					{
						$basefile = implode("_", $basefile);
					}
					else
					{
						$basefile = $basefile[0];
					}
					
					header("Pragma: public");
					header("Expires: 0");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Cache-Control: public");
					header("Content-Description: File Transfer");
					header("Content-Type: " . $mm_type);
					header("Content-Length: " .(string)(filesize($path)) );
					header('Content-Disposition: attachment; filename="'.$basefile.'.'.$cloud_type.'"');
					header("Content-Transfer-Encoding: binary\n");

					readfile($path); // outputs the content of the file
					
					exit();
					
				}
			}


		
}
else if (isset($_REQUEST[file])) 
{
	if ($member)
	{
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$db = new dbcon("localhost","root","", "blur");
		$db->setStatus(1);
		$db->resetdbdata(DB_HOST, USERNAME, PASSWORD, DB_NAME);
		$q = "call get_file('".$_REQUEST[file]."');";
	