<?php
	/**
	 * id
	 * show_close
	 * header
	 * body
	 * footer
	 *
	 */
	if(!function_exists('show_modal'))
	{
		function show_modal($parameters = array())
		{
			return
				'<div class="modal fade" id="'. $parameters['id'] .'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
			            <div class="modal-content">'
							.($parameters['show_close'] ? 
								'<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'
									. $parameters['header']
		                    	.'</div>'
		                    	: '')
		                    .'<div class="modal-body '. $parameters['body_class'] .'">'
								. $parameters['body']
		                    .'</div>
		                    <div class="modal-footer">
		                    	'. (!empty($parameters['footer']) ? $parameters['footer'] : '
				                        <button class="btn btn-theme post-btn" data-dismiss="modal" aria-hidden="true">Close</button>
				                        <input type="button" name="redirect_login" id="redirect_login" value="Ok" class="btn btn-theme">')
		                    .'</div>
			            </div>
				    </div>
				</div>';
		}
	}

	if(!function_exists('ask_login_modal'))
	{
		function ask_login_modal($parameters = array())
		{
			extract($parameters);
			return show_modal(
						array(
							'id' => $id,
							'show_close' => $show_close,
							'header' => $header, 
							'body_class' => $body_class,
							'body' => '<h3 class="login-txt suppliy-detail-text">'. $text .'</h3>'
						)
					);
		}
	}
