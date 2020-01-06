<?php
class Mail{

	private $email;
	private $sender = 'noreply@tarves.no';
	private $content = '"Content-Type: text/html"';
	private $subject;
	private $body;

	public function __construct($subject,$email){
		$this->subject = $subject;
		$this->email = $email;
	}

	public function setMailBody($bodyDescription,$token,$linkDescription){
		$this->body = "\"<html><body><p>$bodyDescription</p>
			<a href='https://oblig.tarves.no/login/verify/$token'>$linkDescription</a>
			</body></html>\"";
	}

	public function sendMail(){
		$bashStr = 'echo '.$this->body.' > /tmp/mailbody &&
		       	mail -a '.$this->content.' -s "'.$this->subject.'" -r '.$this->sender.' '.$this->email.' < /tmp/mailbody';
		shell_exec($bashStr);
	}
}
