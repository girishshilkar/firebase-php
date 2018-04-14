<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/10/2018
 * Time: 1:52 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <div class="row">
        <?php foreach ($business_list->data as $list) { ?>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="<?= base_url('assets/uploads/Tulips.jpg') ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $list->name; ?></h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the
                            card's content.</p>
                        <a href="scratchPage?id=<?= $list->id; ?>" class="btn btn-primary">View products</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>