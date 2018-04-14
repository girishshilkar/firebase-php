<div class="container" >

  <div class="row" >
    Live
  </div>
  <br>
  <?php 

    $i=0;
    foreach ($list as $key => $value) 
    {

      $i++;
      $value = (array) $value;

      echo '<div class="row" >

            <div class="card" style="width: 100%;">
              
              <div class="card-body">';

      print_r('<input type="hidden" name="hotelId'.$i.'" value="'.$key.'">');

      print_r('<h5 class="card-title">'.$value['name'].'</h5>
              <p class="card-text">'.$value['description'].'</p>
              <p class="card-text">Starting Bid : '.$value['startPrice'].'</p>
              <a href="#" class="btn">Enter Auction</a>');

      echo '    </div>

              </div>

            </div> <br>';
    }

  ?>
 
        
      

</div>




    
