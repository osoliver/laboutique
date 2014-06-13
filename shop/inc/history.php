<HTML>
<HEAD>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Coustard' rel='stylesheet' type='text/css'>
    <LINK href="../css/index.css" rel="stylesheet" type="text/css">
    <LINK href="../css/basket.css" rel="stylesheet" type="text/css">
    <LINK href="../css/history.css" rel="stylesheet" type="text/css">
    <TITLE>Details de votre commande</TITLE>
</HEAD>
<?PHP

include_once("../../misc/error.php");
include_once("../../mysqlconnect.php");

$link = my_connect();
session_start();
?> 
<BODY>
<div id="content">
    <div id="history">
		<table id="table_basket">
		<tr>
			<th>Nom</th>
			<th>Quantite</th>
			</tr>
<?PHP
$query = "SELECT * FROM `history` WHERE command_id = ".$_GET['id'];
$res = mysqli_query($link, $query);
	while ($res_arr = mysqli_fetch_array($res))
	{
		$query = "SELECT * FROM product WHERE product_id = ".$res_arr['product_id'];
		$res_2 = mysqli_query($link, $query);
		$res_temp = mysqli_fetch_array($res_2);
		$product = $res_temp['name'];
		$quantity = $res_arr['product_quantity'];
		echo '
		<tr>
			<td><div id="basket_prod_name">'.$product.'</div></td>
			<td><div id="basket_prod_quantity">'.$quantity.'</div></td>
		</tr>';
	}
	echo '
		</table>';

?>
  
    </div>
</div>
</BODY>
</HTML>
