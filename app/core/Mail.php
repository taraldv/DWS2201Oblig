<?php
class Mail{

	private $email;
	private $sender = 'noreply@tarves.no';
	private $content = '"Content-Type: text/html"';
	private $subject;
	private $body;
	private $url;

	public function __construct($subject,$email,$url){
		$this->subject = $subject;
		$this->email = $email;
		$this->url = $url;
	}

	public function setMailBody($bodyDescription,$token,$linkDescription){
		$this->body = "\"<html><body><p>$bodyDescription</p>
			<a href='https://oblig.tarves.no$this->url?token=$token'>$linkDescription</a>
			</body></html>\"";
	}

	public function sendMail(){
		/* Runs two bash commands, first stores the would be mail body in a temporary file.
		Then a mail command is run with its mail body from the same temporary file */
		$bashStr = 'echo '.$this->body.' > /tmp/mailbody &&
		       	mail -a '.$this->content.' -s "'.$this->subject.'" -r '.$this->sender.' '.$this->email.' < /tmp/mailbody';
		shell_exec($bashStr);
	}
}
