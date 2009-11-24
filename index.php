<?php include('header.php') ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
 <tr bgcolor="#000000"> 
  <td width="100%"> 
   <table border="0" width="100%">
    <tr bgcolor="#333333"> 
     <td valign="bottom" colspan="2" > 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr valign="middle"> 
        <td align="left" bgcolor="#333333">
         <a href="index.html">home</a> |
         <a href="index.html">about me</a> |
         <a href="index.html">resume</a> |
         <a href="index.html">lyrics</a> |
         <a href="index.html">webcam</a> |
         <a href="index.html">people</a> |
         <a href="index.html">irc</a> |
         <a href="index.html">email</a> |
         <a href="index.html">tribute</a> |
         <a href="index.html">site admin</a>
        </td>
        <td align="right" bgcolor="#333333"> 
         <a href="index.html" class="title"><u>cha0tic realm</u></a>
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td rowspan="3" valign="top" width="100"> 
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#444444"> 
     <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr bgcolor="#000000">
        <td>
         <table width="100%" border="0" cellspacing="2" cellpadding="0" >
          <tr bgcolor="#333333">
           <td bgcolor="#333333" class="sideboxes">Projects</td>
          </tr>
          <tr bgcolor="#444444">
           <td class="sideboxes">
            <a href="index.html">art</a><br>
            <a href="index.html">designs</a><br>
            <a href="index.html">music</a><br>
            <a href="index.html">scripts</a><br>
            <a href="index.html">devlog</a><br>
           </td>
          </tr>
          <tr bgcolor="#333333">
           <td class="sideboxes">Projects</td>
          </tr>
         </table>
        </td>
       </tr>
       <tr bgcolor="#444444"> 
        <td>&nbsp;</td>
       </tr>
       <tr bgcolor="#000000"> 
        <td> 
         <table width="100%" border="0" cellspacing="2" cellpadding="0" >
          <tr bgcolor="#333333">
           <td class="sideboxes">Friends</td>
          </tr>
          <tr bgcolor="#444444">
           <td class="sideboxes">
            <a href="http://bkenoah.artramp.org">bkenoah</a><br>
            <a href="http://www.tomk32.de/index2.php">TomK32</a><br>
            <a href="http://bclark.yi.org">Bryan_Clark</a><br>
            <a href="http://www.jesse.f2s.com">Optical-i</a><br>
            <a href="http://www.whytravn.com/~appleworks/druid/">Wren</a><br>
            <a href="http://matthew.sphosting.com">retro</a><br>
           </td>
          </tr>
          <tr bgcolor="#333333">
           <td class="sideboxes">Friends</td>
          </tr>
         </table>
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
  <td rowspan="3" valign="top" width="8">&nbsp;</td>
  <td rowspan="3" valign="top"> 
   <table border="0" cellspacing="0" cellpadding="2" width="100%">
    <tr bgcolor="#000000"> 
     <td> 
      <table border="0" cellspacing="0" cellpadding="2" class="444444" width="100%">
       <tr bgcolor="#333333"> 
        <td class="main">
       <?php
		switch ($_GET['section']) {
		case "registration": 
		require ("register.php");
		break;
		case "profile": 
		require ("profile.php");
		break;
		case "teams": 
		require ("teams.php");
		break;
		default:
		require ("main.php");
		}
	   ?>   
        </td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
   <br>
   <br>
   <br>
  </td>
  <td rowspan="3" valign="top" width="8">&nbsp;</td>
  <td rowspan="3" bgcolor="#444444" width="20%" valign="top">
   <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    <tr bgcolor="#000000"> 
     <td> 
      <table width="100%" border="0" cellspacing="2" cellpadding="0" >
       <tr bgcolor="#333333">
        <td class="sideboxes">Вход</td>
       </tr>
       <tr bgcolor="#444444">
        <td class="sideboxes">
                  <p>
				<?php
				include("login.php");
				?>
				</p>
                </td>
       </tr>
       <tr bgcolor="#333333">
        <td class="sideboxes">Links</td>
       </tr>
      </table>
     </td>
    </tr>
    <tr bgcolor="#444444"> 
     <td>&nbsp;</td>
    </tr>
    <tr bgcolor="#000000">
     <td> 
      <table width="100%" border="0" cellspacing="2" cellpadding="0" >
       <tr bgcolor="#333333">
        <td class="sideboxes">Buttons</td>
       </tr>
       <tr bgcolor="#333333">
        <td class="sideboxes">
         <table width="88" height="31" border="0" cellpadding="0" cellspacing="0">
          <tr>
                      <td class="main" bgcolor="#777777" align="center"> ввв</td>
          </tr>
         </table>
        </td>
       </tr>
       <tr bgcolor="#333333">
        <td class="sideboxes">Buttons</td>
       </tr>
      </table>
     </td>
    </tr>
   </table>
  </td>
 </tr>
</table>

<? include 'footer.php'; ?>