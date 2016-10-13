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
            <ul class="nav nav-tabs">
                <li class="active"><a href="#info-tab" data-toggle="tab">Bids For This Project</a></li>
            </ul>
        </div>
		<?php 
		if ($user_type != 1) { echo '<br><p style="color:white"><b>You have to be a client to view this page!</b></p>'; }		
		foreach ($bids as $bid) {
		echo '<div class="row project-details">';
        echo '  <div class="col-xs-12 col-sm-12 col-md-12 project-client">';
        echo '      <div class="row"  >';
        echo '          <div class="col-xs-12 col-sm-2 col-md-2 text-center">';	
		$myfile = 'assets/images/userphoto/' .$bid->contractorid;		
		if (file_exists($myfile .'.png')) {
		    	echo '<img src="' .base_url() . $myfile. '.png' .'" alt="" height="81" width="81" class="circular2" />';
		} else {
		if (file_exists($myfile .'.jpg')) {
				echo '<img src="' .base_url() . $myfile. '.jpg' .'" alt="" height="81" width="81" class="circular2" />';
		} else {
		    	echo '<img src="' .base_url(). 'assets/images/person.png" alt="" height="81" width="81" class="circular2" />';
		}
		}
		echo '               <h6>'.$contractorname[$bid->id][0]->fname .' '.$contractorname[$bid->id][0]->lname. '</h6>';
		echo '          </div>';
        echo '          <div class="col-xs-12 col-sm-7 col-md-8">';
        echo '<h4>New Bid</h4>';
		echo '               <span>I will Deliver by - ';	// promised delivery date
		$source = $bid->deliverydate;
		$date = new DateTime($source);
		echo $date->format('F j, Y'); 
		echo '</span>';
		echo '               <p>' .$bid->coverletter;	// contractor cover letter
		echo '</p>';
        echo '          </div>';
        echo '          <div class="col-xs-12 col-sm-3 col-md-2 budget-project">';
        echo '               <span>Budget: <b>$ ' .$bid->budget. '</b></span><br>';	// proposed budget
		echo '<br>';
        echo '               <div class="text-center">';
        echo '					<a href="#" data-id="'.$bid->projectid.'" class="awarding btn btn-warning" data-toggle="modal">Choose this one!</a>';
		echo '				</div>';
		echo '			</div>';
		echo '		</div>';
		echo '	</div>';
		echo '</div>';
		}
		?>
		
</div>
</div>