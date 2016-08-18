<?php
$config['mandrill_api_key'] = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
/**
 * //In some controller, far far away

$this->load->config('mandrill');

$this->load->library('mandrill');

$mandrill_ready = NULL;

try {

$this->mandrill->init( $this->CI->config->item('mandrill_api_key') );
$mandrill_ready = TRUE;

} catch(Mandrill_Exception $e) {

$mandrill_ready = FALSE;

}

if( $mandrill_ready ) {

//Send us some email!
$email = array(
'html' => '<p>This is my message<p>', //Consider using a view file
'text' => 'This is my plaintext message',
'subject' => 'This is my subject',
'from_email' => 'me@ohmy.com',
'from_name' => 'Me-Oh-My',
'to' => array(array('email' => 'joe@example.com' )) //Check documentation for more details on this one
//'to' => array(array('email' => 'joe@example.com' ),array('email' => 'joe2@example.com' )) //for multiple emails
);

$result = $this->mandrill->messages_send($email);

}
 */