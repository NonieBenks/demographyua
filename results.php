<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Author" content="Бенько Наталія Олександрівна">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<style type="text/css">
	body{
		font-family: 'Oswald',sans-serif;
	}
	td, th{
		border-bottom: 1px solid #ddd;
	}
	table{
		width: 500px;
		border-spacing: 0;

	}
	.name {
		border: 0px;
	}
	input{
		color: white;
		background-color: #B2A197; 
		font-size: 20px;
		border: none;
		padding: 15px 32px;
		border-radius: 4px;
		border: 2px solid #877B74;
		font-family: 'Oswald',sans-serif;
	}
	input:hover{
		
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
    background-color: #FE5F1A;
    color: white;
}
</style>
</Head>
<title> Демографія </title>
<BODY>
<?php
/* Змінні для з'єднання з базою даних */

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
//Обрати базу даних
$db_selected = mysql_select_db(
   $db, 
   $link
);

/* Обробка даних, отриманих методом post */

/* Скласти запит для вибірки інформації */
$query = "SELECT Year, Population, Born, Died, Emigrated, Immigrated FROM Years";
/* Виконати запит. */
$result = mySQL_query($query) or die (mySQL_error());

/* Вибрати черговий запис з таблиці. */
while ($row = mySQL_fetch_array($result)){ // беремо
	// Результати з кожного рядка
	/* Вивести її у вигляді HTML */
	$rowarray = array($row['Year'],$row['Population'],$row['Born'],$row['Died'],$row['Emigrated'],$row['Immigrated']);
	array_push($yearsArr, $rowarray);
};
echo "<div class = 'table'>";
echo "<TABLE BORDER=0>";
echo "<tr class='name'>
<th>Рік</th>
<th>Приріст населення</th>
<th>Природний приріст</th>
<th>Міграційний приріст</th>
</tr>";
$delete = "DELETE From Results WHERE Year > 1";
$first = mySQL_query($delete);
for($i = 0; $i < count($yearsArr); $i++){
	$y = $yearsArr[$i][0];
	$a = $yearsArr[$i - 1][1] - $yearsArr[$i][1];
	$b = $yearsArr[$i][2] - $yearsArr[$i][3];
	$c = $yearsArr[$i][4] - $yearsArr[$i][5];

	echo "<tr><td>". $y . "</td>".
		"<td>"; 
		if($i == "0") echo "NA" . "</td>"; else 
		echo ($a). "</td>";
		if($i == "0") echo "<td>"."NA" . "</td>"; else 
		echo
		"<td>". ($b) . "</td>";
		if($i == "0") echo "<td>"."NA" . "</td>"; else 
		echo
		"<td>". ($c) . "</td>".
		"</tr>";
		if (2>1){
		$query = sprintf("INSERT INTO Results(Year, Growth, Nature, Migration) VALUES('%s','%s','%s','%s')",
    mysql_real_escape_string($y),
    mysql_real_escape_string($a),
    mysql_real_escape_string($b),
    mysql_real_escape_string($c));
		}else{
		continue;
}
	
	$result = mysql_query($query);
}	


echo "</TABLE>";
echo "</div>";

if (!$result) {
    $message  = 'Неверный запрос: ' . mysql_error() . "\n";
    $message .= 'Запрос целиком: ' . $query;
    die($message);

}
/* Закрити з’єднання */
mySQL_close();
?>
<div class="term"><h3>Термінологія</h3>
<p><b>Щільність</b> - середня кількість жителів на кілометр квадратний.</p>
<p><b>Приріст</b> - загальний показник, який показує на скільки осіб змінюється кількість населення в наслідок природного і міграційного приросту.</p>
<p><b>Природний приріст</b> - перевищення показників народжуваності над смертністю.</p>
<p><b>Міграційний приріст</b> - різниця між кількістю прибулих на дану територію та кількістю вибулих за її межі.</p></div>
<form><input type="button" value="Повернутись" onClick='location.href="http://localhost/site/demography/demoua.php"'></form>

</BODY>