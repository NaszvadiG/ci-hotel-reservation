<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="mg-best-rooms">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mg-sec-title">
                    <h2>Our Best Rooms</h2>
                    <p>These best rooms chosen by our customers</p>
                </div>
                <div class="row">
                    <?php
                    if ($rooms):
                            foreach ($rooms as $room):
                                    if (!$room->room_type->room_type_active)
                                    {
                                            continue;
                                    }
                                    ?>
                                    <div class="col-sm-4">
                                        <figure class="mg-room">
                                            <img src="<?php echo $this->config->item('room_image_dir') . $room->room_image; ?>" alt="room number <?php echo $room->room_number ?>." class="img-responsive">
                                            <figcaption>
                                                <h2><?php echo $room->room_type->room_type_name; ?></h2>
                                                <div class="mg-room-rating"><i class="fa fa-star"></i> 5.00</div>
                                                <div class="mg-room-price"><?php echo $this->config->item('currency') . $room->room_price; ?><sup>.99/Night</sup></div>
                                                <p><?php echo $room->room_description; ?></p>
                                                <a href="#" class="btn btn-link">View Details <i class="fa fa-angle-double-right"></i></a>
                                                <a href="#" class="btn btn-main">Book</a>
                                            </figcaption>			
                                        </figure>
                                    </div>
                                    <?php
                            endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>