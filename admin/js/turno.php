 <?php 
/*$gmtDate = gmdate("D, d M Y H:i:s");
header("Expires:{$gmtDate} GMT");
header("Last-Modified: {$gmtDate} GMT");
header("Cache-Control: no-change, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: text/html; charset=ISO-8859-1",true) ;*/
include("config.php"); 


$marca = $_GET['marca'];



$dbQuery2 = "SELECT  turno. * FROM turno, curso_turno, curso";
$dbQuery2 .= " WHERE curso_turno.cursoid = curso.id";
$dbQuery2 .= " AND curso.id = '$marca'";
$dbQuery2.= " AND curso_turno.turnoid = turno.id";
$dbQuery2 .= " ORDER BY turno.id";
$dbResult2 = mysql_query($dbQuery2) or die (mysql_error());			
$linha = mysql_num_rows($dbResult2);
$array = '[';
$cont = 0;
while ($dbRow2 = mysql_fetch_assoc($dbResult2))
{
	$cont++;
	$array .= '"'.$dbRow2['id'].','.$dbRow2['nome'].'"';
	if ($cont != $linha)
		$array .= ',';
}
$array .= ']';	
echo $array;
?>