<?php

$username = "LIFEFND";
$password = "lifefnd11!!";
$servername = "10.0.0.28/LIFEFND";

$conn = oci_connect($username, $password, $servername, 'AL32UTF8');

$data = [];

if (!$conn) {
    die("Something went wrong");
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

    $query="SELECT p.agreeno, c.ipname, p.fromdate, p.tilldate, ps.payedsum, ps.payeddate, ps.* FROM PLC_AGREE p, CST_CUSTOMERS c, PLC_PAYSCHED ps WHERE p.HOLDERID = c.ID and p.ID = ps.AGREEID and c.INN = '110240017886'"; // for later

	$stid = oci_parse($conn, $query);
        oci_execute($stid);

	$i = 0;

	while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)){

	$data[]= // <-- push new value in $data = array
       [
        'num' => $i,
        'agreeno' => $row['AGREENO'],
        'ipname' => $row['IPNAME'],
        'fromdate' => $row['FROMDATE'],
        'tilldate' => $row['TILLDATE'],
        'payedsum' => $row['PAYEDSUM'],
        'payeddate' => $row['PAYEDDATE']
       ];
     $i += 1;
	}


	echo json_encode($data);

?>