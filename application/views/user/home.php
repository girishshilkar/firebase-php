
<div class="container">

<!-- Grand Prizes -->

  <div class="row">
   
  <a href="<?php echo base_url();?>/grandprize">
	<img border="0" alt="Grand Prize" src="logo_w3s.gif" width="100" height="100">
  </a>

  </div>

  <div class="row">
<!--      daily scratch reward notification -->
<?php
if ($this->session->flashdata('daily_scratch') > 0)
    echo "Congrats! you got a free scratch";
?>
  	<!-- Scratch It -->
    <div class="col">

      <a href="<?php echo base_url();?>scratch/businessList">
		<img border="0" alt="Scratch It" src="logo_w3s.gif" width="100" height="100">
	  </a>

    </div>

    <!-- Hotel Bidding -->
    <div class="col">

      <a href="<?php echo base_url();?>hotelbidding/">
		<img border="0" alt="Hotel Bidding" src="logo_w3s.gif" width="100" height="100">
	  </a>

    </div>
  </div>


</div>





    
