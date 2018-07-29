<html>
<head>
	<title>Більше даних</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<style type="text/css">
	body{
		margin: 0;
		font-family: 'Oswald',sans-serif;
	}
	td, th{
		border-bottom: 1px solid #ddd;
	}
	table{
		width:500px;
	}
	.name {
		border: 0px;
	}
	input{
		color: white;
		background-color: #B2A197; 
		font-size: 16px;
		border: none;
		padding: 15px 32px;
		border-radius: 4px;
		border: 2px solid #877B74;
		margin-left: 360px;
		font-family: 'Oswald',sans-serif;
	}
	.table{
		float: left;
		margin-right: 30px;
	}
	h3{
		text-align: center;
	}
	tr:nth-child(even) {
		background-color: #f2f2f2;
	}
	th {
    background-color: #1E737C;
    color: white;
}
.term {
	text-align: left;
}
img {
	display: block;
	margin-left: 860px;
	opacity: 0.7;
	margin-top: 210px;


</style>
</head>
<body>
<?php
//Змінні для з'єднання з базою даних
$user = 'root';
$password = 'root';
$db = 'Country';
$host = 'localhost';
$port = 3306;

$link = mysql_connect(
   "$host:$port", 
   $user, 
   $password
);
$db_selected = mysql_select_db(
   $db, 
   $link
);
$query = "SELECT Year, Population, Born, Died, Emigrated, Immigrated FROM Years";
/* Виконати запит. */
$result = mySQL_query($query) or die (mySQL_error());
while ($row = mySQL_fetch_array($result)){ // беремо
	// Результати з кожного рядка
	/* Вивести її у вигляді HTML */
	$rowarray = array($row['Year'],$row['Population'],$row['Born'],$row['Died'],$row['Emigrated'],$row['Immigrated']);
	array_push($yearsArr, $rowarray);
};
?>
<div class = "table">
<TABLE BORDER=0>
<tr class='name'>
<th>Рік</th>
<th>Щільність</th>
<th>Природний приріст/добу</th>
<th>Міграційний приріст/добу</th>
<th>Приріст/добу</th>
</tr>
<?php
//Очищаємо таблицю від даних
$delete = "DELETE From MoreData WHERE Year > 1";
$first = mySQL_query($delete);
for($i = 0; $i < count($yearsArr); $i++){
	
	$y = ($yearsArr[$i][0]);
	$a = $yearsArr[$i][1]/576320;
	$b = ($yearsArr[$i][2] - $yearsArr[$i][3])/365;
	$c = ($yearsArr[$i][5] - $yearsArr[$i][4])/365;
	$d = $b+$c;

	echo "<tr><td>".$y."</td><td>"; 
		echo number_format($a, 2) . "</td><td>";
		if($i == "0") echo "NA" . "</td>"; else
		echo
		number_format($b, 2) . "</td><td>";
	
		if($i == "0") echo "<td>"."NA" . "</td>"; else
		echo
		number_format($c, 2). "</td><td>";	

		if($i == "0") echo "<td>"."NA" . "</td>"."</tr>"; else
		echo
		number_format($d, 2). "</td></tr>";
		
		if (2>1){
		$query = sprintf("INSERT INTO MoreData(Year, Dencity, DayNature, DayMigration, 
	DayGrowth) VALUES('%s','%s','%s','%s','%s')",
    mysql_real_escape_string($y),
    mysql_real_escape_string($a),
    mysql_real_escape_string($b),
    mysql_real_escape_string($c),
    mysql_real_escape_string($d));
		}else{
		continue;
}
	
	$result = mysql_query($query);
}

if (!$result) {
    $message  = 'Неверный запрос: ' . mysql_error() . "\n";
    $message .= 'Запрос целиком: ' . $query;
    die($message);

}

echo "";
echo "</TABLE>";
?>
<form>
	<input type="button" class ="exit" value="До головної" onClick='location.href="http://localhost/site/demography/demoua.php"'>
</form></div>
<div class="term"><h3>Термінологія</h3>
<p><b>Щільність</b> - середня кількість жителів на кілометр квадратний.</p>
<p><b>Приріст/добу</b> - загальний показник, який показує на скільки осіб змінюється кількість населення в наслідок природного і міграційного приросту.</p>
<p><b>Природний приріст/добу</b> - перевищення показників народжуваності над смертністю.</p>
<p><b>Міграційний приріст/добу</b> - різниця між кількістю прибулих на дану територію та кількістю вибулих за її межі.</p></div>

<img src = "ukraine-map.png"/>

</body>
</html>