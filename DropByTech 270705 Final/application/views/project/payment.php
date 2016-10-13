<style>
    .circular2 {
        width: 81px;
        height: 81px;
        border-radius: 40px;
        -webkit-border-radius: 40px;
        -moz-border-radius: 40px;
    }
</style>
<div class="tab-menu">
    <div class="container">
        <div class="row tab-info">
            <ul class="nav nav-tabs" role="tablist" id="personal-info">
                <li class="active"><a href="#dopayment">Do Payment</a></li>
            </ul>
        </div>
        <div class="row tab-content personal-info" >
            <!-- personal info section -->
            <div role="tabpanel" class="tab-pane active col-xs-12 col-md-12" id="personalinfo">
                <div class="message-container"></div>

                <div class="col-xs-12 col-md-10">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>project/find?owner=me" name="cpi-form">
                        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
                        <div class="form-group">
                            Please select if you want to use stored Credit Card or New One:</br><i>The payment process will be done using STRIPE service</i>
                        </div>


                            <div class="input-group">
      							  	<span class="input-group-addon">
        								<input type="radio" aria-label="..." >
      							    </span>
                                <input type="text" class="form-control" value="Registered Credit Card (from profile)" readonly />
                            </div><!-- /input-group -->

                            <div class="input-group">
      							    <span class="input-group-addon">
        								<input type="radio" aria-label="...">
      							    </span>
                                <input type="text" name="newcardholder" class="form-control col-xs-6" value="" placeholder="Card Name" />
                                <input type="text" name="newcardnumber" class="form-control col-xs-6" value="" placeholder="Enter new card number here" />
                                <input type="text" name="newcardexpdate" class="form-control span2" value="" placeholder="Enter new card exp. date" />

                            </div><!-- /input-group -->


                        </br>

                        <div class="form-group">
                        <input type="submit" class="btn type-c pull-right" value="Proceed with payment" />
                        </div>
                    </form>
                </div>
            </div>
            <!-- end of personal info -->


        </div>
    </div>
</div>
</div>