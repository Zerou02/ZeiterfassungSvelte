<?php
header('Content-type: text/html; charset=ISO-8559-1');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
//$db = new PDO("mysql:host=localhost;dbname=AIDARo068712;charset=utf8", "root", "");

$verbindung = odbc_connect("AidaRo068712", "", "");
if (!$verbindung)
	die("keine Verbindung zur DB");

#$abfrage="select Name_Vorname from Personalstamm WHERE Anwesend = 'J' ORDER BY Name_Vorname";
#$ergebnis=odbc_exec($verbindung,$abfrage);
$abfrage1 = "SELECT PersonenbezDaten.Name_Vorname
			FROM (PersonenbezDaten INNER JOIN Personalstamm ON PersonenbezDaten.RecID_C_ = Personalstamm.RecID_C_) INNER JOIN OrgStrukturPerson ON Personalstamm.RecID_C_ = OrgStrukturPerson.RecID_C_
				WHERE (((OrgStrukturPerson.Abteilung)=1) AND ((Personalstamm.Anwesend)=1)) ORDER BY Name_Vorname";
$abfrage2 = "SELECT PersonenbezDaten.Name_Vorname
			FROM (PersonenbezDaten INNER JOIN Personalstamm ON PersonenbezDaten.RecID_C_ = Personalstamm.RecID_C_) INNER JOIN OrgStrukturPerson ON Personalstamm.RecID_C_ = OrgStrukturPerson.RecID_C_
				WHERE (((OrgStrukturPerson.Abteilung)=101) AND ((Personalstamm.Anwesend)=1)) ORDER BY Name_Vorname";
$abfrage3 = "SELECT PersonenbezDaten.Name_Vorname
			FROM (PersonenbezDaten INNER JOIN Personalstamm ON PersonenbezDaten.RecID_C_ = Personalstamm.RecID_C_) INNER JOIN OrgStrukturPerson ON Personalstamm.RecID_C_ = OrgStrukturPerson.RecID_C_
				WHERE (((OrgStrukturPerson.Abteilung)=150) AND ((Personalstamm.Anwesend)=1)) ORDER BY Name_Vorname";
$abfrage4 = "SELECT PersonenbezDaten.Name_Vorname
			FROM (PersonenbezDaten INNER JOIN Personalstamm ON PersonenbezDaten.RecID_C_ = Personalstamm.RecID_C_) INNER JOIN OrgStrukturPerson ON Personalstamm.RecID_C_ = OrgStrukturPerson.RecID_C_
				WHERE (((OrgStrukturPerson.Abteilung)=200) AND ((Personalstamm.Anwesend)=1)) ORDER BY Name_Vorname";
$abfrage5 = "SELECT PersonenbezDaten.Name_Vorname
			FROM (PersonenbezDaten INNER JOIN Personalstamm ON PersonenbezDaten.RecID_C_ = Personalstamm.RecID_C_) INNER JOIN OrgStrukturPerson ON Personalstamm.RecID_C_ = OrgStrukturPerson.RecID_C_
				WHERE (((OrgStrukturPerson.Abteilung)=250) AND ((Personalstamm.Anwesend)=1)) ORDER BY Name_Vorname";
/* 
function printSection($db, $sectionNr, $sqlQuery)
{
	$a = $db->query($sqlQuery);
	echo ($sectionNr);
	echo ("\n");
	foreach ($a->fetchAll() as $res) {
		echo ($res["Name_Vorname"]);
		echo ("\n");
	}
	echo ("\n");
}

printSection($db, "1", $abfrage1);
printSection($db, "101", $abfrage2);
printSection($db, "150", $abfrage3);
printSection($db, "200", $abfrage4);
printSection($db, "250", $abfrage5);
 */

# odbc_result_all($ergebnis,"bgcolor='#FFCC33' width=300 height=100");
# odbc_result_all($ergebnis1,"bgcolor='#FFCC33' width=300 height=100");
$ergebnis1 = odbc_exec($verbindung, $abfrage1);
$ergebnis2 = odbc_exec($verbindung, $abfrage2);
$ergebnis3 = odbc_exec($verbindung, $abfrage3);
$ergebnis4 = odbc_exec($verbindung, $abfrage4);
$ergebnis5 = odbc_exec($verbindung, $abfrage5);

echo "Abteilung 1";
echo utf8_encode(odbc_result_all($ergebnis1, ""));
echo "Abteilung 101";
echo utf8_encode(odbc_result_all($ergebnis2, ""));
echo "Abteilung 150";
echo utf8_encode(odbc_result_all($ergebnis3, ""));
echo "Abteilung 200";
echo utf8_encode(odbc_result_all($ergebnis4, ""));
echo "Abteilung 250";
echo utf8_encode(odbc_result_all($ergebnis5, ""));

/* echo "<table summary='Anwesenheitsliste'\n>";
echo "<caption>Anwesenheit</caption>\n";
echo "<tbody>\n";
echo "<tr>\n";
echo "<td>";
odbc_result_all($ergebnis1, "bgcolor='#FFCC33' width=300 height=100");
echo "</td>";
echo "<td>";
odbc_result_all($ergebnis2, "bgcolor='#FFCC33' width=300 height=100");
echo "</td>";
echo "<td>";
odbc_result_all($ergebnis3, "bgcolor='#FFCC33' width=300 height=100");
echo "</td>";
echo "<td>";
odbc_result_all($ergebnis5, "bgcolor='#FFCC33' width=300 height=100");
echo "</td>";
echo "<td>";
odbc_result_all($ergebnis4, "bgcolor='#FFCC33' width=300 height=100");
echo "</td>";
echo "Hello World"; */

odbc_close($verbindung);
?>