<?php
class DatabaseModel
{
	private mysqli $mysqli;
	private string $host='localhost';
	private string $database= 'sem4';
	private string $user= 'root';
	private string $password= '';

	function connect(): void
	{
		$this->mysqli = new mysqli(
			$this->host,
			$this->user,
			$this->password,
			$this->database);
		$error="";	
		if ($this->mysqli->connect_error)
			throw new Exception('Error: ' . $this->mysqli->connect_error);	
	}

	public function selectQuery(string $table, array $atr, string $param): array
	{
		$query_result = $this->mysqli->query("SELECT " . implode(",",$atr) . " FROM " . $table . " WHERE " . $param . ";");
		$rows = $query_result->fetch_all(MYSQLI_ASSOC);
		return $rows;
	}

	public function deleteQuery(string $table, string $param): void
	{
		$query = $this->mysqli->query("DELETE FROM " . $table . " WHERE " . $param . ";");
	}

	public function insertQuery(string $table, string $type, array $params): void
	{
		$keys=array_keys($params);
		$val=array_values($params);
		$atr=implode(",",$keys);
		$quo=str_repeat('?,',count($params));
		$quo=substr($quo,0,-1);
		$query = $this->mysqli->prepare("INSERT INTO " . $table . "(" . $atr . ") VALUES( " . $quo . ");");
		$query->bind_param($type, ...$val);
		$query->execute();

	}

	public function updateQuery(string $table, string $type, array $params, string $cond): void
	{
		$keys=array_keys($params);
		$val=array_values($params);
		$quo=implode(" = ?, ",$keys) . "= ? ";
		$query = $this->mysqli->prepare("UPDATE " . $table . " SET " . $quo . " WHERE " . $cond . ";");
		$query->bind_param($type, ...$val);
		$query->execute();

	}
}