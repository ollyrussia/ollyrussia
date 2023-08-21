<?	
	header('Access-Control-Allow-Origin: *');
	
	$host = 'localhost';
    $db   = 'cf78864_tilda';
    $user = 'cf78864_tilda';
    $pass = '2csKb6B5';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    //
    
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
    	$sql = "UPDATE tilda_counter SET count = count+1 WHERE name = 'olly_birthday' ";								  
	    $stmt = $pdo->prepare($sql);
		$stmt->execute();
	}
	echo "ok";

	

	
?>