<?php
class DatabaseClass {
	var $_dbhostName;
	var $_dbName;
	var $_dbUser;
	var $_dbPwd;
	var $_dbCon;

	function DatabaseClass (){

	$this->_dbhostName="127.0.0.1";
	$this->_dbName="assignment";
	$this->_dbUser="root";
	$this->_dbPwd="root";
	}

	function dbOpen(){
	$this->_dbCon=mysqli_connect($this->_dbhostName,$this->_dbUser,$this->_dbPwd) or die ("Could not connect DB");
	mysqli_select_db($this->_dbCon,$this->_dbName) or die ("Could not select DatabaseClass");
	}

	function dbClose(){
	mysqli_close($this->_dbCon);
	}

	function getConn(){
	return $this->_dbCon;
	}
}


class SqlClass{
	var $_dbSql;
	var $_dbTotalRecord;
	var $_dbFields=array();
	var $_objDatabaseClass;
	var $_dbNewID;		// This field will be used to get newly inserted id
	var $_dbAffectedRows;

	var $_dbErrMsg;
	var $_dbErr;	// Boolean
	var $_dbShowAdvanceError;	// Boolean

	function SqlClass(){

	$this->_dbSql="";
	$this->_dbTotalRecord=NULL;
	$this->_dbNewID=NULL;
	$this->_dbAffectedRows=NULL;
	$this->_dbErr=false;
	$this->_dbShowAdvanceError=false;
	$this->_dbErrMsg="";
	}

	function executeSql($sql,$doubtedFields=0){
		error_reporting(E_ALL);
ini_set('display_errors', '1');
		if(strtoupper(substr($sql,0,6))=="SELECT"){
		$Mode="Read";
		}
		else{
		$Mode="Write";
		}
		$this->_objDatabaseClass=new DatabaseClass();
		$this->_objDatabaseClass->dbOpen();
		# To check Weather Doubted Fields are present or Not
		if(is_array($doubtedFields) && $doubtedFields!=0){
			for($i=0; $i<count($doubtedFields); $i++){
				if(strpos($sql,'?')!==false){
					$start=substr($sql,0,strpos($sql,'?'));
					$end=substr($sql,strpos($sql,'?')+1);
					$sql=$start.$this->sql_quote($doubtedFields[$i]).$end;
				}

			}
		}//end Doubted Field Check
		switch($Mode){
		case "Read":

			$row=array();

			if($record=mysqli_query($this->_objDatabaseClass->getConn(), $sql)){
				$this->_dbTotalRecord=mysqli_num_rows($record);
				if($this->_dbTotalRecord>0){
				$fieldsname="";
				for($i=0; $i<mysqli_num_fields($record); $i++){
					$fieldsname .= mysqli_fetch_field_direct($record, $i)->name.",";
					}
				$rawData=array();
					while($row=mysqli_fetch_array($record))
					{
						foreach ($row as $fieldName => $fieldValue) {
							$rawData["$fieldName"]=stripslashes($fieldValue);
						}
					$this->_dbFields[]=$rawData;
					}
				mysqli_free_result($record);

				#Reversing The Array Coz I need to Fetch Record below function Using POP built in function Function
				$this->_dbFields = array_reverse($this->_dbFields, true);
				return $this->_dbFields;
				}
				else{
				$this->_dbErrMsg="<li>No Record Found</li>";
				$this->_dbErr=true;
				$this->_objDatabaseClass->dbClose();	// DisConnecting From DB
				return true;
				}
			}
			else{
				if($this->_dbShowAdvanceError){
					$this->_dbErrMsg='<br><b style="color:#FF0000">Your Query is</b> <br> '.$sql.' <br><b style="color:#FF0000"> Mysql Says</b><br>'.mysqli_error($this->_objDatabaseClass->getConn());
					}
				else{
					$this->_dbErrMsg="<li> A Problem Occur While Executing the Your Query</li>";
					}
				$this->_dbErr=true;
				$this->_objDatabaseClass->dbClose();	// DisConnecting From DB
				return false;

			}
		break;

		case "Write":

			if(mysqli_query($this->_objDatabaseClass->getConn(), $sql)){
				$this->_dbNewID=mysqli_insert_id($this->_objDatabaseClass->getConn());
				$this->_dbAffectedRows=mysqli_affected_rows($this->_objDatabaseClass->getConn());
				$this->_dbErrMsg="Record Sucessfully Inserted";
				$this->_dbErr=true;
				$this->_objDatabaseClass->dbClose();	// DisConnecting From DB
				return true;
			}
			else{
				if($this->_dbShowAdvanceError){
					$this->_dbErrMsg='<br><b style="color:#FF0000">Your Query is</b> <br> '.$sql.' <br><b style="color:#FF0000"> Mysql Says</b><br>'.mysqli_error($this->_objDatabaseClass->getConn());
					}
				else{
					$this->_dbErrMsg="<li> A Problem Occur While Executing the Your Query</li>";
					}
				$this->_dbErr=true;
				$this->_objDatabaseClass->dbClose();	// DisConnecting From DB
				return false;
			}
		break;

		}
	}


	function fetchRow(&$dbRows){
		if(is_array($dbRows)){
			$returnValue = array_pop($dbRows);
			if(!is_null($returnValue)){
				return $returnValue;
			}
			else{
				return false;
			}
		}
		else{
			$this->_dbErrMsg="0 Rows Found";
			$this->_dbErr=true;
		return false;
		}

	}

	function isError(){
	 return $this->_dbErr;
	}
	function getErrMsg(){
	 return $this->_dbErrMsg;
	}
	function getNumRecord(){
	 return $this->_dbTotalRecord;
	}
	function setAdvanceErr($value){
	 $this->_dbShowAdvanceError=$value;
	}
	function getNewID(){
	return $this->_dbNewID;
	}
	function getAffectedRows(){
	return $this->_dbAffectedRows;
	}

	function  sql_quote($value){
		if( get_magic_quotes_gpc() ){
		  $value = stripslashes($value);
		}
		//check if this function exists
		if( function_exists( "mysql_real_escape_string" ) ){
		  $value = mysqli_real_escape_string($value);
		}
		//for PHP version < 4.3.0 use addslashes
		else {
		  $value = addslashes($value);
		}
	return $value;
	}
}// SqlClass
?>