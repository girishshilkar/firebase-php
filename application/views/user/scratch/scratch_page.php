<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/13/2018
 * Time: 12:54 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <h2><?= $scratch_products->data[0]->businessName ?></h2>
    <?php if (!empty($scratch_products)) { ?>
        <h3>You can win any of the below products</h3>
        <div class="row">
        <?php foreach ($scratch_products->data as $product) { ?>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;" id="prod<?= $product->id; ?>">
                    <img class="card-img-top" src="<?= base_url('assets/uploads/Tulips.jpg') ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product->description; ?></h5>
                        <!--                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of-->
                        <!--                            the-->
                        <!--                            card's content.</p>-->
                        <!--                        <a href="scratch" class="btn btn-primary">Go somewhere</a>-->
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
        <button class="btn btn-primary" onclick="scratchIt('<?= $this->input->get('id') ?>')">Scratch</button>
    <?php } ?>
</div>

<script>
    sync();
    updatetime();
    timer();

    function scratchIt(id) {
        $.ajax({
            url: "<?= base_url('Scratch/scratchIt'); ?>",
            cache: false,
            type: 'POST',
            dataType: 'json',
            data: {'id': id},
            success: function (data) {
                if (data.data.useLimit <= 0) {
                    $('#prod' + data.data.id).fadeOut("slow", function () {
                        $('#prod' + data.data.id).remove();
                    });
                }
            }
        });
    }
</script>