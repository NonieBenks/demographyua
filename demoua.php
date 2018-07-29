<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Author" content="Бенько Наталія Олександрівна">
<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
<style type="text/css">

body{
	font-family: 'Oswald', sans-serif;
}
table{
	width: 100%;
	border-bottom: : 1px solid black;
	vertical-align: top;
	border-spacing: 15px;
	color: #556A78;
	background-color: white;
	margin: 0;
	font-family: 'Oswald';font-size: 16px;
	border: 3px solid #83B9BD;
}

th{
	border-bottom: 3px solid #D74F01;
	font-family: 'Oswald';font-size: 18px;
	color: white;
	background-color: #FE9749; 
}

h2 {
	color: #2E373E;
	text-align: center;
	text-transform: capitalize;
	font-family: 'Oswald';font-size: 25px;
}
.enter {
	position: center;
	background-color:#FE7531;
}
.put {
	position: center;

}
.name{
	border: 0px;
	color: black;
	font-weight: 700;

}
.year{
	width:100px;
}
.res{
	background-color: #547897;
	color: white;
	font-weight: 700;
	border: none;
	padding: 15px 32px;
	font-size: 16px;
	margin-left: 400px;
}
.res:hover {
	background-color: white; 
    color: #547897;
    border: 3px solid #547897;
    transition-duration: 0.3s;
}
.sub{
	background-color: #FE7531;
	color: white;
	font-weight: 700;
	border: none;
	padding: 15px 32px;
	font-size: 16px;
}
.sub:hover{
	background-color: white; 
    color: #FE7531;
    border: 3px solid #FE7531;
    transition-duration: 0.3s;
}

.exit{
	background-color: #549597;
	color:white;
	font-weight: 700;
	border: none;
	padding: 15px 32px;
	font-size: 16px;
	margin-left: 50px;
}
.exit:hover{
	background-color: white; 
    color: #549597;
    border: 3px solid #549597;
    transition-duration: 0.3s;
}
</style>

</Head>
<title> Демографія </title>
<BODY>
<h2>Історія населення України</h2>

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
/* Обрати базу даних.*/
$db_selected = mysql_select_db(
   $db, 
   $link
);

/* Обробка даних, отриманих методом post */
if ($_POST['add'])
{
echo "Виконано запит: Додати ".$_POST['Year']." рік"."<BR>";
$sql = mysql_query("INSERT into Years(Year, Population, Born, Died, Emigrated, Immigrated)
values ('".$_POST['Year']."','".$_POST['Population']."','".$_POST['Born']."','".$_POST['Died']."','".$_POST['Emigrated']."', '".$_POST['Immigrated']."');");
}
if ($_POST['delete'])
{
echo "Done query: Delete ".$_POST['Year']."<BR>";
$sql = mysql_query("DELETE from Years where Year=".$_POST['Year']);
}
if ($_POST['update'])
{
echo "Done query: Update ".$_POST['Year']. " на
".$_POST['Population']." ".$_POST['Born']." ".$_POST['Died']." ".$_POST['Emigrated']." ".$_POST['Immigrated']."<BR>";
$sql = "UPDATE Years SET Population='".$_POST['Population']."',Born='".$_POST['Born']."',Died='".$_POST['Died']."',Emigrated='".$_POST['Emigrated']."',
Immigrated='".$_POST['Immigrated']."' where Year=".$_POST['Year'];
echo $sql."<BR>";
mysql_query($sql) OR DIE ("Не можу виконати запит");
}

/* Скласти запит для вибірки інформації */
$query = "SELECT Year, Population, Born, Died, Emigrated, Immigrated FROM Years";
/* Виконати запит. */
$result = mySQL_query($query) or die (mySQL_error());
echo "<TABLE BORDER = 0>";
echo "<tr class = 'name'><th>Рік</th><th>Населення</th><th>Народилось</th><th>Померло</th><th>Емігрувало</th><th>Іммігрувало</th></tr>";
/* Вибрати черговий запис з таблиці. */
while ($row = mySQL_fetch_array($result)){ // беремо
// Результати з кожного рядка
/* Вивести її у вигляді HTML */

echo "<tr><td>". $row['Year']. "</td><td>". $row['Population']. "</td><td>". $row['Born']. "</td><td>". $row['Died']. "</td><td>". $row['Emigrated']. "</td><td>". $row['Immigrated']. "</td></tr>";
};
echo "</TABLE>";
/* Закрити з’єднання */
mySQL_close();
?>
<form action="demoua.php" method="post">
<table align="center">
<tr class="enter">
<td valign="top" ><input name="Year" class="year" type="text"
 /></td>
<td valign="top"><input name="Population" class="put" type="text"
 /></td>
<td valign="top"><input name="Born" class="put" type="text"
 /></td>
<td valign="top"><input name="Died" class="put" type="text"
 /></td>
<td valign="top"><input name="Emigrated" class="put" type="text"
/></td>
<td valign="top"><input name="Immigrated" class="put" type="text"
 /></td>
</tr>
<tr><td colspan=6>
<input name="add" class = "sub" type="submit" value="Додати" />
<input name="update" type="submit" class = "sub" value="Обновити" />
<input name="delete" type="submit" class = "sub" value="Видалити" />
<input type="button" class ="res" value="Результат" onClick='location.href="http://localhost/site/demography/results.php"'>
<input type="button" class ="exit" value="Більше" onClick='location.href="http://localhost/site/demography/moredata.php"'>
</td></tr>
</table>
</form>
</BODY>
