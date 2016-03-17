<?php

$jsonstr = '{"a": "GET_CHECKIN_DATA",
						"locationId": 8069472,
						"inDay": 1,
						"inMonth": 7,
						"inYear": 2016,
						"outDay": 9,
						"outMonth": 7,
						"outYear": 2016,
						"desktop": "true",
						"mode": "DESKTOP_DETAIL",
						"numOfGuests": 2,
						"use2015Template":"true"}';

		$data = json_decode($jsonstr ,true);

		$data_url = http_build_query ($data);
		$data_url = str_replace("amp;","",$data_url); //fix for &amp; to &


		$data_len = strlen ($data_url);
		$url      = 'https://www.tripadvisor.es/VacationRentalsAjax';

		@$result =  file_get_contents ($url, false, 
		    stream_context_create (
		        array ('http'=>
		            array (
		            	'method'=>'POST',
		            	'header'=>"Connection: close\r\nContent-Length: $data_len\r\n",
		            	'content'=>$data_url
		            )
		        )
		    )
		);
		
		print_r($result);
