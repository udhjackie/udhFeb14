<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Street Info - Select street</TITLE>
<meta http-equiv="content-type" content="text/html charset=iso-8859-1">
<LINK REL=stylesheet TYPE="text/css" HREF="udh.css">
</HEAD>

<BODY>
<div id="wrapper">
<div id="header">
<div id="logo">
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
<TD><H2>Select Street</H2>
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
$result=mysql_query("   SELECT * FROM wdata
			         ORDER BY $sorttype DESC");
}}
?>

<form method="post" action="sdetail2.php">
<table>
<tr>
<td align=left  height="100" width=200>
<input type="submit" value="Select Street">
</TD></TR></TABLE>


<TABLE border="2" bgcolor="#C2C2C2" CELLSPACING="0" CELLPADDING="4" rules="all" WIDTH="90%">


<TR bgcolor="#999999">
    <TD align=CENTER width=50><b>Select</B></TD>
	<TD ALIGN=CENTER width=150><b>Street</B></TD> 
	<TD ALIGN=CENTER width=80><B>Street Works</B></TD> 
	<TD ALIGN=CENTER width=80><B>Dog fouling</B></TD>
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
        <TD ALIGN=CENTER><INPUT TYPE=radio VALUE=$lc NAME=lc></TD>
        <TD ALIGN=CENTER>$lc</TD>
		<TD ALIGN=CENTER>$w</TD>
		<TD ALIGN=CENTER>$d</TD>
		<TD ALIGN=CENTER>$wash</TD>
		<TD ALIGN=CENTER>$graf</TD>
		<TD ALIGN=CENTER>$was</TD>
        <TD ALIGN=CENTER>$totaln</TD>
        <TD ALIGN=CENTER>$dayn</TD>
        <TD ALIGN=CENTER>$nightn</TD>     
 </tr>";

}
?>
</table>
<table><tr><td align=center  height="100" width=200>
<input type="submit" value="Select Street">
</TD></TR></TABLE>
</form>

</TD></TR></TABLE></CENTER>
</TD></TR></TABLE>
</div>
</BODY> </HTML>
