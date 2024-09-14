<?php require_once('Connections/debdeb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO entry (name, message, alphabet) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['alphabet2'], "text"));

  mysql_select_db($database_debdeb, $debdeb);
  $Result1 = mysql_query($insertSQL, $debdeb) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
  $insertSQL = sprintf("INSERT INTO entryfood (name, message, alphabet) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['alphabet2b'], "text"));

  mysql_select_db($database_debdeb, $debdeb);
  $Result1 = mysql_query($insertSQL, $debdeb) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_Recordset1 = 3;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_debdeb, $debdeb);
$query_Recordset1 = "SELECT * FROM entry ORDER BY id DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $debdeb) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

mysql_select_db($database_debdeb, $debdeb);
$query_Recordset2 = "SELECT * FROM entryfood ORDER BY id DESC";
$Recordset2 = mysql_query($query_Recordset2, $debdeb) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>s h i r i t o r i</title>
<link href="mystyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
</script>
<script src="scripts/jquery-1.8.1.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>
</head>
<body>

<div id="container">

<div id="header">
    <div class="banner">
        <div class="title">shiritori
        <div class="subtitle">し  り  と  り</div></div>
        <div class="intro">
            <div style="font-size:32px;">the word chain game</div>
            <br />
            in which players come up with words
            that begin with the letter that the
            previous word ended with
        </div>
    </div>
</div>
<div class="clearall"></div>

<!-- =================================== -->
<!-- ==== END OF header            ===== -->
<!-- ==== START OF maincontentleft ===== -->
<!-- =================================== -->

<div id="maincontentleft">
    <div class="groups-header">
    	<div class="howto-pop">
			<div id="showoverlaybtn">Howto<br />play?</div>
            <div id="overlay">
            <div class="black"></div>
    
            <div id="red">
                <div class="howto">
                        <div class="minititle">
                        How do you play?
                        </div>
                        <div class="divider"></div>
                        <div class="words1">
                        Think of a word that
                        starts with the last letter
                        of the previous entry.
                        <br /><br />
                        ~
                        </div>
                        <div class="example">
                        user 1: pock<b>y</b>
                        user 2: <b>y</b>akul<b>t</b>
                        user 3: <b>t</b>ortill<b>a</b>
                        user 4: <b>a</b>pple
                        </div>
                     
			</div>
			</div>
		</div>

        </div>
		<div class="header-free">
        <div class="size24">☼ freestyle</div>
			anything goes
        </div>

		<div class="header-food">
          <div class="size24">♥ food</div>
            & drinks
		</div>
    </div>

    <div class="group-free">
		<table border="0">
		<tr>
		<td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
            <?php } // Show if not first page ?></td>
        <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
            <?php } // Show if not last page ?></td>
        <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
            <?php } // Show if not last page ?></td>
		</tr>
		</table>

		<?php do { ?>
		<div class="entry-free">
            <div class="entry-free-name"><?php echo $row_Recordset1['name']; ?>:</div>
            <div class="entry-free-message"><?php echo $row_Recordset1['alphabet']; ?><?php echo $row_Recordset1['message']; ?></div>
            <div class="entry-free-time"><?php echo $row_Recordset1['ctimestamp']; ?></div>
		</div>
		<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

    </div>


    <div class="group-food">
		<?php do { ?>
		<div class="entry-food">
            <div class="entry-food-name"><?php echo $row_Recordset2['name']; ?>:</div>
            <div class="entry-food-message"><?php echo $row_Recordset2['alphabet']; ?><?php echo $row_Recordset2['message']; ?></div>
            <div class="entry-food-time"><?php echo $row_Recordset2['ctimestamp']; ?></div>
		</div>
		<?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
	</div>

</div>

<!-- =================================== -->
<!-- ==== END OF maincontentleft   ===== -->
<!-- ==== START OF maincontentright ==== -->
<!-- =================================== -->

<div id="maincontentright">
    
	<div class="jointhegame">
		<div class="minititle">
        Join the game!
        </div>
		<div class="divider"></div>

	<div class="choose">
    <div class="grp1" style="margin-right:30px;" onclick="show('formone');hide('formtwo');"></div>
    <div class="grp1" onclick="show('formtwo');hide('formone');"></div>
    </div>
    
            <div id="formone" class="fadeIn fadeOut animated" style="display:none;">
            <form action="<?php echo $editFormAction; ?>" method="POST" name="form2" id="form2"
            onsubmit="MM_validateForm('name','','R','message','','R');return document.MM_returnValue">
    
                <label>Name:</label>
                <input type="text" name="name" id="name" maxlength="10"/>
                
                <div class="latestentry">
                    <label class="noinput">The latest entry is:</label><br />
                    <textarea name="preventry" id="preventry" readonly="readonly" /></textarea>
                </div>
        
                <div class="startwith">
                    <label class="noinput">Start your entry with:</label>
                    <input type="text" name="alphabet1" id="alphabet1" value="" readonly="readonly" />
                </div>
        
                <div class="startauto">
                <label>Message:</label><br />
                <input type="text" name="alphabet2" id="alphabet2" value="" readonly="readonly"/>
                <input type="text" name="message" id="message" maxlength="25"
                onkeypress="return restrictCharacters(this, event, alphaOnly)"
                onKeyDown="limitText(this.form.message,this.form.countdown,25);" 
                onKeyUp="limitText(this.form.message,this.form.countdown,25);" />
                <input readonly type="text" name="countdown" id="countdown" size="4" value="25">
                <div class="attention">*Please use alphabets only!</div>
				</div>
                <p>
                <input type="submit" name="button" id="button" value="Submit" />
                </p>
                <input type="hidden" name="MM_insert" value="form2" />
            </form>
            </div>

            <div id="formtwo" class="fadeIn fadeOut animated" style="display:none;">
              <form action="<?php echo $editFormAction; ?>" method="POST" name="form3" id="form3" onsubmit="MM_validateForm('nameb','','R','messageb','','R');return document.MM_returnValue">
                <label>Name:</label>
                <input type="text" name="name" id="nameb" maxlength="10"/>
                
                <div class="latestentry">
                    <label class="noinput">The latest entry is:</label><br />
                    <textarea name="preventry" id="preventryb" readonly="readonly" /></textarea>
                </div>
        
                <div class="startwith">
                    <label class="noinput">Start your entry with:</label>
                    <input type="text" name="alphabet1b" id="alphabet1b" value="" readonly="readonly" />
                </div>
        
                <div class="startauto">
                <label>Message:</label><br />
                <input type="text" name="alphabet2b" id="alphabet2b" value="" readonly="readonly"/>
                <input type="text" name="message" id="messageb" maxlength="25"
                onkeypress="return restrictCharacters(this, event, alphaOnly)"
                onKeyDown="limitText(this.form.message,this.form.countdown,25);" 
                onKeyUp="limitText(this.form.message,this.form.countdown,25);" />
                <input readonly type="text" name="countdown" id="countdown" size="4" value="25">
                <div class="attention">*Please use alphabets only!</div>
				</div>
                <p>
                <input type="submit" name="button" id="buttonb" value="Submit" />
                </p>
                <input type="hidden" name="MM_insert" value="form3" />
            </form>


            </div>
    </div>
    </div>


<div class="clearall"></div>

<!-- =================================== -->
<!-- ==== END OF maincontentright  ===== -->
<!-- ==== START OF footer          ===== -->
<!-- =================================== -->

<div id="footer"></div>
</div>

<script>

	$(document).ready(function() {
	
		// change textfield value (val)
		//$("#alphabet").val("123445");
		
		// length to get count of div
		//alert($(".entry-free").length);
		
		// show purpose of eq
		//$(".entry-free").eq(0).hide();
		//$(".entry-free").eq($(".entry-free").length - 1).hide();
		
		$(".grp1").click(function() {
			// to get html inside the div
			//alert($(".entry-free").eq(0).html());

			// children is to get the div inside the entry-free
			//var div = $(".entry-free").eq($(".entry-free").length - 1);
			var div = $(".entry-free").eq(0);

			var str = div.children(".entry-free-message").html();
			var endwidth = str.slice(str.length - 1, str.length);
			
			$("#preventry").val(str);
			$("#alphabet1").val(endwidth);
			$("#alphabet2").val(endwidth);


			var div = $(".entry-food").eq(0);

			var str = div.children(".entry-food-message").html();
			var endwidth = str.slice(str.length - 1, str.length);
			
			$("#preventryb").val(str);
			$("#alphabet1b").val(endwidth);
			$("#alphabet2b").val(endwidth);
		});
		
		$("#showoverlaybtn").click(function() {
			$("#overlay").show();

			//$("#overlay").css("color"
		});
		
		$("#overlay .black").click(function() {
			$("#overlay").hide();
		});
		
		
	});	
	

/*www.daniweb.com/web-development/javascript-dhtml-ajax/threads/385613/javascript-regular-expression-for-alphabetic-input-validation-allows-*/
var alphaOnly = /[A-Za-z]/g; //fname,lname,mname
function restrictCharacters(myfield, e, restrictionType) {
if (!e) var e = window.event
if (e.keyCode) code = e.keyCode;
else if (e.which) code = e.which;
var character = String.fromCharCode(code);
// if they pressed esc... remove focus from field...
if (code == 27) { this.blur(); return false; }
// ignore if they are press other keys
// strange because code: 39 is the down key AND ' key...
// and DEL also equals .
if (!e.ctrlKey && code != 9 && code != 8 && code != 36 && code != 37 && code != 38 && (code != 39 || (code == 39 && character == "'")) && code != 40)
{
if (character.match(restrictionType))
return true;
else
return false;
}
}
	
function show( id ) { 
	document.getElementById(id).style.display = 'block'; 
} 
function hide( id ) { 
	document.getElementById(id).style.display = 'none'; 
}

/*$("#btnLeft").click(function(){

     $(this).css("color","red");
     $(this).addClass("color");

});*/
</script>

</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
