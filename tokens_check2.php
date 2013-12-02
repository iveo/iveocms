
<?php
include('api/ipnlistener.php');
include('fonction.php');
include('sql.php');
// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

// intantiate the IPN listener

$listener = new IpnListener();

// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = true;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}

if ($verified) {
   $errmsg = '';   // stores errors from fraud checks
    
    // 1. Make sure the payment status is "Completed" 
    if ($_POST['payment_status'] != 'Completed') { 
        // simply ignore any IPN that is not completed
        exit(0); 
    }

    // 2. Make sure seller email matches your primary account email.
    if ($_POST['receiver_email'] != 'hostime.eu@gmail.com') {
        $errmsg .= "'receiver_email' does not match: ";
        $errmsg .= $_POST['receiver_email']."\n";
    }
    
    // 3. Make sure the amount(s) paid match
    if ($_POST['mc_gross'] != '1.30' && $_POST['mc_gross'] != '5.40' && $_POST['mc_gross'] != '10.60' && $_POST['mc_gross'] != '20.95' && $_POST['mc_gross'] != '31.00') {
    // $_POST['mc_gross'] != '1,30' && $_POST['mc_gross'] != '5,40' && $_POST['mc_gross'] != '10,60' && $_POST['mc_gross'] != '20,95' && $_POST['mc_gross'] != '31,00') {
        $errmsg .= "'mc_gross' does not match: ";
        $errmsg .= $_POST['mc_gross']."\n";
    }
	
	$price = '';
		
	// if (if() != '1.30' || $_POST['mc_gross'] != '5.40' || $_POST['mc_gross'] != '10.60' || $_POST['mc_gross'] != '20.95' || $_POST['mc_gross'] != '31.00')
	
	if($_POST['mc_gross'] == '1.30')	$price = '1';
	if($_POST['mc_gross'] == '5.40')	$price = '5';
	if($_POST['mc_gross'] == '10.60')	$price = '10';
	if($_POST['mc_gross'] == '20.95')	$price = '20';
	if($_POST['mc_gross'] == '31.00')	$price = '30';
	
	// if($_POST['mc_gross'] == '1,30')	$price = '1';
	// if($_POST['mc_gross'] == '5,40')	$price = '5';
	// if($_POST['mc_gross'] == '10,60')	$price = '10';
	// if($_POST['mc_gross'] == '20,95')	$price = '20';
	// if($_POST['mc_gross'] == '31,00')	$price = '30';
	
	if($price == '')
	{
		$errmsg .= "price is empty: ";
        $errmsg .= ' mc_gross = ' . $_POST['mc_gross']."\n";
	}
    
    // 4. Make sure the currency code matches
    if ($_POST['mc_currency'] != 'EUR') {
        $errmsg .= "'mc_currency' does not match: ";
        $errmsg .= $_POST['mc_currency']."\n";
    }

    // TODO: Check for duplicate txn_id
	mysql_connect("localhost", DB_USERS, DB_PWD)or error_log('Erreur SQL de connexion !<br>'.$db.'<br>'.mysql_error());
    mysql_select_db(DB_SELECT) or exit(0);

    $txn_id = mysql_real_escape_string($_POST['txn_id']);
    $sql = "SELECT COUNT(*) FROM hostime_paypal_log WHERE txn_id = '$txn_id'";
    $r = mysql_query($sql);
    
    if (!$r) {
        error_log('SQL REQ: '.$sql.' ERROR: ' . mysql_error());
        exit(0);
    }
    
    $exists = mysql_result($r, 0);
    mysql_free_result($r);
    
	
	
    if ($exists) {
        $errmsg .= "'txn_id' has already been processed: ".$_POST['txn_id']."\n";
    }
    
    if (!empty($errmsg)) {
    
        // manually investigate errors from the fraud checking
        $body = "IPN failed fraud checks: \n$errmsg\n\n";
        $body .= $listener->getTextReport();
		error_log('ITS WRONG !');
		error_log($body);
        // mail('YOUR EMAIL ADDRESS', 'IPN Fraud Warning', $body);
        
    } else {
		$payer_email = mysql_real_escape_string($_POST['payer_email']);
		$mc_gross = mysql_real_escape_string($_POST['mc_gross']);
		$user = mysql_real_escape_string($_POST['custom']);
		$sql = "INSERT INTO hostime_paypal_log VALUES 
				(NULL, '$txn_id', '$payer_email', $mc_gross, '$user')";
		
		if (!mysql_query($sql)) {
			error_log('SQL REQ: '.$sql.' ERROR: ' . mysql_error());
			exit(0);
		}
		
		// send user an email with a link to their digital download
		// $to = filter_var($_POST['payer_email'], FILTER_SANITIZE_EMAIL);
		// $subject = "Your digital download is ready";
		// mail($to, "Thank you for your order", "Download URL: ...");
		
        // TODO: process order here
		error_log('ITS OK !!!!');
		// $_POST['custom']
		
		$sql = "UPDATE hostime_users SET tokens = tokens+".$price." WHERE user = '".$user."' LIMIT 1";
		if (!mysql_query($sql)) {
			error_log('SQL REQ: '.$sql.' ERROR: ' . mysql_error());
			exit(0);
		}
    }
	mysql_close();
	
} else {
    // manually investigate the invalid IPN
    // mail('hostime.eu@gmail.com', 'Invalid IPN', $listener->getTextReport());
	error_log('ITS WRONG INVALID IPN !!');
	error_log($listener->getTextReport());
}

// TODO: Handle IPN Response here

?>
