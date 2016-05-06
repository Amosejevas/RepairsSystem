<?php
function sendEmail($receiver, $message) {
	$that =& get_instance();
	$config = Array(
        'protocol' => 'smtp',
        'smtp_host' => '*******',
        'smtp_port' => 465,
        'smtp_user' => '***********',
        'smtp_pass' => '***********',
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
    );
    $that->load->library('email', $config);
    $that->email->set_newline("\r\n");
    $that->email->from('**************', '*************');
    $that->email->to($receiver); 
    $that->email->subject('Repair status update');
    $that->email->message("Hello, \n {$message}. \n Sincerely, FixR");  
    $result = $that->email->send();
}
?>