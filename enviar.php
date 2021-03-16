<?php

$nombre=$_POST["nombre"];
$correo=$_POST["email"];
$asunto=$_POST["asunto"];
$mensaje=$_POST["mensaje"];
echo "El nombre es: ".$nombre." <br>Destinatario: ".$destinatario."<br>Asunto: ".$asunto."<br>Mensaje: ".$mensaje;

$body = [
	    'Messages' => [
	        [
	        'From' => [
	            'Email' => "noreply@latinscorts.com",
	            'Name' => "$nombre"
	        ],
	        'To' => [
	            [
	            'Email' => "$correo",
	            'Name' => "$nombre"
	            ]
	        ],
	        'Subject' => "$asunto",
	        'HtmlPart'=> "<center><span style='font-size: medium;''>&iexcl;Alguien quiere decirte algo!</span></center><center>
<div>&nbsp;</div>
<div>
<p>$mensaje</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Att:$nombre</p>
<p>&copy; 2021 - Ojitos</p>
<span style='font-size: small;''><span style='font-size: small;''><!-- [if mso | IE]><table align='center' border='0' cellpadding='0' cellspacing='0' role='presentation' ><tr><td><![endif]--></span></span></div>
</center>",      
		        ]
		    ]
		];
		
		 
		$ch = curl_init();
		 
		curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json')
		);
		curl_setopt($ch, CURLOPT_USERPWD, "17c8f231ebb6fea3415b8cfeb318647c:6c90d16bf56d715caace8d4a8878f33d");
		$server_output = curl_exec($ch);
		curl_close ($ch);
		 
		$response = json_decode($server_output);
		if ($response->Messages[0]->Status == 'success') {
			echo "<h1>Mensaje enviado correctamente</h1>";
			header("Refresh:5; url=/");
		   	return 1;
		}else{
			return 0;
		}

	?>