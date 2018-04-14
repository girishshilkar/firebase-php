<?php 

require 'C:/xampp/htdocs/bidwin/application/libraries/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile('C:/xampp/htdocs/bidwin/application/libraries/vendor/kreait/firebase_credentials.json');
$firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

$database = $firebase->getDatabase();

$newPost = $database
    ->getReference('Server')
    ->set([
        'servertime' => time()
    ]);

print_r('Success'); // => -KVr5eu8gcTv7_AHb-3-
 // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-



?>