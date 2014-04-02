<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Street data - List</TITLE>
<meta http-equiv="content-type" content="text/html charset=iso-8859-1">
<LINK REL=stylesheet TYPE="text/css" HREF="udh.css">
</HEAD>

<BODY>
<div id="wrapper">
<div id="header">
<div id="logo">

<!-- Main Heading --->
<H1>Street Info</H1>

</div>
</div>
<div id="books"></div>
<div id="spacer"></div>

<table>
<TR valign="top">
<td bgcolor="#263145">

<div id="sidebar">
<ul>
<li><h2></h2>
<ul>
<li><a href="streetlist.php">Street List</a></li>
<li><a href="streetselect.php">Street Detail</a></li>
<li><a href="streetmaps.php">Maps</a></li>
<li><a href="info.php">Info</a></li>
</ul>
</li>
</ul>
</div>
</td>

<td width="30">&nbsp;</td>
<TD><H2>Summary: All Streets</H2>
<br /><br />
<?
$form_block= "<Table><TR valign=\"top\"><td>
<a name=\"sortform\" id=\"sortform\">Sort by:</a><TD width=\"20\">&nbsp;
<td><form method='post' action=\"$PHP_SELF\">
<INPUT TYPE=\"hidden\" name=\"op\" value=\"ds\">
		 <select name=\"sorttype\">
            <option value=\"lc\">Street Name
			<option value=\"w\">Street Works
			<option value=\"d\">Dog Fouling
			<option value=\"wash\">Street Washing
			<option value=\"graf\">Graffiti
			<option value=\"was\">Waste
            <option value=\"totaln\">Total Noise
            <option value=\"dayn\">Day Noise
            <option value=\"nightn\">Night Noise
		    <input type=\"submit\" value=\"Submit\"> 
</form>
</tr></table>
";
echo "$form_block";
?>

<?
require ("database.php3");
$op=$_POST["op"];
if ($op!="ds")

{$result=mysql_query("   SELECT * FROM wdata ORDER by lc");}

else {
$sorttype=$_POST["sorttype"];

if ($sorttype=="") 
{
$result=mysql_query("   SELECT * FROM wdata ORDER by number");
}
else {
    
 if ($sorttype=="lc")   
 {$result=mysql_query("   SELECT * FROM wdata ORDER by lc");}   
 
 else  {
$result=mysql_query("   SELECT * FROM wdata
			         ORDER BY $sorttype DESC");}
}}

if ($sorttype=="") {$sortname="Street";}
if ($sorttype=="lc") {$sortname="Street";}
if ($sorttype=="w") {$sortname="Street Works";}
if ($sorttype=="d") {$sortname="Dog Fouling";}
if ($sorttype=="was") {$sortname="Waste";}
if ($sorttype=="wash") {$sortname="Street Washing";}
if ($sorttype=="graf") {$sortname="Graffiti";}
if ($sorttype=="totaln") {$sortname="Total Noise";}
if ($sorttype=="dayn") {$sortname="Day Noise";}
if ($sorttype=="nightn") {$sortname="Night Noise";}

echo "<p>Sorted by:&nbsp;&nbsp;$sortname"; 
?>

<TABLE border="2" bgcolor="#C2C2C2" CELLSPACING="0" CELLPADDING="4" rules="all" WIDTH="90%">
<TR bgcolor="#999999">
	<TD ALIGN=CENTER width=150><b>Street</B></TD> 
	<TD ALIGN=CENTER width=80><B>Street Words</B></TD> 
	<TD ALIGN=CENTER width=80><B>Dog Fouling</B></TD>
	<TD ALIGN=CENTER width=80><B>Street Washing</B></TD>
	<TD ALIGN=CENTER width=80><B>Graffiti</B></TD>
	<TD ALIGN=CENTER width=80><B>Waste</B></TD>
    <TD ALIGN=CENTER width=80><B>Total Noise</B></TD>
    <TD ALIGN=CENTER width=80><B>Day Noise</B></TD>
    <TD ALIGN=CENTER width=80><B>Night Noise</B></TD>
<? 
	while ($row=mysql_fetch_array($result))
	{
		
		$lc=$row['lc'];
		$w=$row['w'];
                $d=$row['d'];
		$wash=$row['wash'];
		$graf=$row['graf'];
		$was=$row['was'];
		$totaln=$row['totaln'];
        $dayn=$row['dayn'];
        $nightn=$row['nightn'];

echo "
		<TR>
		<TD ALIGN=CENTER>$lc</TD> 
		<TD ALIGN=CENTER>$w</TD>
		<TD ALIGN=CENTER>$d</TD>
		<TD ALIGN=CENTER>$wash</TD>
		<TD ALIGN=CENTER>$graf</TD>
		<TD ALIGN=CENTER>$was</TD>
        <TD ALIGN=CENTER>$totaln</TD>
        <TD ALIGN=CENTER>$dayn</TD>
        <TD ALIGN=CENTER>$nightn</TD>
        
        
</TR>
";
}
?>
</TD>
	</TR>
	</TABLE></CENTER>
	
 
<BR><BR>

</TD></TR></TABLE>
</div>
</BODY> </HTML>
