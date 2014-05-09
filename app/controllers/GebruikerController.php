<?php

class GebruikerController extends BaseController {
	
	public function inloggen()
	{
		return Redirect::route('home');
	}
	
	public function registreren()
	{
	
		$gebruikersnaam = Input::get('gebruikersnaam');
		$wachtwoord = Input::get('wachtwoord');
		$email = Input::get('email');
		
		$gebruiker = new Gebruiker;
		$gebruiker->gebruikersnaam = $gebruikersnaam;
		$gebruiker->wachtwoord = $wachtwoord;
		$gebruiker->email = $email;
		
		$gebruiker->aantal_meldingen= 0;
		
		$gebruiker->geblokkeerd = false;
		
		# Moet automatisch gebeuren
		$gebruiker->type = "gebruiker";
		
		$gebruiker->save();
		
		return Redirect::route('inloggen');
	}

}

?>
