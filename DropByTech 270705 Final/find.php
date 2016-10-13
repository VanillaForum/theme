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
                <li class="active"><a href="#info-tab" data-toggle="tab">Open Projects</a></li>
                <li><a href="#address-tab" data-toggle="tab">ArchiveD</a></li>
            </ul>
        </div>
        <?php 		
		foreach ($projects as $project) {
		echo '<div class="row project-details">';
        echo '  <div class="col-xs-12 col-sm-12 col-md-12 project-client">';
        echo '      <div class="row"  >';
        echo '          <div class="col-xs-12 col-sm-2 col-md-2 text-center">';	
		$myfile = 'assets/images/userphoto/' .$project->clientid;		
		if (file_exists($myfile .'.png')) {
		    	echo '<img src="' .base_url() . $myfile. '.png' .'" alt="" height="81" width="81" class="circular2" />';
		} else {
		if (file_exists($myfile .'.jpg')) {
				echo '<img src="' .base_url() . $myfile. '.jpg' .'" alt="" height="81" width="81" class="circular2" />';
		} else {
		    	echo '<img src="' .base_url(). 'assets/images/person.png" alt="" height="81" width="81" class="circular2" />';
		}
		}
		echo '               <h6>'.$clientname[$project->id][0]->fname .' '.$clientname[$project->id][0]->lname. '</h6>';
        echo '          </div>';
        echo '          <div class="col-xs-12 col-sm-7 col-md-8">';
        echo '               <h4>' .$project->title. '</h4>';
        echo '               <span>Deliver by - ';
		$source = $project->deliverydate;
		$date = new DateTime($source);
		echo $date->format('F j, Y'); 
		echo '</span>';
		echo '               <p>' .$project->description;
		echo '</p>';
        echo '          </div>';
        echo '          <div class="col-xs-12 col-sm-3 col-md-2 budget-project">';
        echo '               <span>Budget: <b>$ ' .$project->budget. '</b></span><br>';
        echo '               <span>Bids: '.$bids[$project->id].' </span><br>';
        echo '               <div class="text-center">';
		echo '					<div id="#accordion">';
        echo '                    <a href="#detailstext'.$project->id.'" class="btn btn-link" data-toggle="collapse" data-parent="#accordion">View Details</a>';
        //echo '<a href="#" data-toggle="modal" data-target="#myModal" class="btn type-c">Apply</a>';
        //echo '<a href="javascript:void(0);" class="btn btn-link close-btn">Close</a>';
		echo '					</div>';
        echo '               </div>';
        echo '          </div>';
        echo '      </div>';
        echo '   </div>';
		
		
        echo '<div class="col-xs-12 col-sm-12 col-md-12 panel-body">';
		echo '  <div id="detailstext'.$project->id.'" class="collapse">';
        echo '        <p class="">' .$project->details. '</p>';
		echo '	</div>';
		echo '</div>';
		
        echo '</div>';
		}
		
		?>
		
</div>
</div>