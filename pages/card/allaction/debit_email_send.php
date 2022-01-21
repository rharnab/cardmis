<?php
    date_default_timezone_set('Asia/Dhaka');// set default time zone in bangladesh
    $to_mail = "rharnab@gmail.com";
    $subject = 'Debit Card Issue';
    // Set content-type for sending HTML email //
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    // Set send from mail headers
    $headers .= 'From: <sbac@bank.com>' . "\r\n";

    $time = date('h:i: A');
    $date = "<br>".date('d-F-Y');
    $date_time = $time.' '.$date;
            
    $msg_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>[SUBJECT]</title>
  <style type="text/css">
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
 }
 .tableContent img {
   border: 0 !important;
   display: block !important;
   outline: none !important;
 }
 a{
  color:#382F2E;
}

p, h1,h2,ul,ol,li,div{
  margin:0;
  padding:0;
}

h1,h2{
  font-weight: normal;
  background:transparent !important;
  border:none !important;
}

@media only screen and (max-width:480px)
		
{
		
table[class="MainContainer"], td[class="cell"] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class="specbundle"] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:15px !important;
	}	
td[class="specbundle2"] 
	{
		width:80% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:10px !important;
		padding-left:10% !important;
		padding-right:10% !important;
	}
		
td[class="spechide"] 
	{
		display:none !important;
	}
	    img[class="banner"] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class="left_pad"] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		 
}
	
@media only screen and (max-width:540px) 

{
		
table[class="MainContainer"], td[class="cell"] 
	{
		width: 100% !important;
		height:auto !important; 
	}
td[class="specbundle"] 
	{
		width: 100% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:15px !important;
	}	
td[class="specbundle2"] 
	{
		width:80% !important;
		float:left !important;
		font-size:13px !important;
		line-height:17px !important;
		display:block !important;
		padding-bottom:10px !important;
		padding-left:10% !important;
		padding-right:10% !important;
	}
		
td[class="spechide"] 
	{
		display:none !important;
	}
	    img[class="banner"] 
	{
	          width: 100% !important;
	          height: auto !important;
	}
		td[class="left_pad"] 
	{
			padding-left:15px !important;
			padding-right:15px !important;
	}
		
}

.contentEditable h2.big,.contentEditable h1.big{
  font-size: 26px !important;
}

 .contentEditable h2.bigger,.contentEditable h1.bigger{
  font-size: 37px !important;
}

td,table{
  vertical-align: top;
}
td.middle{
  vertical-align: middle;
}

a.link1{
  font-size:13px;
  color:#27A1E5;
  line-height: 24px;
  text-decoration:none;
}
a{
  text-decoration: none;
}

.link2{
color:#ffffff;
border-top:10px solid #27A1E5;
border-bottom:10px solid #27A1E5;
border-left:18px solid #27A1E5;
border-right:18px solid #27A1E5;
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
background:#27A1E5;
}

.link3{
color:#555555;
border:1px solid #cccccc;
padding:10px 18px;
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
background:#ffffff;
}

.link4{
color:#27A1E5;
line-height: 24px;
}

h2,h1{
line-height: 20px;
}
p{
  font-size: 14px;
  line-height: 21px;
  color:#AAAAAA;
}

.contentEditable li{
 
}

.appart p{
 
}
.bgItem{
background: #ffffff;
}
.bgBody{
background: #ffffff;
}

img { 
  outline:none; 
  text-decoration:none; 
  -ms-interpolation-mode: bicubic;
  width: auto;
  max-width: 100%; 
  clear: both; 
  display: block;
  float: none;
}

</style>


<script type="colorScheme" class="swatch active">
{
    "name":"Default",
    "bgBody":"ffffff",
    "link":"27A1E5",
    "color":"AAAAAA",
    "bgItem":"ffffff",
    "title":"444444"
}
</script>


</head>
<body paddingwidth="0" paddingheight="0" bgcolor="#d1d3d4"  style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ffffff" style="font-family:helvetica, sans-serif;" class="MainContainer">
      <!-- =============== START HEADER =============== -->
  <tbody>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top" width="20">&nbsp;</td>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td class="movableContentContainer">
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="15"></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top" width="60"><img src="images/Logo-01.png" alt="Logo" title="Logo" width="60" height="60" data-max-width="100"></td>
      <td width="10" valign="top">&nbsp;</td>
      <td valign="middle" style="vertical-align: middle;">
        <div class="contentEditableContainer contentTextEditable">
          <div class="contentEditable" style="text-align: left;font-weight: light; color:#555555;font-size:26;line-height: 39px;font-family: Helvetica Neue;">
            <p style="margin-top: 10px;font-size: 18px;color: black;">From : sbac@bank.com</p>
            <p style="color: black;">To : na.khan@gmail.com <na.khan@gmail.com></p>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</td>
      <td valign="top" width="90" class="spechide">&nbsp;</td>
      <td valign="middle" style="vertical-align: middle;" width="150">
        <div class="contentEditableContainer contentTextEditable">
          <div class="contentEditable" style="text-align: right;">
            <p class="link1">Time & Date :'; ?><?php $msg_body .= $date_time;?> <?php  $msg_body .='</p>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table></td>
    </tr>
    <tr>
       <td height="15"></td>
    </tr>
    <tr>
       <td ><hr style="height:1px;background:#DDDDDD;border:none;"></td>
     </tr>
  </tbody>
</table>
	  </div>
      <!-- =============== END HEADER =============== -->

<!-- =============== START BODY =============== -->
      
      
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="40"></td>
    </tr>
    <tr>
      <td style="border: 1px solid #EEEEEE; border-radius:6px;-moz-border-radius:6px;-webkit-border-radius:6px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top" width="40">&nbsp;</td>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr><td height="25"><h2 style="margin-left:-30px !important;margin-top:5px;font-size:20px;">Dear MD. NURUL ALAM KHAN,</h2></td></tr>
        <tr>
          <td>
            <div class="contentEditableContainer contentTextEditable">
              <div class="contentEditable" style="text-align: center;">
                <br>
                <p style="margin:-10px 0px 0px -230px !important">Greetings from The SBAC BANK LTD.!</p>
                <p style="margin:5px 0px 0px 0px !important;text-align:justify;">Thank you for choosing SBAC BANK Card & Digital Banking service. We have already issue your debit card as per your request.Here below debit card informations!</p>
              </div>
            </div>
          </td>
        </tr>
        <tr><td height="24"></td></tr>
      </table></td>
      <td valign="top" width="40">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
      </div>
      
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="40"></td>
    </tr>
    <tr>
      <td style="background:#f2f4f9; border-radius:6px;-moz-border-radius:6px;-webkit-border-radius:6px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="40" valign="top">&nbsp;</td>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr><td height="25"></td></tr>
                      <tr>
                        <td>
                          <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable">
                              <table style="font-size:15px; line-height:20px;" align="center">
                                <tr style="border:1px solid #c9cacc;">
                                    <td style="border: 1px solid #c9cacc; padding:10px;">Particulars</td>
                                    <td style="border: 1px solid #c9cacc;padding:10px;">Details</td>
                                </tr>
                                <tbody style="border: 1px solid #c9cacc;">
                                  <tr style="border: 1px solid #c9cacc;">
                                    <td width="35%" style="border: 1px solid #c9cacc;padding:0px 10px 0px 10px;">Client ID</td>
                                    <td style="border: 1px solid #c9cacc;padding-left:10px;">333444</td>
                                  </tr>
                                  <tr style="border: 1px solid #c9cacc;">
                                    <td style="border: 1px solid #c9cacc;padding:0px 10px 0px 10px;">Account Type</td>
                                    <td style="border: 1px solid #c9cacc;padding-left:10px;">Savings Account</td>
                                  </tr>
                                  <tr style="border: 1px solid #c9cacc;">
                                    <td style="border: 1px solid #c9cacc;padding:0px 10px 0px 10px;">Account Number</td>
                                    <td style="border: 1px solid #c9cacc;padding-left:10px;">444555666777</td>
                                  </tr>
                                  <tr style="border: 1px solid #c9cacc;">
                                    <td style="border: 1px solid #c9cacc;padding:0px 10px 0px 10px;">Account Name</td>
                                    <td style="border: 1px solid #c9cacc;padding-left:10px;">Mr Nurul Alam Khan</td>
                                  </tr>
                                  <tr style="border: 1px solid #c9cacc;">
                                    <td style="border: 1px solid #c9cacc;padding:0px 10px 0px 10px;">Name On Card</td>
                                    <td style="border: 1px solid #c9cacc;padding-left:10px;">Nurul Alam</td>
                                  </tr>
                                  <tr style="border: 1px solid #c9cacc;">
                                    <td style="border: 1px solid #c9cacc;padding:0px 10px 0px 10px;">Request Status</td>
                                    <td style="border: 1px solid #c9cacc;padding-left:10px;">Issue</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr><td height="24"></td></tr>
                    </table></td>
      <td width="40" valign="top">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>

      
      
      </div>
      
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    
    
    <tr><td height="40" colspan="3"></td></tr>
    	<td><span style="font-size:15px;">Stay Connected and enjoy <b>DIGITAL</b> Banking service.</span>
      <p style="color: black; margin-top:10px">123 (Local) or 33333 (Overseas)</p>
      <a style="text-decoration: underline;" href="" target="_blank">sbac@bank.com</a>
    </td>
            <tr><td colspan="3"><hr style="height:1px;background:#DDDDDD;border:none;"></td></tr>
  </tbody>
</table>
      </div>
      
      <!-- =============== END BODY =============== -->
<!-- =============== START FOOTER =============== -->

      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  
</table>
</td>
    </tr>
  </tbody>
</table>
      
      
      </div>
      <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td valign="top" width="185" class="spechide">&nbsp;</td>
      <td class="specbundle2"><table width="100%" cellpadding="0" cellspacing="0" align="center">
                      <tr>
                        <td width="40">
                          <div class="contentEditableContainer contentFacebookEditable">
                            <div class="contentEditable" style="text-align: center;color:#AAAAAA;">
                              <img src="images/facebook.png" alt="facebook" width="40" height="40" data-max-width="40" data-customIcon="true" border="0" >
                            </div>
                          </div>
                        </td>
                        <td width="10"></td>
                        <td width="40">
                          <div class="contentEditableContainer contentTwitterEditable">
                            <div class="contentEditable" style="text-align: center;color:#AAAAAA;">
                              <img src="images/twitter.png" alt="twitter" width="40" height="40" data-max-width="40" data-customIcon="true" border="0">
                            </div>
                          </div>
                        </td>
                        <td width="10"></td>
                        <td width="40">
                          <div class="contentEditableContainer contentImageEditable">
                            <div class="contentEditable" style="text-align:center;color:#AAAAAA;">
                              <img src="images/red.png" alt="Pinterest" width="40" height="40" data-max-width="40" border="0">
                            </div>
                          </div>
                        </td>
                        <td width="10"></td>
                        <td width="40">
                          <div class="contentEditableContainer contentImageEditable">
                            <div class="contentEditable" style="text-align: center;color:#AAAAAA;">
                              <img src="images/blue.png" alt="Social media" width="40" height="40" data-max-width="40" border="0">
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table></td>
      <td valign="top" width="185" class="spechide">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
    <tr>
    	<td height="40"></td>
    </tr>
  </tbody>
</table>

     <!-- =============== END FOOTER =============== --> 
      </div>
      </td>
    </tr>
  </tbody>
</table>
</td>
      <td valign="top" width="20">&nbsp;</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>
</td>
    </tr>
  </tbody>
</table>


  </body>
</html>';


  // sending mail //
  //mail($to_mail, $subject, $msg_body,$headers);

  // print output //
  echo $msg_body;

?>