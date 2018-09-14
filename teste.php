<?php

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require ( "../includes/config.php" );
require ( "../includes/CGI.php" );
require ( "../includes/SQL.php" );

$cgi = new CGI ();
$sql = new SQL ( $DBusername, $DBpassword, $server, $database );

if ( ! $sql->isConnected () )
{
  die ( $DatabaseError );
}

require ( "includes/Auth.php" );
$auth = new Auth ( $cgi, $sql, $admin_table );
$auth->checkAuth ( "index.php" );

   require ( "../includes/CSQL.php" ); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "https://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="https://www.w3.org/1999/xhtml"> 
<HEAD> 
<TITLE>Editar Im&oacute;veis</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<LINK HREF="style.css" REL="stylesheet" TYPE="text/css"> 
</HEAD>
<script language="javascript" type="text/javascript"><!--
function popupWindow(url, width, height) {
	if(width == null){	width =100; }	
	if(height == null){height =100;}
		
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='+width+',height='+height+',screenX=150,screenY=150,top=150,left=100')
}
//--></script>
<Body>
<TABLE ALIGN="center" BORDER="0" CELLPADDING="1" CELLSPACING="0" WIDTH="100%"> 
<TBODY> 
<TR> 
<TD BGCOLOR="#333333"> <?PHP include "header.php"; ?>
<TABLE BGCOLOR="#ffffff" BORDER="0" CELLPADDING="0" CELLSPACING="0" WIDTH="100%"> 
<TBODY> 
<TR> 
<TD COLSPAN="4"> 
<TABLE WIDTH="100%" border="0" CELLPADDING="0" CELLSPACING="0"> 
<TR> 
<TD ALIGN="LEFT" VALIGN="TOP" class="leftbg"><?PHP include "leftmenu.php"; ?></TD> 
<TD VALIGN="TOP" WIDTH="100%"> 
<H2 ALIGN="LEFT"><IMG SRC="images/spacer.gif" HEIGHT="10" WIDTH="15">Editar Im&oacute;vel </H2>
<BR>
<?php 

  if ( $cgi->getValue ( "op" ) == "editestablishment" )
  {
    $rows = $sql->execute ( "SELECT * from " . $property_table .
      " WHERE id=" . $sql->quote ( $cgi->getValue ( "id" ) ) . " LIMIT 1",
      SQL_RETURN_ASSOC );

    $row = $rows [ 0 ];
?><TABLE WIDTH="95%" CELLPADDING="0" CELLSPACING="1" ALIGN="CENTER"> 
<TR> 
<TD> 
 <strong>Voc&ecirc; selecionou para editar a seguinte im&oacute;vel </strong> <br>
Digite  novos detalhes para esta propriedade nos campos abaixo. Para completar o processo, clique no bot&atilde;o "Atualizar Im&oacute;vel".</TD> 
</TR> 
</TABLE>

<form method="post">
<input name="id" type="hidden" value="<?php echo $row [ "id" ]; ?>">
<input name="op" type="hidden" value="UpdateProperty">
<br>
<TABLE WIDTH="95%" border="0" ALIGN="CENTER" CELLPADDING="5" CELLSPACING="1" CLASS="forumline">
<tr>
  <td height="23" colspan="2" ALIGN="LEFT" VALIGN="middle" background="images/top-menubg.gif" class="leftbg"> <b>Informa&ccedil;&otilde;es do Im&oacute;vel </b></td>  
</tr>
<tr>
<td width="176" valign="top" bgcolor="#F3F3F3"><b>Detalhes do Propriet&aacute;rio</b><br>
  <i>(Esta informa&ccedil;&atilde;o n&atilde;o &eacute; exibida no site. &Eacute; para sua refer&ecirc;ncia, se voc&ecirc; est&aacute; vendendo o im&oacute;vel para outra pessoa. Deixe em branco se n&atilde;o for necess&aacute;rio)</i></td>
<td width="700" bgcolor="#FFFFFF"><textarea name="propertyowner" rows="6" cols="35"><?php echo $row [ "propertyowner" ]; ?></textarea></td>
</tr><tr><td height="23" colspan="2" ALIGN="LEFT" VALIGN="middle" background="images/top-menubg.gif" class="leftbg"> <b>Op&ccedil;&atilde;o do Im&oacute;vel - Venda ou Aluguel</b></td>  
</tr>
<tr>
<td bgcolor="#F3F3F3"><strong>Venda ou Aluguel:</strong></td>
<td bgcolor="#FFFFFF"><select name="propertyoption">
<option value="S"<?php if ( $row [ "propertyoption" ] == "S" ) { echo " selected"; } ?>>Venda</option>
<option value="R"<?php if ( $row [ "propertyoption" ] == "R" ) { echo " selected"; } ?>>Aluguel</option>
</select> <i class="row1">(Selecione se o im&oacute;vel est&aacute; para alugar ou vender)</i></td>
</tr>
<tr>
  <td height="23" colspan="2" ALIGN="LEFT" VALIGN="middle" background="images/top-menubg.gif" class="leftbg"> <b>Informa&ccedil;&otilde;es do Im&oacute;vel</b></td>  
</tr>
  <TD width="176" BGCOLOR="#F3F3F3">
<b>Data  Adicionada:</b></TD>
    <TD BGCOLOR="#FFFFFF">
 <?php echo $row [ "dateadded" ]; ?></TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b> Exibir Im&oacute;vel na Lista:</b></TD>
<TD BGCOLOR="#FFFFFF">

<SELECT NAME="featuredproperty">
<OPTION VALUE="Y" <?php if ( $row [ 'featuredproperty' ] == "Y" ) { ?> selected<?php } ?>>Sim</OPTION>
<OPTION VALUE="N" <?php  if ( $row [ 'featuredproperty' ] == "N" ) { ?> selected<?php } ?>>Não</OPTION>
</SELECT>
<i>(</i><i class="row1">Listagem dispon&iacute;vel na listagem de busca</i><i>)</i></TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3"><strong> <b>C&oacute;digo</b> do Im&oacute;vel:</strong></TD>
<TD BGCOLOR="#FFFFFF">
 <strong><?php echo $row [ "propertyref" ]; ?></strong></TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b> Tipo do Im&oacute;vel:</b></TD>
<TD BGCOLOR="#FFFFFF">

<SELECT NAME="propertytype" SIZE="1">
<?php 
  
    $rows = $sql->execute ( "SELECT * FROM " . $propertytypes_table .
      " ORDER BY propertytype ASC", SQL_RETURN_ASSOC );

    for ( $i = 0; $i < sizeof ( $rows ); ++$i )
    {
      $qry = $rows [ $i ];
      
      ?>
<OPTION VALUE="<?php
      echo $cgi->htmlEncode ( $qry [ "id" ] ); ?>"<?php
      
      if ( $row [ 'propertytype' ] == $qry [ "id" ] )
      {
        ?> selected<?php
      }
      
      ?>><?php echo $cgi->htmlEncode ( $qry [ "propertytype" ] );
      
      ?></OPTION>
<?php
    }
  
?>
</SELECT>
</TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b>Valor do Im&oacute;vel:</b></TD>
<TD BGCOLOR="#FFFFFF">
 <?php echo $CurrencyUnit; ?>
<INPUT TYPE="TEXT" NAME="propertyprice" SIZE="10" MAXLENGTH="20" VALUE="<?php
  echo $row [ "propertyprice" ]; ?>">
<i>(</i><i class="row1">Digite apenas n&uacute;meros. Ex. 45 / 450 / 4500 / 45000 / 4500000 / 4500000000</i><i>)</i></TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b>N&uacute;mero de Quartos:</b></TD>
<TD BGCOLOR="#FFFFFF">

<SELECT NAME="propertybedrooms">
<OPTION VALUE="0" <?php if ( $row [ "propertybedrooms" ] == "1" ) { echo " selected"; } ?>>0</OPTION>
<OPTION VALUE="1" <?php if ( $row [ "propertybedrooms" ] == "1" ) { echo " selected"; } ?>>1</OPTION>
<OPTION VALUE="2" <?php if ( $row [ "propertybedrooms" ] == "2" ) { echo " selected"; } ?>>2</OPTION>
<OPTION VALUE="3" <?php if ( $row [ "propertybedrooms" ] == "3" ) { echo " selected"; } ?>>3</OPTION>
<OPTION VALUE="4" <?php if ( $row [ "propertybedrooms" ] == "4" ) { echo " selected"; } ?>>4</OPTION>
<OPTION VALUE="5" <?php if ( $row [ "propertybedrooms" ] == "5" ) { echo " selected"; } ?>>5</OPTION>
<OPTION VALUE="6" <?php if ( $row [ "propertybedrooms" ] == "6" ) { echo " selected"; } ?>>6</OPTION>
<OPTION VALUE="7" <?php if ( $row [ "propertybedrooms" ] == "7" ) { echo " selected"; } ?>>7</OPTION>
<OPTION VALUE="8" <?php if ( $row [ "propertybedrooms" ] == "8" ) { echo " selected"; } ?>>8</OPTION>
<OPTION VALUE="9" <?php if ( $row [ "propertybedrooms" ] == "9" ) { echo " selected"; } ?>>8</OPTION>
<OPTION VALUE="10" <?php if ( $row [ "propertybedrooms" ] == "10" ) { echo " selected"; } ?>>10 +</OPTION>
</SELECT>
</TD>
</TR><tr>
<td bgcolor="#F3F3F3"><b>N&uacute;mero de Banheiros:</b></td>
<td bgcolor="#FFFFFF">
<select name="propertybathrooms">
<option value="0" <?php if ( $row [ "propertybathrooms" ] == "1" ) { echo " selected"; } ?>>0</option>
<option value="1" <?php if ( $row [ "propertybathrooms" ] == "1" ) { echo " selected"; } ?>>1</option>
<option value="2" <?php if ( $row [ "propertybathrooms" ] == "2" ) { echo " selected"; } ?>>2</option>
<option value="3" <?php if ( $row [ "propertybathrooms" ] == "3" ) { echo " selected"; } ?>>3</option>
<option value="4" <?php if ( $row [ "propertybathrooms" ] == "4" ) { echo " selected"; } ?>>4</option>
<option value="5" <?php if ( $row [ "propertybathrooms" ] == "5" ) { echo " selected"; } ?>>5</option>
</select>
</td>
</tr>
<tr>
<td bgcolor="#F3F3F3"><b>Ano de Constru&ccedil;&atilde;o:</b></td>
<td bgcolor="#FFFFFF"><input type="TEXT" name="propertyyearbuilt" size="25" maxlength="100" VALUE="<?php echo $cgi->htmlEncode ( $row [ "propertyyearbuilt" ] ); ?>"></td>
</tr>
<tr>
<td bgcolor="#F3F3F3"><b>Tamanho do Im&oacute;vel:</b></td>
<td bgcolor="#FFFFFF"><input type="TEXT" name="propertylivingarea" size="50" maxlength="100" VALUE="<?php echo $cgi->htmlEncode ( $row [ "propertylivingarea" ] ); ?>"></td>
</tr>
<tr>
<td bgcolor="#F3F3F3"><b>Tamanho de &Aacute;rea Total:</b></td>
<td bgcolor="#FFFFFF"><input type="TEXT" name="propertyplotsize" size="50" maxlength="100" VALUE="<?php echo $cgi->htmlEncode ( $row [ "propertyplotsize" ] ); ?>"></td>
</tr>
<tr>
<td bgcolor="#F3F3F3"><b>Recursos:</b></td>
<td bgcolor="#FFFFFF">
<?php

  $_propertyFeatures = $sql->execute (
      "SELECT feature_id FROM " . $propertyfeatures_table .
        " WHERE property_id=" . $sql->quote ( $cgi->getValue ( "id" ) ),
      SQL_RETURN_ASSOC );

  // remap $propertyFeatures into an associated array, for easier lookup
  $propertyFeatures = array ();
  for ( $i = 0; $i < sizeof ( $_propertyFeatures ); ++$i )
  {
    $propertyFeatures [ $_propertyFeatures [ $i ] [ "feature_id" ] ] = 1;
  }

  $features = $sql->execute ( "SELECT id, description from " . $features_table,
      SQL_RETURN_ASSOC );

  for ( $i = 0; $i < sizeof ( $features ); ++$i )
  {
?>
<input type="checkbox" name="_feature_<?php echo $i; ?>"<?php
    if ( $propertyFeatures [ $features [ $i ] [ "id" ] ] == 1 )
    {
?> checked="checked"<?php
    }
?> value="<?php echo $features [ $i ] [ "id" ]; ?>"/><?php
    echo $cgi->htmlEncode ( $features [ $i ] [ "description" ] );
?><br><?php
  }
?>
</td>
</tr>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b>Endere&ccedil;o do Im&oacute;vel:</b></TD>
<TD BGCOLOR="#FFFFFF">

<INPUT TYPE="TEXT" NAME="propertyaddress" SIZE="50" MAXLENGTH="100" VALUE="<?php echo $cgi->htmlEncode ( $row [ "propertyaddress" ] ); ?>">
</TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b>Localiza&ccedil;&atilde;o do Im&oacute;vel:</b></TD>
<TD BGCOLOR="#FFFFFF">

<SELECT NAME="propertylocation">
<?PHP 

    $rows = $sql->execute ( "SELECT * FROM " .
      $propertylocations_table . " ORDER BY propertylocation ASC",
      SQL_RETURN_ASSOC );

    for ( $i = 0; $i < sizeof ( $rows ); ++$i )
    {
      $qry = $rows [ $i ];

      ?>
<OPTION VALUE="<?php
      
      echo $cgi->htmlEncode ( $qry [ "id" ] );
    
      ?>"<?php
      
      if ( $row [ 'propertylocation' ] == $qry [ "id" ] )
      {
        ?> selected<?php
      }
    
      ?>>
<?php
      
      echo $cgi->htmlEncode ( $qry [ "propertylocation" ] );
    
      ?>
</OPTION>
<?php
    }

?>
</SELECT>
</TD>
</TR>
<tr>
<td width="176" bgcolor="#F3F3F3">
<b>Cep:</b></td>
<td bgcolor="#FFFFFF">
<input type="TEXT" name="propertypostcode" size="15" maxlength="20" VALUE="<?php echo $cgi->htmlEncode ( $row [ "propertypostcode" ] ); ?>"> 
<i>(</i><i class="row1">Digite o Cep como neste exemplo: 00000-000</i><i>)</i></td>
</tr>

<TR>
<TD width="176" VALIGN="TOP" BGCOLOR="#F3F3F3">
<b>Breve descri&ccedil;&atilde;o do Im&oacute;vel:</b><BR>
<I>(</I><i class="row1">M&aacute;ximo de 255 Caracteres</i><I>)</I></TD>
<TD BGCOLOR="#FFFFFF">

<TEXTAREA NAME="shortdescription" ROWS="6" COLS="45"><?php
  echo $cgi->htmlEncode ( $row [ "shortdescription" ] ); ?>
</TEXTAREA>
</TD>
</TR>
<TR>
<TD width="176" VALIGN="TOP" BGCOLOR="#F3F3F3">
<b>Descri&ccedil;&atilde;o do Im&oacute;vel:</b><BR>
<I>(</I><i class="row1">&Eacute; Permitido usar HTML</i><I>)</I></TD>
<TD BGCOLOR="#FFFFFF">

<TEXTAREA NAME="longdescription" ROWS="15" COLS="45"><?php
  echo $cgi->htmlEncode ( $row [ "longdescription" ] ); ?>
</TEXTAREA>
</TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b>Status:</b></TD>
<TD BGCOLOR="#FFFFFF">

<SELECT NAME="propertystatus">
<?PHP 

    $rows = $sql->execute ( "SELECT * FROM " .
      $propertystatus_table . " ORDER BY propertystatus ASC",
      SQL_RETURN_ASSOC );

    for ( $i = 0; $i < sizeof ( $rows ); ++$i )
    {
      $qry = $rows [ $i ];

      ?>
<OPTION VALUE="<?php
      
      echo $cgi->htmlEncode ( $qry [ "id" ] );
    
      ?>"<?php
      
      if ( $row [ 'propertystatus' ] == $qry [ "id" ] )
      {
        ?> selected<?php
      }
    
      ?>>
<?php
      
      echo $cgi->htmlEncode ( $qry [ "propertystatus" ] );
    
      ?>
</OPTION>
<?php
    }

?>
</SELECT>
<i>(</i><i  class="row1">Selecionar tipo de Im&oacute;vel</i><i>)</i></TD>
</TR>
<TR>
<TD width="176" BGCOLOR="#F3F3F3">
<b>Exibir o Im&oacute;vel na Home:</b></TD>
<TD BGCOLOR="#FFFFFF">

<SELECT NAME="propertyshow">
<OPTION VALUE="1" <?php
  if ( $row [ 'propertyshow' ] == "1" ) { ?> selected<?php } ?>>Sim</OPTION>
<OPTION VALUE="0" <?php
  if ( $row [ 'propertyshow' ] == "0" ) { ?> selected<?php } ?>>Não</OPTION>
</SELECT>
<i>(</i><i class="row1">Listagem dispon&iacute;vel na P&aacute;gina Principal</i><i>)</i></TD>
</TR>
</table>
<p align="center">
<input value="Atualizar An&uacute;ncio" type="submit" class="submit" ONCLICK="return confirm('Deseja atualizar este anúncio?');">

</form><br><?php if($row ["propertyphoto1"]) {?>
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
  <td height="23" colspan="2" ALIGN="LEFT" VALIGN="middle" background="images/top-menubg.gif" class="leftbg"> <strong>Editar e/ou Deletar Imagens dos Im&oacute;veis.</strong></td>  
</tr>
</table>

 <?php } ?>
<br>

<TABLE WIDTH="90%" border="0" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0"> 

<TR>
<TD BGCOLOR="#FFFFFF">

<table width="100%"  border="1" cellspacing="0" cellpadding="0" align="center">
<tr>
<td align="center"><?php if($row ["propertyphoto1"]) {?>Imagem 1<br><img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto1" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1"> 
<TR> 
<TD ALIGN="CENTER"> 
<form action="property_edit_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto1" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif"></FORM></TD> 
<TD ALIGN="CENTER"> 
<form action="property_delete_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto1" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto1" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');"></FORM></TD> 
</TR> 
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=1&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 1</a></TD>
</TR></table>
<?php
}
?>
</td>
<td align="center"><?php if($row ["propertyphoto2"]) {?>Imagem 2<br><img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto2" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1"> 
<TR> 
<TD ALIGN="CENTER"> 
<form action="property_edit_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto2" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif"></FORM></TD> 
<TD ALIGN="CENTER"> 
<form action="property_delete_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto2" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto2" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');"></FORM></TD> 
</TR> 
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=2&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 2</a></TD></TR></table>
<?
}
?>
</td>
</tr>
<tr>
<td align="center"><?php if($row ["propertyphoto3"]) {?>Imagem 3<br><img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto3" ] ); ?>" width="125" height="100"><TABLE CELLPADDING="1" CELLSPACING="1"> 
<TR> 
<TD ALIGN="CENTER"> 
<form action="property_edit_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto3" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif"></FORM></TD> 
<TD ALIGN="CENTER"> 
<form action="property_delete_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto3" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto3" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');"></FORM></TD> 
</TR> 
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=3&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 3</a></TD></TR></table>
<?
}
?>
</td>

<td align="center"><?php if($row ["propertyphoto4"]) {?>Imagem 4<br><img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto4" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1"> 
<TR> 
<TD ALIGN="CENTER"> 
<form action="property_edit_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto4" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif"></FORM></TD> 
<TD ALIGN="CENTER"> 
<form action="property_delete_image.php" method="post">
<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto4" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto4" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');"></FORM></TD> 
</TR> 
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=4&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 4</a></TD></TR></table>
<?
}
?>
</td>
</tr>
<tr>
<td align="center"><?php if($row ["propertyphoto5"]) {?>
Imagem 5 <br>
<img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto5" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1">
<TR>
<TD ALIGN="CENTER"><form action="property_edit_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto5" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif">

</FORM></TD>
<TD ALIGN="CENTER"><form action="property_delete_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto5" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto5" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');">

</FORM></TD>
</TR>
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=5&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 5 </a></TD>
</TR>
</table>
<?
}
?></td>
<td align="center"><?php if($row ["propertyphoto6"]) {?>
Imagem 6 <br>
<img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto6" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1">
<TR>
<TD ALIGN="CENTER"><form action="property_edit_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto6" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif">

</FORM></TD>
<TD ALIGN="CENTER"><form action="property_delete_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto1" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto6" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');">

</FORM></TD>
</TR>
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=6&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 6 </a></TD>
</TR>
</table>
<?
}
?></td>
</tr>
<tr>
<td align="center"><?php if($row ["propertyphoto7"]) {?>
Imagem 7 <br>
<img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto7" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1">
<TR>
<TD ALIGN="CENTER"><form action="property_edit_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto7" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif">

</FORM></TD>
<TD ALIGN="CENTER"><form action="property_delete_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto7" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto7" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');">

</FORM></TD>
</TR>
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=7&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 7 </a></TD>
</TR>
</table>
<?
}
?></td>
<td align="center"><?php if($row ["propertyphoto8"]) {?>
Imagem 8 <br>
<img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto8" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1">
<TR>
<TD ALIGN="CENTER"><form action="property_edit_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto8" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif">

</FORM></TD>
<TD ALIGN="CENTER"><form action="property_delete_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto8" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto8" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');">

</FORM></TD>
</TR>
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=8&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,300);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 8 </a></TD>
</TR>
</table>
<?
}
?></td>
</tr>
<tr>
<td align="center"><?php if($row ["propertyphoto9"]) {?>
Imagem 9 <br>
<img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto9" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1">
<TR>
<TD ALIGN="CENTER"><form action="property_edit_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto9" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif">

</FORM></TD>
<TD ALIGN="CENTER"><form action="property_delete_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto9" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto9" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');">

</FORM></TD>
</TR>
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=9&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 9 </a></TD>
</TR>
</table>
<?php
}
?></td>
<td align="center"><?php if($row ["propertyphoto10"]) {?>
Imagem 10 <br>
<img src="<?php echo $ImageURL.$cgi->htmlEncode ( $row [ "propertyphoto10" ] ); ?>" width="125" height="100">
<TABLE CELLPADDING="1" CELLSPACING="1">
<TR>
<TD ALIGN="CENTER"><form action="property_edit_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto10" ]; ?>">
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-edit.gif">

</FORM></TD>
<TD ALIGN="CENTER"><form action="property_delete_image.php" method="post">

<input name="propertyref" type="hidden" value="<?php echo $row [ "propertyref" ]; ?>">
<input name="propertyphoto" type="hidden" value="<?php echo $row [ "propertyphoto10" ]; ?>">
<input type="hidden" name="imageno" value="propertyphoto10" />
<input type="hidden" name="propid" value="<?=$row[ "id" ];?>" />
<INPUT TYPE="IMAGE" NAME="Image1" SRC="images/button-delete.gif" ONCLICK="return confirm('Deletar imagem?');">

</FORM></TD>
</TR>
</TABLE>
<?php }else{ ?>
<table Cellpadding="1" cellspacing="1">
<TR>
<TD ALIGN="CENTER"><a href="Javascript:popupWindow('pop_add_img.php?img=10&id=<?=$row[ "id" ];?>&ref=<?php echo $row [ "propertyref" ]; ?>',300,200);"><img src="images/camicon.gif" border="0"><br>
Adicionar img 10 </a></TD>
</TR>
</table>
<?
}
?></td>
</tr>
</table>
</TD>
</TR>
</TABLE>
<br>

<br>
<?php
  }

#### Update the requested Establishment ####
  if ( $cgi->getValue ( "op" ) == "UpdateProperty" )
  {
mysql_query("UPDATE $property_table SET  
propertyoption = " . $sql->quote ( $cgi->getValue ( "propertyoption" ) ) . ", 
propertytype = " . $sql->quote ( $cgi->getValue ( "propertytype" ) ) . ", 
propertyprice = " . $sql->quote ( $cgi->getValue ( "propertyprice" ) ) . ", 
propertybedrooms = " . $sql->quote ( $cgi->getValue ( "propertybedrooms" ) ) . ",
propertybathrooms = " . $sql->quote ( $cgi->getValue ( "propertybathrooms" ) ) . ",
propertyyearbuilt = " . $sql->quote ( $cgi->getValue ( "propertyyearbuilt" ) ) . ",
propertylivingarea = " . $sql->quote ( $cgi->getValue ( "propertylivingarea" ) ) . ",
propertyplotsize = " . $sql->quote ( $cgi->getValue ( "propertyplotsize" ) ) . ",
propertyaddress = " . $sql->quote ( $cgi->getValue ( "propertyaddress" ) ) . ",
propertylocation = " . $sql->quote ( $cgi->getValue ( "propertylocation" ) ) . ", 
propertypostcode = " . $sql->quote ( $cgi->getValue ( "propertypostcode" ) ) . ",
shortdescription = " . $sql->quote ( $cgi->getValue ( "shortdescription" ) ) . ", 
longdescription = " . $sql->quote ( $cgi->getValue ( "longdescription" ) ) . ",
propertystatus = " . $sql->quote ( $cgi->getValue ( "propertystatus" ) ) . ", 
propertyshow = " . $sql->quote ( $cgi->getValue ( "propertyshow" ) ) . ",
featuredproperty = " . $sql->quote ( $cgi->getValue ( "featuredproperty" ) ) . ",
virtualtour = " . $sql->quote ( $cgi->getValue ( "virtualtour" ) ) . ",
propertyowner = " . $sql->quote ( $cgi->getValue ( "propertyowner" ) ) . "  
WHERE id = " . $sql->quote ( $cgi->getValue ( "id" ) ) . "") or die ("$DatabaseError");
    
    // we need to handle features, too
    // start by removing all currently assigned features
    $sql->execute ( "DELETE FROM " . $propertyfeatures_table .
        " WHERE property_id=" . $sql->quote ( $cgi->getValue ( "id" ) ) );

    $params = $cgi->getValues ();

    while ( list ( $param, $value ) = each ( $params ) )
    {
      $matches = array ();

      if ( preg_match ( '/^_feature_(\d+)$/', $param, $matches ) )
      {
        // it matched, which means that it's a feature
        if ( $value > 0 )
        {
          $sql->execute ( "INSERT INTO " . $propertyfeatures_table .
              " (property_id, feature_id) VALUES (" .
              $sql->quote ( $cgi->getValue ( "id" ) ). ", " .
              $sql->quote ( $value ) . ")" );
        }
      }
    }

   ?>
<p align="center"><font color="#CC0000">Detalhes do Im&oacute;vel foram atualizados

com sucesso! </font>
<br>
<form method="post">
<input name="op" type="hidden" value="editestablishment">
<input name="id" type="hidden" value="<?php
  echo $cgi->htmlEncode ( $cgi->getValue ( "id" ) ); ?>">
<p align="center">
<input value="Ver novos detalhes" type="submit" class="textinput">

</form>
<?php
  
  }
  
?>
</TD>
</TR> 
</TABLE> </TD> 
</TR> 
</TBODY> 
</TABLE> </TD> 
</TR> 
</TBODY> 
</TABLE> <?PHP include "footer.php"; ?>
</BODY>
</HTML>
