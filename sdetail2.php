<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Street info - detail</TITLE>
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
<TD>
<p>
<?

require ("database.php3");
$lc=$_POST["lc"];
$op=$_POST["op"];
?>
<TD>

<?
/*require_once("identifys.php");*/

$result=mysql_query("   SELECT * FROM wdata where lc='$lc'");


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
}		    

?>

<!-- Display most of the data-->
<h2><? echo $lc; ?></h2>
<br />


<TABLE border=2 bgcolor="#C2C2C2" width="450" rules="none">
<TR>
<TH width=20 height="35">&nbsp;
<TH align="left" width=200 height="35">Issue
<TH width=100 align="left">Number
<TH width=100 align="left">Rank
<TH width=20 height="35">&nbsp;
<TR>
<TD height="35">&nbsp;
<TD height="35">Street Works:</TD>
<TD><? echo $w; ?></TD>
<TD><? echo $wrank; ?></TD>
<TD height="35">&nbsp;
</TR>
<TR>
<TD height="35">&nbsp;
<TD height="35">Dog Fouling:</TD>
<TD><? echo $d; ?></TD>
<TD><? echo $drank;?></TD>
<TD height="35">&nbsp;
</TR>
<TR>
<TD height="35">&nbsp;
<TD height="35">Street Washing:</TD>
<TD><? echo $wash; ?>
<TD><? echo $washrank; ?></TD>
<TD height="35">&nbsp;
</TR>

<TR>
<TD height="35">&nbsp;
<TD height="35">Graffiti:</TD>
<TD><? echo $graf; ?>
<TD><? echo $grafrank; ?>
<TD height="35">&nbsp;
</TD>
</TR>

<TR>
<TD height="35">&nbsp;
<TD>Waste:</TD>
<TD><? echo $was; ?>
<TD><? echo $wasrank; ?>
<TD height="35">&nbsp;
</TD>
</TR>

<TR>
<TD height="35">&nbsp;
<TD height="35">Total Noise:</TD>
<TD><? echo $totaln; ?>
<TD><? echo $totalnrank; ?>
<TD height="35">&nbsp;
</TD>
</TR>

<TR>
<TD height="35">&nbsp;
<TD height="35">Day Noise:</TD>
<TD><? echo $dayn; ?>
<TD><? echo $daynrank; ?>
<TD height="35">&nbsp;
</TD>
</TR>

<TR>
<TD height="35">&nbsp;
<TD height="35">Night Noise:</TD>
<TD><? echo $nightn; ?>
<TD><? echo $nightnrank; ?>
<TD height="35">&nbsp;
</TD>
</TR>
</TD></TR></TABLE>
<br />
</div>
</BODY> </HTML>
