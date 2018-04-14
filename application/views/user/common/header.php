<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home Page</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" >

	<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

	<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-auth.js"></script>
	<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-database.js"></script>
	<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-firestore.js"></script>
	<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-messaging.js"></script>
	<script src="https://www.gstatic.com/firebasejs/4.12.0/firebase-functions.js"></script>
	<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
	<script src="<?= base_url('assets/js/functions.js'); ?>"></script>
	
	<script>
	  // Initialize Firebase
	  var config = {
	    apiKey: "AIzaSyBCRGDpz5waFax4tn0CGo8FjMoARP86ZNQ",
	    authDomain: "bidwin-34db6.firebaseapp.com",
	    databaseURL: "https://bidwin-34db6.firebaseio.com",
	    projectId: "bidwin-34db6",
	    storageBucket: "bidwin-34db6.appspot.com",
	    messagingSenderId: "794207874375"
	  };
	  firebase.initializeApp(config);

	</script>

</head>
<body>
	<input id='servertime' type='hidden' value='<?php echo time();?>'/>

	