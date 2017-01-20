<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div role="tabpanel" class="tab-pane fade in active" id="select-room">
    <div class="mg-saerch-room">
        <div class="mg-book-now mt80">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mg-bn-title">Search Rooms <span class="mg-bn-big">For rates & availability</span></h2>
                </div>
                <div class="col-md-9">
                    <div class="mg-bn-forms">
                        <?php echo form_open(); ?>
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="input-group date mg-check-in">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Check In">
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="input-group date mg-check-out">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Check Out">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row"> 
                                    <div class="col-xs-6">
                                        <select class="cs-select cs-skin-elastic">
                                            <option value="" disabled selected>Adult</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6">
                                        <select class="cs-select cs-skin-elastic">
                                            <option value="" disabled selected>Child</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-main btn-block">Check Now</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
