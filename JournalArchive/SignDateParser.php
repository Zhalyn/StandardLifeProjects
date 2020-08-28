 <?php

$username = ////////////;
$password = ////////////;
$servername = ////////////;

$conn = oci_connect($username, $password, $servername, 'AL32UTF8');

$data = [];

if (!$conn) {
	die("Something went wrong");
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

if(isset($_POST["st"])){ //data received from the html POST method 
	
	$st = $_POST["st"];
	if($st != ""){
		$query="SELECT ag.ID, INSSUM, PAYSCHEDTYPE, AGREENO, 
				'['||h.id||']'||decode(h.CSTTYPEID, 1, h.IPNAME, h.URNAME) hname, 
				PREMIUM, CMSVLT, SIGNTIME, FROMDATE, TILLDATE, INSTILLDATE, 
				'['||s.id||'] ' || s.LASTNAME || ' ' ||  s.FIRSTNAME || ' ' || s.MIDDLENAME sname, 
				'['||m.id||'] ' || m.LASTNAME || ' ' ||  m.FIRSTNAME || ' ' || m.MIDDLENAME mname, ISCASH, 
				'['||a.id||'] ' || a.LASTNAME || ' ' ||  a.FIRSTNAME || ' ' || a.MIDDLENAME aname, STATE 
				FROM PLC_AGREE ag left join CST_CUSTOMERS h on h.id = ag.holderid
				left join CST_CUSTOMERS s on s.id = ag.signerid
				left join CST_CUSTOMERS m on m.id = ag.managercnid
				left join CST_CUSTOMERS a on a.id = ag.activatorid
				WHERE SIGNTIME = '" . $st . "'";

		// $result=mysqli_query($conn, $query);
		$stid = oci_parse($conn, $query);
		oci_execute($stid);
	}

	$i = 0;


	while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {

	$data[]= // <-- push new value in $data = array
       [
       	'col' => $i,
        'id' => $row['ID'],
        'inssum' => $row['INSSUM'],
        'payschedtype' => $row['PAYSCHEDTYPE'],
        'agreeno' => $row['AGREENO'],
        'hname' => $row['HNAME'],
        'premium' => $row['PREMIUM'],
        'cmsvlt' => $row['CMSVLT'],
        'signtime' => $row['SIGNTIME'],
        'fromdate' => $row['FROMDATE'],
        'tilldate' => $row['TILLDATE'],
        'instilldate' => $row['INSTILLDATE'],
        'sname' => $row['SNAME'],
        'mname' => $row['MNAME'],
        'iscash' => $row['ISCASH'],
        'aname' => $row['ANAME'],
        'state' => $row['STATE'],
       ];
    $i += 1;
	}


	echo json_encode($data);
}

?>
