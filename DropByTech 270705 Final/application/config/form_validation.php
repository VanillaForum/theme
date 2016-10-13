<?php
$config = array(
	/* validation for login page*/
	'signup_form' => array(
			array( 
				'field' => 'fname',
				'label' => 'First Name',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'lname',
				'label' => 'Last Name',
				'rules' => 'trim|required'
			),
			array( 
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|callback__email_unique'
			),
			array( 
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required'
			),
	),
	'login-form' => array(
			array( 
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			),
			array( 
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required'
			)
	),
	'recover-password' => array(
			array( 
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email'
			)
	),
	'cpi-form' => array(
            array(
                'field' => 'fname',
				'label' => 'First Name',
				'rules' => 'trim|required'
            ),
            array(
                'field' => 'lname',
				'label' => 'Last Name',
				'rules' => 'trim|required'
            ),
            array( 
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|callback__email_unique'
			),
            array( 
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'businees_name',
				'label' => 'Business Name',
				'rules' => 'trim|required'
			),
			array( 
				'field' => 'business_url',
				'label' => 'Business URL',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|required'
			),
			array( 
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'about_business',
				'label' => 'About our Business',
				'rules' => 'trim|required'
			),
			array( 
				'field' => 'zipcode',
				'label' => 'Zip Code',
				'rules' => 'trim|required'
			),
    ),
    'upi-form' => array(
            array(
                'field' => 'fname',
				'label' => 'First Name',
				'rules' => 'trim|required'
            ),
            array(
                'field' => 'lname',
				'label' => 'Last Name',
				'rules' => 'trim|required'
            ),
            array( 
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|callback__email_unique'
			),
            array( 
				'field' => 'phone',
				'label' => 'Phone Number',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'businees_name',
				'label' => 'Business Name',
				'rules' => 'trim|required'
			),
			array( 
				'field' => 'business_url',
				'label' => 'Business URL',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim|required'
			),
			array( 
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'about_business',
				'label' => 'About our Business',
				'rules' => 'trim|required'
			),
			array( 
				'field' => 'zipcode',
				'label' => 'Zip Code',
				'rules' => 'trim|required'
			),
    ),
    'creditcard-form' => array(
            array(
                'field' => 'card_name',
				'label' => 'Cardholder Name',
				'rules' => 'trim|required'
            ),
            array(
                'field' => 'card_no',
				'label' => 'Card Number',
				'rules' => 'trim|required'
            ),
            array( 
				'field' => 'security_code',
				'label' => 'Security Code',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'card_month',
				'label' => 'Card Month',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'card_year',
				'label' => 'Card Year',
				'rules' => 'trim|required'
			),
    ),
    'c-form' => array(
            array(
                'field' => 'c_name',
				'label' => 'Certification name',
				'rules' => 'trim|required'
            ),
            array(
                'field' => 'c_authority',
				'label' => 'Certification Authority',
				'rules' => 'trim|required'
            ),
            array( 
				'field' => 'c_licence_no',
				'label' => 'License Number',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'c_url',
				'label' => 'Certification URL',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'c_sdate',
				'label' => 'Start Date',
				'rules' => 'trim|required'
			),
            array( 
				'field' => 'c_edate',
				'label' => 'End Date',
				'rules' => 'trim|required'
			),
        )
);
?>