<script>
  sync();
  updatetime();
  $(document).ready(function()
  {

    sync();
    updatetime();
    timer();
    Check_upcoming();

  });
</script>


<div class="container" >

  <div class="row" >
    Live
  </div>
  <br>
  <?php 
  //Show live list
    $i=0;
    foreach ($live as $key => $value) 
    {

      $i++;
      $value = (array) $value;

      echo '<div class="row" >

            <div class="card" style="width: 100%;">
              
              <div class="card-body">';

      print_r('<input type="hidden" name="hotelId'.$i.'" value="'.$key.'">');


      print_r('<h5 class="card-title">'.$value['business_name'].'</h5>
            <p class="card-text">'.$value['bidoffer_name'].'</p>
            <p class="card-text">'.$value['description'].'</p>
            <p class="card-text">Starting Bid : '.$value['startPrice'].'</p>
            <a href="#" class="btn">Enter Auction</a>');

      echo '    </div>

              </div>

            </div> <br>';
    }

  ?>
 
  <?php 
  //Hidden upcoming list
    $i=0;
    foreach ($upcoming as $key => $value) 
    {

      $i++;
      $value = (array) $value;

      echo '<div class="row" id="upcoming_live'.$key.'"  style="display: none;" ">

            <div class="card" style="width: 100%;">
              
              <div class="card-body">';

      print_r('<input type="hidden" name="hotelId'.$i.'" value="'.$key.'">');


      print_r('<h5 class="card-title">'.$value['business_name'].'</h5>
            <p class="card-text">'.$value['bidoffer_name'].'</p>
            <p class="card-text">'.$value['description'].'</p>
            <p class="card-text">Starting Bid : '.$value['startPrice'].'</p>
            <a href="#" class="btn">Enter Auction</a>');

      echo '    </div>

              </div>

            </div> ';
    }

  ?>

  <br>
  <div class="row" >
    Upcoming
  </div>
  <br>
  <?php 

    $i=0;
    foreach ($upcoming as $key => $value) 
    {

      $i++;
      $value = (array) $value;

      echo '<div class="row" id="upcoming'.$key.'" >

            <div class="card" style="width: 100%;">
              
              <div class="card-body">';

      print_r('<input type="hidden" name="hotelId'.$i.'" value="'.$key.'">');

      print_r('<h5 class="card-title">'.$value['business_name'].'</h5>
            <p class="card-text">'.$value['bidoffer_name'].'</p>
            <p class="card-text">'.$value['description'].'</p>
            <p class="card-text">Starting Bid : '.$value['startPrice'].'</p>
            <p class="card-text">Starting Time : '.$value['startAtTime'].'</p>
            <a href="#" class="btn" id="enter'.$key.'" style="display:none;">Enter Auction</a>');

      echo '    </div>

              </div>

            </div> <br>
            ';
    }

  ?>  
      

</div>

<script> 
function Check_upcoming() 
  {
    setInterval(function()
      { 
        
        var servertime = parseInt($("#servertime").val());

        <?php 
            
            foreach ($upcoming as $key => $value) 
            {
              $value = (array) $value;
              $date = strtotime($value['startAtTime']);
              $dateenter = strtotime($value['startAtTime'])-300;

              echo 'if('.$dateenter.' < servertime){$("#enter'.$key.'").show(100); }';
              echo 'if('.$date.' < servertime){$("#upcoming'.$key.'").hide(1000); $("#upcoming_live'.$key.'").show(1000);}';

            }
        ?>
      }

  , 1000);

  }
 </script> 


    
