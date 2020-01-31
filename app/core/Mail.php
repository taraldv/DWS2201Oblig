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
		//Sender to kommandoer til bash, første lagrer string i $body i en temp fil.
		//Så sendes denne filen med som body i mail kommando med < 
		$bashStr = 'echo '.$this->body.' > /tmp/mailbody &&
		       	mail -a '.$this->content.' -s "'.$this->subject.'" -r '.$this->sender.' '.$this->email.' < /tmp/mailbody';
		shell_exec($bashStr);
	}
}
