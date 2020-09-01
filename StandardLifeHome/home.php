<!DOCTYPE html>
<html>
<head>
	<script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
	<title>Home Page</title>
  <link rel="stylesheet" type="text/css" href="homeStyle.css">
</head>
<body>
<div class="hero">
  <div id="header">Добро пожаловать, <?php session_start(); echo($_SESSION["user"]); ?>! Здесь вы сможете получить собственную информацию:</div>
    <table id="myTable" align="center" border="1px" style="width: 1400px; line-height: 30px;">
      <thead>
		    <tr>
			   <th colspan="6" style="font-family: Verdana;">
			   	<h2>Получить информацию</h2>
			   	<button name="displaydata" id="displaydata" onclick="parseData()">Получить</button>
			   </th>
		    </tr>
      </thead>
      <tbody>
        <t class="element">
          <th class="title" style="font-family: Verdana;">Номер Договора</th>
          <th class="title" style="font-family: Verdana;">Наименование ИП</th>
          <th class="title" style="font-family: Verdana;">Дата Начала</th>
          <th class="title" style="font-family: Verdana;">Дата Окончания</th>
          <th class="title" style="font-family: Verdana;">Сумма Оплаты</th>
          <th class="title" style="font-family: Verdana;">Дата Оплаты</th>
        </t>
      </tbody>
      <tbody id="searchRes">
    	
      </tbody>
    </table>
</div>
    <script type="text/javascript">

    function colorize() {
    var elements = document.getElementsByTagName("tr");
      for(i = 0; i < elements.length; i++) {
        if((Math.round(i / 2) * 2) == ((i / 2) * 2) )
          elements.item(i).style.background="#E8ECFF";
      } 
    }

    window.onload = colorize;


    function parseData() {

   $.ajax({
      url: "homeDataParser.php",
      type: "POST",
      dataType: "JSON",
      data: $('#displaydata').serialize(), 
      success: function (res) { //resulted data from the database
          console.log(res);

          let responseData = "";

          if(res.length != 0){ //printing an empty table if values in the array are undefined
            for(i=0; i<res.length; i++){
              responseData +=
                  "<tr>" +
                  '<td class="count" style="font-family: Verdana;">' +
                  res[i]["id"] +
                  "</td>";
              responseData +=
                  '<td class="title" style="font-family: Verdana;">' +
                  res[i]["credit"] +
                  "</td>";
              responseData +=
                  '<td class="title" style="font-family: Verdana;">' +
                  res[i]["debt"] +
                  "</td>";
              responseData +=
                  '<td class="title" style="font-family: Verdana;">' +
                  res[i]["balance"] +
                  "</td>";
              responseData +=
                  '<td class="title" style="font-family: Verdana;">' +
                  res[i]["credit"] +
                  "</td>" + 
                  "</tr>";
            }
            $("#searchRes").html(responseData);
          }

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log("errorGET: "+ textStatus + ", Error: " + errorThrown);
      }
    });
    }
    </script>
</body>
</html>