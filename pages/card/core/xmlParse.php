<?php
if(isset($_POST["submit"]))
{
//if($_POST['dt']>0)
//{
//$dtSort=explode('/', $_POST['dt']);
//$dt=$dtSort[2].'-'.$dtSort[1].'-'.$dtSort[0];
if($_FILES["fileToUpload"]["name"]) {
$dir='xml/'.date('Y-m-d_H_i_s').'/';
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$fName=basename($_FILES["fileToUpload"]["name"]);
$target_dir = $dir;
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    // Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	        
	        
	        
	        //upload file into database.....................................
	        include("../database.php");
$dtT=date("Y-m-d H:i:s");
$usr='1';
$localBkPath=$target_file;

$Statements=simplexml_load_file($localBkPath);

foreach ($Statements->Statement as $stmt)
{
	
	echo $StatementNo=$stmt->StatementNo;
	echo "<br>";
	
	//client info........................................................
	echo $Title=mysql_real_escape_string($stmt->Title);
	echo "<br>";
	echo $Client=mysql_real_escape_string($stmt->Client);
	echo "<br>";
	echo $IdClient=mysql_real_escape_string($stmt->IdClient);
	echo "<br>";
	echo $Country=mysql_real_escape_string($stmt->Country);
	echo "<br>";
	echo $Region=mysql_real_escape_string($stmt->Region);
	echo "<br>";
	echo $ZIP=mysql_real_escape_string($stmt->ZIP);
	echo "<br>";
	echo $Pager=mysql_real_escape_string($stmt->Pager);
	echo "<br>";
	echo $Mobile=mysql_real_escape_string($stmt->Mobile);
	echo "<br>";
	echo $Email=mysql_real_escape_string($stmt->Email);
	echo $PersonalCode=mysql_real_escape_string($stmt->PersonalCode);	
	echo "<br>";
	echo $Address=mysql_real_escape_string($stmt->Address);
	echo "<br>";
	echo $Telephone=mysql_real_escape_string($stmt->Telephone);
	echo "<br>";
	echo $Fax=mysql_real_escape_string($stmt->Fax);
	echo "<br>";
	echo $StreetAddress=mysql_real_escape_string($stmt->StreetAddress);
	echo "<br>";
	echo $House=mysql_real_escape_string($stmt->House);
	echo "<br>";
	echo $ContractNo=mysql_real_escape_string($stmt->ContractNo);	 
	echo "<br>";
	echo $ContractType=mysql_real_escape_string($stmt->ContractType);	
	echo "<br>";
	echo $ClientLat=mysql_real_escape_string($stmt->ClientLat);
	echo "<br>";
	echo $Sex=mysql_real_escape_string($stmt->Sex);
	echo "<br>";
	
	$q0=mysql_query("select * from customer where IdClient='$IdClient'");
	if(mysql_num_rows($q0)>0)
	{
		$r0=mysql_fetch_array($q0);
		if($Email=='')
			$Email=$r0['email'];
		$q1=mysql_query("update customer set Client='$Client', Country='$Country', Region='$Region', ZIP='$ZIP', Pager='$Pager', Mobile='$Mobile', email='$Email', PersonalCode='$PersonalCode', 
		Address='$Address', Telephone='$Telephone', Fax='$Fax', StreetAddress='$StreetAddress', House='$House', ContractNo='$ContractNo', ContractType='$ContractType', 
		ClientLat='$ClientLat', Sex='$Sex', Title='$Title', lastUpdOn='$dtT', usr='$usr' where IdClient='$IdClient'");
	}
	else
	{	
		$cusContact=$Mobile.', Tel:'.$Telephone.', Fax:'.$Fax;
		$q1=mysql_query("insert into customer values('null', '$IdClient', '$Client', '$Country', '$Region', '$ZIP', '$Pager', '$Mobile', '$Email', '$PersonalCode', '$Address', '$Telephone', 
		'$Fax', '$StreetAddress', '$House', '$ContractNo', '$ContractType', '$ClientLat', '$Sex', '$Title', '1', '$dtT', '$usr')");
		
		//$q1_1=mysql_query("insert into customer_contact values('$IdClient', '', '', '', '$dtT', '$usr')");
	}
	
	
	//statement summary..........................................
	

	echo $STATEMENT_DATE=$stmt->STATEMENT_DATE;
	$STATEMENT_DATESort=explode('/', $stmt->STATEMENT_DATE);
	echo $STATEMENT_DATE1=$STATEMENT_DATESort[2].'-'.$STATEMENT_DATESort[1].'-'.$STATEMENT_DATESort[0];
	echo "<br>";
	
	echo $StartDate=$stmt->StartDate;
	$StartDateSort=explode('/', $stmt->StartDate);	
	$StartDateSort1=explode(' ', $StartDateSort[2]);
	echo $StartDate1=$StartDateSort1[0].'-'.$StartDateSort[1].'-'.$StartDateSort[0].' '.$StartDateSort1[1];
	echo "<br>";
	
	echo $CARD_LIST=mysql_real_escape_string($stmt->CARD_LIST);	echo "<br>";
	
	$NEXT_STATEMENT_DATE=$stmt->NEXT_STATEMENT_DATE;
	$NEXT_STATEMENT_DATE_SORT=explode('/', $stmt->NEXT_STATEMENT_DATE);	
	echo $NEXT_STATEMENT_DATE1=$NEXT_STATEMENT_DATE_SORT[2].'-'.$NEXT_STATEMENT_DATE_SORT[1].'-'.$NEXT_STATEMENT_DATE_SORT[0];
	echo "<br>";
	
	$PAYMENT_DATE=$stmt->PAYMENT_DATE;
	$PAYMENT_DATE_SORT=explode('/', $stmt->PAYMENT_DATE);	
	echo $PAYMENT_DATE1=$PAYMENT_DATE_SORT[2].'-'.$PAYMENT_DATE_SORT[1].'-'.$PAYMENT_DATE_SORT[0];
	echo "<br>";
	
	$EndDate=$stmt->EndDate;
	$EndDateSort=explode('/', $stmt->EndDate);
	$EndDateSort1=explode(' ', $EndDateSort[2]);
	echo $EndDate1=$EndDateSort1[0].'-'.$EndDateSort[1].'-'.$EndDateSort[0].' '.$EndDateSort1[1];
	echo "<br>";
	
	echo $STATEMENT_PERIOD=$stmt->STATEMENT_PERIOD; 	echo "<br>";
	echo $StatementType=mysql_real_escape_string($stmt->StatementType);	echo "<br>";
	echo $SendType=mysql_real_escape_string($stmt->SendType);	echo "<br>";
	echo $MAIN_CARD=mysql_real_escape_string($stmt->MAIN_CARD);	echo "<br>";
	
	$CARD_LIST_CHK=str_replace(' ', '', $CARD_LIST);
	
	if(!$CARD_LIST_CHK)
	{
		$CARD_LIST_SORT=explode('-', $MAIN_CARD);
		echo $CARD_LIST=$CARD_LIST_SORT[0];
	}
	
	$q2=mysql_query("select * from stmt_info where IdClient='$IdClient' and CARD_LIST='$CARD_LIST' and STATEMENT_DATE='$STATEMENT_DATE'");
	if(mysql_num_rows($q2)>0)
	{
		$q3=mysql_query("update stmt_info set CARD_LIST='$CARD_LIST', StartDate='$StartDate', StartDateSort='$StartDate1', 
		NEXT_STATEMENT_DATE='$NEXT_STATEMENT_DATE', NEXT_STATEMENT_DATE_SORT='$NEXT_STATEMENT_DATE1', PAYMENT_DATE='$PAYMENT_DATE', PAYMENT_DATE_SORT='$PAYMENT_DATE1', 
		EndDate='$EndDate', EndDateSort='$EndDate1', STATEMENT_PERIOD='$STATEMENT_PERIOD', StatementType='$StatementType', SendType='$SendType', lastUpdOn='$dtT', usr='$usr' 
		where IdClient='$IdClient' and MAIN_CARD='$MAIN_CARD' and STATEMENT_DATE='$STATEMENT_DATE'");
	}
	else
	{
		$q3=mysql_query("insert into stmt_info values('$IdClient', '$CARD_LIST', '$STATEMENT_DATE', '$STATEMENT_DATE1', '$MAIN_CARD', '$StartDate', '$StartDate1', 
		'$NEXT_STATEMENT_DATE', '$NEXT_STATEMENT_DATE1', '$PAYMENT_DATE', '$PAYMENT_DATE1', '$EndDate', '$EndDate1', '$STATEMENT_PERIOD', '$StatementType', '$SendType', '$dtT', '$usr')");
	}
	
	foreach ($stmt->Operations->Operation as $opr)
	{
		echo $OprStatementNo= $opr->StatementNo; echo "<br>";
		echo $O= $opr->O; echo "<br>";
		
		echo $OD= $opr->OD; echo "<br>"; $OD1='';
		if($OD)
		{
		$OD_SORT=explode('/', $opr->OD);
		$OD_SORT1=explode(' ', $OD_SORT[2]);
		echo $OD1=$OD_SORT1[0].'-'.$OD_SORT[1].'-'.$OD_SORT[0].' '.$OD_SORT1[1];
		echo "<br>";
		}
		
		echo $TD= $opr->TD; echo "<br>"; $TD1='';
		if($TD)
		{
		$TD_SORT=explode('/', $opr->TD);
		$TD_SORT1=explode(' ', $TD_SORT[2]);
		echo $TD1=$TD_SORT1[0].'-'.$TD_SORT[1].'-'.$TD_SORT[0].' '.$TD_SORT1[1];
		echo "<br>";
		}
		
		echo $A= $opr->A; echo "<br>";
		echo $ACURC= $opr->ACURC; echo "<br>";
		echo $ACURN= $opr->ACURN; echo "<br>";
		echo $D= mysql_real_escape_string($opr->D); echo "<br>";
		echo $DE= mysql_real_escape_string($opr->DE); echo "<br>";
		echo $P= mysql_real_escape_string($opr->P); echo "<br>";
		echo $OA= mysql_real_escape_string($opr->OA); echo "<br>";
		echo $OCC= mysql_real_escape_string($opr->OCC); echo "<br>";		
		echo $OC= mysql_real_escape_string($opr->OC); echo "<br>";	
		echo $TL= mysql_real_escape_string($opr->TL); echo "<br>";	
		echo $TERMN= mysql_real_escape_string($opr->TERMN); echo "<br>";	
		echo $CF= mysql_real_escape_string($opr->CF); echo "<br>";
		echo $S= mysql_real_escape_string($opr->S); echo "<br>";	
		echo $MN= mysql_real_escape_string($opr->MN); echo "<br>";	
		echo $DOCNO= mysql_real_escape_string($opr->DOCNO); echo "<br>";
		echo $NO= mysql_real_escape_string($opr->NO); echo "<br>";
		echo $ACCOUNT= mysql_real_escape_string($opr->ACCOUNT); echo "<br>";
		echo $ACC1= mysql_real_escape_string($opr->ACC); echo "<br>";
		echo $AMOUNTSIGN= $opr->AMOUNTSIGN; echo "<br>";
		echo $FR= mysql_real_escape_string($opr->FR); echo "<br>";
		echo $APPROVAL= mysql_real_escape_string($opr->APPROVAL); echo "<br>";	
		
		$q4=mysql_query("select * from operations where IdClient='$IdClient' and CARD_LIST='$MAIN_CARD' and STATEMENT_DATE='$STATEMENT_DATE' and O='$O' and ACCOUNT='$ACCOUNT'");
		if(mysql_num_rows($q4)>0)
		{
		$q5=mysql_query("update operations set OD='$OD', OD_SORT='$OD1', TD='$TD', TD_SORT='$TD1', A='$A', ACURC='$ACURC', ACURN='$ACURN', D='$D', DE='$DE', P='$P', 
		OA='$OA', OCC='$OCC', OC='$OC', TL='$TL', TERMN='$TERMN', 
		CF='$CF', DOCNO='$DOCNO', NO='$NO', ACC='$ACC1', S='$S', MN='$MN',
		AMOUNTSIGN='$AMOUNTSIGN', FR='$FR', 
		APPROVAL='$APPROVAL', lastUpdOn='$dtT', usr='$usr' 
		where IdClient='$IdClient' and CARD_LIST='$MAIN_CARD' and STATEMENT_DATE='$STATEMENT_DATE' and O='$O'");
		}
		else
		{
		$q5=mysql_query("insert into operations values('$IdClient', '$MAIN_CARD', '$STATEMENT_DATE', '$STATEMENT_DATE1', '$O', '$OD', '$OD1', '$TD', '$TD1', '$A', 
		'$ACURC', '$ACURN', '$D', '$DE', '$P', '$OA', '$OCC', '$OC', '$TL', '$TERMN', '$CF', '$S', '$MN', '$DOCNO', '$NO', '$ACC1', '$AMOUNTSIGN', '$ACCOUNT', '$FR', 
		'$APPROVAL', '$dtT', '$usr')");
		}
		
	}
	
	foreach ($stmt->Accounts->Account as $acc)
	{
		echo $OprStatementNo= $acc->StatementNo; echo "<br>";
		echo $ACCOUNTNO= $acc->ACCOUNTNO; echo "<br>";
		echo $OVLFEE_AMOUNT= $acc->OVLFEE_AMOUNT; echo "<br>";
		echo $OVDFEE_AMOUNT= $acc->OVDFEE_AMOUNT; echo "<br>";
		echo $SUM_REVERSE= $acc->SUM_REVERSE; echo "<br>";
		echo $SUM_CREDIT= $acc->SUM_CREDIT; echo "<br>";
		echo $SUM_OTHER= $acc->SUM_OTHER; echo "<br>";
		echo $SUM_INTEREST= $acc->SUM_INTEREST; echo "<br>";
		echo $SUM_PURCHASE= $acc->SUM_PURCHASE; echo "<br>";
		echo $SUM_WITHDRAWAL= $acc->SUM_WITHDRAWAL; echo "<br>";
		echo $MIN_AMOUNT_DUE= $acc->MIN_AMOUNT_DUE; echo "<br>";
		echo $AVAIL_CASH_LIMIT= $acc->AVAIL_CASH_LIMIT; echo "<br>";
		echo $CASH_LIMIT= $acc->CASH_LIMIT; echo "<br>";
		echo $INSTALL_UNPAID_AMOUNT= $acc->INSTALL_UNPAID_AMOUNT; echo "<br>";
		echo $INSTALL_MONTH_PAYM= $acc->INSTALL_MONTH_PAYM; echo "<br>";
		echo $AVAIL_CRD_LIMIT= $acc->AVAIL_CRD_LIMIT; echo "<br>";
		echo $CRD_LIMIT= $acc->CRD_LIMIT; echo "<br>";
		echo $EBALANCE= $acc->EBALANCE; echo "<br>";
		echo $SBALANCE= $acc->SBALANCE; echo "<br>";
		echo $ACC_ACURC= $acc->ACURC; echo "<br>";
		echo $ACC_ACURN= $acc->ACURN; echo "<br>";
		
		$q6=mysql_query("select * from account_summary where IdClient='$IdClient' and CARD_LIST='$MAIN_CARD' and STATEMENT_DATE='$STATEMENT_DATE' and ACCOUNTNO='$ACCOUNTNO'");
		if(mysql_num_rows($q6)>0)
		{
		$q7=mysql_query("update account_summary set OVLFEE_AMOUNT='$OVLFEE_AMOUNT', OVDFEE_AMOUNT='$OVDFEE_AMOUNT', SUM_REVERSE='$SUM_REVERSE', 
		SUM_CREDIT='$SUM_CREDIT', SUM_OTHER='$SUM_OTHER', SUM_INTEREST='$SUM_INTEREST', SUM_PURCHASE='$SUM_PURCHASE', SUM_WITHDRAWAL='$SUM_WITHDRAWAL', MIN_AMOUNT_DUE='$MIN_AMOUNT_DUE', 
		AVAIL_CASH_LIMIT='$AVAIL_CASH_LIMIT', CASH_LIMIT='$CASH_LIMIT', INSTALL_UNPAID_AMOUNT='$INSTALL_UNPAID_AMOUNT', 
		INSTALL_MONTH_PAYM='$INSTALL_MONTH_PAYM', AVAIL_CRD_LIMIT='$AVAIL_CRD_LIMIT', CRD_LIMIT='$CRD_LIMIT', EBALANCE='$EBALANCE', SBALANCE='$SBALANCE',
		ACURC='$ACC_ACURC', ACURN='$ACC_ACURN', lastUpdOn='$dtT', uploadedFIleName='$fName', usr='$usr'
		where IdClient='$IdClient' and CARD_LIST='$MAIN_CARD' and STATEMENT_DATE='$STATEMENT_DATE' and ACCOUNTNO='$ACCOUNTNO'");
		}
		else
		{
		$q7=mysql_query("insert into account_summary values('$IdClient', '$MAIN_CARD', '$STATEMENT_DATE', '$ACCOUNTNO', '$STATEMENT_DATE1', '$OVLFEE_AMOUNT', '$OVDFEE_AMOUNT', '$SUM_REVERSE', 
		'$SUM_CREDIT', '$SUM_OTHER', '$SUM_INTEREST', '$SUM_PURCHASE', '$SUM_WITHDRAWAL', '$MIN_AMOUNT_DUE', '$AVAIL_CASH_LIMIT', '$CASH_LIMIT', '$INSTALL_UNPAID_AMOUNT', 
		'$INSTALL_MONTH_PAYM', '$AVAIL_CRD_LIMIT', '$CRD_LIMIT', '$EBALANCE', '$SBALANCE','$ACC_ACURC','$ACC_ACURN', '$dtT', '$fName', '$usr')");
		}
		
	}
	
	foreach ($stmt->Cards->Card as $card)
	{
		echo $cardStatementNo= $card->StatementNo; echo "<br>";
		echo $PAN= mysql_real_escape_string($card->PAN); echo "<br>";
		echo $MBR= mysql_real_escape_string($card->MBR); echo "<br>";
		echo $CARD_CLIENTNAME= mysql_real_escape_string($card->CLIENTNAME); echo "<br>";
		
		$q8=mysql_query("select * from customer_card where IdClient='$IdClient' and PAN='$PAN'");
		if(mysql_num_rows($q8)>0)
		{
		$q9=mysql_query("update customer_card set MBR='$MBR', CLIENTNAME='$CARD_CLIENTNAME', lastUpdOn='$dtT', usr='$usr' where IdClient='$IdClient' and PAN='$PAN'");
		}
		else
		{
		$q9=mysql_query("insert into customer_card values('$IdClient', '$PAN', '$MBR', '$CARD_CLIENTNAME', '$dtT', '$usr')");
		}
	}	

}

// end of uploading file into DB.................................................
	        
	        
	        
	        
	        
	        
	        
	        
	        
	        
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

}
else
	echo "<script>alert('No File Found')</script>";

//}
//else
//{
//echo "<script>alert('Enter Billing Date')</script>";
//}
}
?>    