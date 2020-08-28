<?php
class User extends Core {
	public $conn;
	private $table_name = "user";

	public $id;
	public $level;
	public $username;
	public $password;
	public $nama_lengkap;

	public $user;

	public $cekOk;
	public $cekFail;
	
	public function __construct($db) {
		$this->conn = $db;
	}

	public function selectAll(){
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} WHERE level ='user'");
		
		return $stmt;
	}

	public function selectById($id){
		$id = $this->decode($id);
		$stmt = $this->conn->query("SELECT * FROM {$this->table_name} WHERE id = '$id'");

		return $stmt;
	}

	public function insert(){
		$stmt = $this->conn->prepare("INSERT INTO {$this->table_name} VALUES (?, ?, ?, md5(?), ?)");
		$stmt->bind_param("sssss", 
			$this->id, 
			$this->level, 
			$this->username, 
			$this->password,
			$this->nama_lengkap
		);

		if($stmt->execute())
		{
			return true;
		}
		else 
		{
			return $this->conn;
		}
	}

	public function delete()
	{
		$query = "DELETE FROM {$this->table_name} WHERE id = ?";
		$stmt = $this->conn->prepare($query);
		$key = $this->decode($this->id);

		$stmt->bind_param('s', $key);

		if($stmt->execute()) {
			return true;
		}
		else{
			return $this->conn->error;
		}

	}

	public function updateAll() {
		$query = "UPDATE {$this->table_name}
				SET
					username = ?,
					password = md5(?),
					nama_lengkap = ?
				WHERE
					id = ?";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('ssss', $this->username, $this->password, $this->nama_lengkap, $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return $this->conn->error;
		}
	}

	public function update() {
		$query = "UPDATE {$this->table_name}
				SET
					username = ?,
					nama_lengkap = ?
				WHERE
					id = ?";
		$stmt = $this->conn->prepare($query);

		$stmt->bind_param('sss', $this->username, $this->nama_lengkap, $this->id);

		if ($stmt->execute()) {
			return true;
		} else {
			return $this->conn->error;
		}
	}

	
	public function countAll(){
		$query = "SELECT count(*) as total FROM {$this->table_name}";
		$stmt = $this->conn->query($query);

		return $stmt;
	}

	public function login() {
        $user = $this->cekUser($this->username, $this->password);
        if (is_object($user)) {
            $this->user = $user;
            session_start();
            $_SESSION['nama_lengkap'] = $user->nama_lengkap;
            $_SESSION['id'] = $user->id;
            $_SESSION['level'] = $user->level;
            $_SESSION['username'] = $user->username;
            return $user->nama_lengkap;
        }
        return false;
    }

    protected function cekUser($username, $password)
    {
    	$stmt = "SELECT * FROM {$this->table_name} WHERE username = '$username' AND password = '$password'";
    	$query = $this->conn->query($stmt);
    	if($query->num_rows > 0)
    	{
    		$result = $query->fetch_object();
    	}
    	else
    	{
    		$result = 0;
    	}

    	return $result;

    }

    public function getUser() {
        return $this->user;
    }

    public function cekResponOk($id) {
       	$query = $this->conn->query("SELECT `id_alternatif` FROM `saw_responden`, `user` WHERE `id_responden` = '$id' GROUP BY `id_alternatif`");

       	$index = 0;
       	while($result = $query->fetch_object()) {
       		$index++;
       	}

    	return $index;
    }

    public function cekResponPending($id) {
       	$query = $this->conn->query("SELECT `id_alternatif` FROM saw_alternatif");

       	$index = 0;
       	while($result = $query->fetch_object()) {
       		$index++;
       	}

       	$index -= $this->cekResponOk($id);

    	return $index;
    }

    public function responSukses($id) {
    	$query = $this->cekResponOk($id);
    	return $this->cekOk = $query;
    }

}