<?php
require  'vendor/autoload.php';
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/my_secret.json');

function sheets_add($user_id, $user_name){
	$client = new Google_Client;
				try{
					$client->useApplicationDefaultCredentials();
				  $client->setApplicationName("Something to do with my representatives");
					$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
				   if ($client->isAccessTokenExpired()) {
						$client->refreshTokenWithAssertion();
					}

					$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
					ServiceRequestFactory::setInstance(
						new DefaultServiceRequest($accessToken)
					);
				   // Get our spreadsheet
					$spreadsheet = (new Google\Spreadsheet\SpreadsheetService)
						->getSpreadsheetFeed()
						->getByTitle('MyTable');

					// Get the first worksheet (tab)
					$worksheets = $spreadsheet->getWorksheetFeed()->getEntries();
					$worksheet = $worksheets[0];


					$listFeed = $worksheet->getListFeed();
					$listFeed->insert([
						'id' => "'". "{$user_id}",
						'name' => "'". "{$user_name}",
						'step' => "'". 'menu',
						'score' => "'". '1'
					]);

				}catch(Exception $e){
				  echo $e->getMessage() . ' ' . $e->getLine() . ' ' . $e->getFile() . ' ' . $e->getCode;
				}
}

function sheets_check($user_id, $user_name){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);
// The A1 notation of the values to retrieve.
$range = 'A2:E'; 
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
// The ID of the spreadsheet to retrieve data from.
// TODO: Update placeholder value.
// The A1 notation of the values to retrieve.
 // TODO: Update placeholder value.
$values = $response->getValues();
$a=0;
foreach ($values as $row){
	$value = $row[0];
	if($value==$user_id)$a=$a+1;
}
if($a==0) sheets_add($user_id, $user_name);
}


function sheets_accept(){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);
// The A1 notation of the values to retrieve.
$range = 'A2:E'; 
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
// The ID of the spreadsheet to retrieve data from.
// TODO: Update placeholder value.
// The A1 notation of the values to retrieve.
 // TODO: Update placeholder value.
$values = $response->getValues();
$a=0;
foreach ($values as $row){
	$a=$a+1;
	$value = $value . $a . ") " . $row[0] . " \n" ;
}
return $value;
}

function sheets_return($user_id){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);
// The A1 notation of the values to retrieve.
$range = 'A2:E'; 
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
// The ID of the spreadsheet to retrieve data from.
// TODO: Update placeholder value.
// The A1 notation of the values to retrieve.
 // TODO: Update placeholder value.
$values = $response->getValues();
$a=0;
foreach ($values as $row){
	$a=$a+1;
	if($row[0]==$user_id)$value = $a;
}
$value = $value + 1;	
return $value;
}


function check_step($user_id){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);
// The A1 notation of the values to retrieve.
$range = 'A2:E'; 
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
// The ID of the spreadsheet to retrieve data from.
// TODO: Update placeholder value.
// The A1 notation of the values to retrieve.
 // TODO: Update placeholder value.
$values = $response->getValues();
foreach ($values as $row){
	if($row[0]==$user_id)$value = $row[2];
}
return $value;
}

function view_score($user_id){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);
// The A1 notation of the values to retrieve.
$range = 'A2:E'; 
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
// The ID of the spreadsheet to retrieve data from.
// TODO: Update placeholder value.
// The A1 notation of the values to retrieve.
 // TODO: Update placeholder value.
$values = $response->getValues();
foreach ($values as $row){
	if($row[0]==$user_id)$value = $row[3];
}
return $value;
}

function album_view($user_id){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);
// The A1 notation of the values to retrieve.
$range = 'A2:E'; 
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
// The ID of the spreadsheet to retrieve data from.
// TODO: Update placeholder value.
// The A1 notation of the values to retrieve.
 // TODO: Update placeholder value.
$values = $response->getValues();
foreach ($values as $row){
	if($row[0]==$user_id)$value = $row[4];
}
return $value;
}

function update_score($num, $score){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);

// The ID of the spreadsheet to update.
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.

// The A1 notation of the values to update.
$range = "D". $num;  // TODO: Update placeholder value.
// TODO: Assign values to desired properties of `requestBody`. All existing
// properties will be replaced:
$score = $score + 1;
  $values =[
    [
      $score
    ]
  ];
	
$requestBody = new Google_Service_Sheets_ValueRange([
	'values' => $values
]);
$params = ['valueInputOption' => 'RAW'];

$response = $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, $params);
}


function battle($user_id, $enemy_id){
	$user_num = sheets_return($user_id);
	$enemy_num = sheets_return($enemy_id);
	$user_score=view_score($user_id);
	$enemy_score=view_score($enemy_id);
	$score=$user_score+$enemy_score;
	$coef=($enemy_score/$score)*100;
	$coef=round($coef);
	$win=rand(0, 100);
	$border=100-$coef;
	if($win>=$border){
		$winner_num=$user_num;
		$winner_id=$user_id;
		$score=$user_score;
	}
	else{
		$winner_num=$enemy_num;
		$winner_id=$enemy_id;
		$score=$enemy_score;
	}
	update_score($winner_num, $score);
	return $winner_id;
}


function sheets_update_step($num, $step){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);

// The ID of the spreadsheet to update.
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.

// The A1 notation of the values to update.
$range = "C". $num;  // TODO: Update placeholder value.
// TODO: Assign values to desired properties of `requestBody`. All existing
// properties will be replaced:
  $values =[
    [
      $step
    ]
  ];
	
$requestBody = new Google_Service_Sheets_ValueRange([
	'values' => $values
]);
$params = ['valueInputOption' => 'RAW'];

$response = $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, $params);
}


function sheets_update_album($num, $album){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);

// The ID of the spreadsheet to update.
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.

// The A1 notation of the values to update.
$range = "E". $num;  // TODO: Update placeholder value.
// TODO: Assign values to desired properties of `requestBody`. All existing
// properties will be replaced:
  $values =[
    [
      $album
    ]
  ];
	
$requestBody = new Google_Service_Sheets_ValueRange([
	'values' => $values
]);
$params = ['valueInputOption' => 'RAW'];

$response = $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, $params);
}


function check_id($enemy_id, $user_id){
$client = new Google_Client;
$client->useApplicationDefaultCredentials();
			  $client->setApplicationName("Something to do with my representatives");
				$client->setScopes(['https://www.googleapis.com/auth/drive','https://spreadsheets.google.com/feeds']);
			   if ($client->isAccessTokenExpired()) {
					$client->refreshTokenWithAssertion();
				}
				$accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
				ServiceRequestFactory::setInstance(
					new DefaultServiceRequest($accessToken)
				);
$service = new Google_Service_Sheets($client);
// The A1 notation of the values to retrieve.
$range = 'A2:E'; 
$spreadsheetId = '[айди таблицы]';  // TODO: Update placeholder value.
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
// The ID of the spreadsheet to retrieve data from.
// TODO: Update placeholder value.
// The A1 notation of the values to retrieve.
 // TODO: Update placeholder value.
$values = $response->getValues();
$value = 0;
foreach ($values as $row){
	if($row[0]==$enemy_id){
		if($row[0]==$user_id){
			$value = 1;
		}
		else{
			$value = $row[0];
		}
	}
}
return $value;
}



function rand_photo($pub, $album, $service_token){
	$photo_list = json_decode(file_get_contents("https://api.vk.com/method/photos.get?owner_id={$pub}&album_id={$album}&count=1000&access_token={$service_token}&v=5.0"),true);
	$photo_list = $photo_list['response']['items'];
	$photo_id = array_rand($photo_list, 1);
	$photo_list = $photo_list["{$photo_id}"];
	$photo_id = $photo_list['id'];
	return $photo_id;
}
function rand_album($num, $albums){
	$rand_key = array_rand($albums, 1);
	$album = $albums[$rand_key];
	sheets_update_album($num, $album);
	return $album;
}

if (!isset($_REQUEST)) { 
return; 
} 
//Строка для подтверждения адреса сервера из настроек Callback API 
$confirmation_token = '[токен маленький]'; 
$service_token = '[токен сервисного standalon-приложения]'; 
//Ключ доступа сообщества 
$token = '[токен сообщества вк]'; 
$pub = '-[айди группы]';
// Получаем и декодируем уведомление
$data = json_decode(file_get_contents('php://input')); 

$albums = array( //идентификаторы альбома
	    "Hosok"    => "267530149",
	    "Jin"  => "270338913",
	    "V"  => "270338309",
	    "RM"  => "270378326",
	    "Suga"  => "270378319",
	    "Chonguk"  => "270378338",
	    "Jimin"  => "270378346",
	);



$keyboard_menu = [
  'one_time' => false,
  'buttons' => [
    [
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "1"}',
          'label' => 'Начать играть',
        ],
        'color' => 'primary',
      ],
    ],
    [
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "2"}',
          'label' => 'Смотреть фотачки',
        ],
        'color' => 'default',
      ],
    ],
    [
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "3"}',
          'label' => 'Посмотреть мой счёт',
        ],
        'color' => 'default',
      ],
    ],
  ],
];

$keyboard_photo = [
  'one_time' => false,
  'buttons' => [
    [
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "1"}',
          'label' => 'Чимин',
        ],
        'color' => 'default',
      ],
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "2"}',
          'label' => 'Jin',
        ],
        'color' => 'default',
      ],
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "3"}',
          'label' => 'Чонгук',
        ],
        'color' => 'default',
      ],
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "4"}',
          'label' => 'RM',
        ],
        'color' => 'default',
      ],
    ],
    [
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "5"}',
          'label' => 'Suga',
        ],
        'color' => 'default',
      ],
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "6"}',
          'label' => 'J-Hope',
        ],
        'color' => 'default',
      ],
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "7"}',
          'label' => 'V',
        ],
        'color' => 'default',
      ],
    ],
    [
      [
        'action' =>  
        [
          'type' => 'text',
          'payload' => '{"button": "8"}',
          'label' => 'Вернуться в меню',
        ],
        'color' => 'primary',
      ],
    ],
  ],
];

//Проверяем, что находится в поле "type" 
switch ($data->type) { 
//Если это уведомление для подтверждения адреса... 
case 'confirmation': 
//...отправляем строку для подтверждения 
echo $confirmation_token; 
break;
//новое сообщение
case 'message_new':
$peer_id = $data->object->peer_id;
$user_id = $data->object->from_id; 
$message = $data->object->text;
$body = $data->object->body; 
$from_id = $data->object->from_id;		
// через users.get получаем данные об авторе
$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&access_token={$token}&v=5.0")); 
$user_name = $user_info->response[0]->first_name;
sheets_check($user_id, $user_name);
if($peer_id>2000000000){
    $word = explode(" ", $message);
    if($word[0]=='Бот'||$word[0]=='БОТ'||$word[0]=='бот'){
	    if($word[1]=='айди'){
	    	$request_params = array( 
		'message' => "{$user_id}", 
		'peer_id' => $peer_id, 
		'access_token' => $token, 
		'v' => '5.80'
		 );
	    }
	    elseif($word[1]=='битва'){
		$enemy_id = explode("*", $word[2]);
		$enemy_id = $enemy_id[0];
		$delete = array("[id", "|");
		$enemy_id = str_replace($delete, "", $enemy_id);
		$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$enemy_id}&access_token={$token}&v=5.0"));
		$enemy_name = $user_info->response[0]->first_name;
		$enemy_id=check_id($enemy_id, $user_id);
		if($enemy_id==0){
			$request_params = array( 
			'message' => "Этот пользователь ничего не писал ещё", 
			'peer_id' => $peer_id, 
			'access_token' => $token, 
			'v' => '5.80'
			 );
		}
		elseif($enemy_id==1){
			$request_params = array( 
			'message' => "Вы не можете драться сами с собой", 
			'peer_id' => $peer_id, 
			'access_token' => $token, 
			'v' => '5.80'
			 );
		}
		else{
			$winner_id=battle($user_id, $enemy_id);
			$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$winner_id}&access_token={$token}&v=5.0"));
			$winner_name = $user_info->response[0]->first_name;
			$winner_score=view_score($winner_id);
			$request_params = array( 
			'message' => "{$user_name} бросает вызов @id{$enemy_id}({$enemy_name}) \n И побеждает {$winner_name}! \n\n Его баллы: {$winner_score}", 
			'peer_id' => $peer_id, 
			'access_token' => $token, 
			'v' => '5.80'
			 );
		}
	    }
	    elseif($word[1]=='имя'){
	    	$request_params = array( 
		'message' => "{$user_name}", 
		'peer_id' => $peer_id, 
		'access_token' => $token, 
		'v' => '5.80'
		 );
	    }
	    elseif($word[1]=='команды'){
	    	$request_params = array( 
		'message' => "Бот битва [ссылка на противника]", 
		'peer_id' => $peer_id, 
		'access_token' => $token, 
		'v' => '5.80'
		 );
	    }
	    else{
		$request_params = array( 
		'message' => "Непонимаю, напищи 'Бот команды'", 
		'peer_id' => $peer_id, 
		'access_token' => $token, 
		'v' => '5.80'
		 );
	    }
    }
}
else{
// Вытаскиваем имя отправителя
$user_step = check_step($user_id);
// через users.get получаем данные об авторе
// Через messages.send используя токен сообщества отправляем ответ
if($user_step == 'menu'){
	if ($message == 'Команды' || $message == 'команды') {
		$request_params = array( 
		    'message' => "ТАЙТЛ, PR, ОШИБКИ В ПЕРЕВОДЕ, ДРУГОЕ, ЛОЛ", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80'
		     );
	 }
	elseif ($message == 'ЛОЛ') {
		$value = sheets_accept(); 
		$request_params = array( 
		    'message' => "ID: \n {$value}", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80'
		     );
	 }	
	elseif ($message == 'Посмотреть мой счёт') {
		    $score=view_score($user_id);
		    $request_params = array( 
		    'message' => "Ваш счёт: {$score}", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80'
		     );
	 }
	elseif ($message == 'PR') {
		$album = '267530149';
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'Начать играть') {
		    $num = sheets_return($user_id);
		    $step = "game";
		    sheets_update_step($num, $step);
		    $album = rand_album($num, $albums);
		    $photo_id = rand_photo($pub, $album, $service_token);
		    $request_params = array( 
		    'message' => "Окей, давай начнём, я показываю тебе картинку, а ты угадываешь, кто на ней.\n \n Кто на этой фотке?", 
		    'peer_id' => $peer_id, 
	 	    'attachment'    => "photo{$pub}_{$photo_id}",
		    'access_token' => $token, 
		    'v' => '5.80',
	            'keyboard' => json_encode($keyboard_photo)
		     );
	 }
	elseif ($message == 'Смотреть фотачки') {
		    $num = sheets_return($user_id);
		    $step = "photo";
		    sheets_update_step($num, $step);
		    $request_params = array( 
		    'message' => "Ну смотри...", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80',
	            'keyboard' => json_encode($keyboard_photo)
		     );
	 }
	 else {
		    $request_params = array( 
		    'message' => "Такой команды нет...", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80',
	            'keyboard' => json_encode($keyboard_menu)
		     );
	 }
}
elseif ($user_step == 'game'){
	$score=view_score($user_id);
	$album = album_view($user_id);
	$num = sheets_return($user_id);
	if ($message == 'J-Hope') {
		if($album==$albums["Hosok"]){
			    update_score($num, $score);
			    $score=view_score($user_id);
			    $album = rand_album($num, $albums);
		    	    $photo_id = rand_photo($pub, $album, $service_token);
			    $request_params = array( 
			    'message' => "Да! Это Джей-Хоуп! \n Ваши баллы: {$score} \n \n Следующая картинка!",
			    'attachment'   => "photo{$pub}_{$photo_id}",	    
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
		    else{
			    $request_params = array( 
			    'message' => "Нет, это не Хоуп.", 
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
	 }
	elseif ($message == 'V') {
		    if($album==$albums["V"]){
			    update_score($num, $score);
			    $score=view_score($user_id);
			    $album = rand_album($num, $albums);
		    	    $photo_id = rand_photo($pub, $album, $service_token);
			    $request_params = array( 
			    'message' => "Молодец! \n Ваши баллы: {$score} \n \n Следующая картинка!",
			    'attachment'    => "photo{$pub}_{$photo_id}",	    
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
		    else{
			    $request_params = array( 
			    'message' => "Нет, это не Ви.", 
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
	 }
	elseif ($message == 'RM') {
		    if($album==$albums["RM"]){
			    update_score($num, $score);
			    $score=view_score($user_id);
			    $album = rand_album($num, $albums);
		    	    $photo_id = rand_photo($pub, $album, $service_token);
			    $request_params = array( 
			    'message' => "Молодец! Это реп монстр! \n Ваши баллы: {$score} \n \n Следующая картинка!",
			    'attachment'    => "photo{$pub}_{$photo_id}",	    
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
		    else{
			    $request_params = array( 
			    'message' => "Нет, это не РМ.", 
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
	 }
	elseif ($message == 'Suga') {
		    if($album==$albums["Suga"]){
			    update_score($num, $score);
			    $score=view_score($user_id);
			    $album = rand_album($num, $albums);
		    	    $photo_id = rand_photo($pub, $album, $service_token);
			    $request_params = array( 
			    'message' => "Правильно, Юнги! \n Ваши баллы: {$score} \n \n Следующая картинка!",
			    'attachment'   => "photo{$pub}_{$photo_id}",	    
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
		    else{
			    $request_params = array( 
			    'message' => "Нет, это не Юнги.", 
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
	 }
	elseif ($message == 'Jin') {
		    if($album==$albums["Jin"]){
			    update_score($num, $score);
			    $score=view_score($user_id);
			    $album = rand_album($num, $albums);
		    	    $photo_id = rand_photo($pub, $album, $service_token);
			    $request_params = array( 
			    'message' => "Это Джин! \n Ваши баллы: {$score} \n \n Следующая картинка!",
			    'attachment'   => "photo{$pub}_{$photo_id}",	    
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
		    else{
			    $request_params = array( 
			    'message' => "Нет, это не Джин.", 
			    'peer_id' => $user_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
	 }
	elseif ($message == 'Чонгук') {
		    if($album==$albums["Chonguk"]){
			    update_score($num, $score);
			    $score=view_score($user_id);
			    $album = rand_album($num, $albums);
		    	    $photo_id = rand_photo($pub, $album, $service_token);
			    $request_params = array( 
			    'message' => "Конечно, это Чонгук! \n Ваши баллы: {$score} \n \n Следующая картинка!",
			    'attachment'   => "photo{$pub}_{$photo_id}",	    
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
		    else{
			    $request_params = array( 
			    'message' => "Увы, но это не Чонгук(", 
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
	 }
	elseif ($message == 'Чимин') {
		    if($album==$albums["Jimin"]){
			    update_score($num, $score);
			    $score=view_score($user_id);
			    $album = rand_album($num, $albums);
		    	    $photo_id = rand_photo($pub, $album, $service_token);
			    $request_params = array( 
			    'message' => "Да! Это Чимин! \n Ваши баллы: {$score} \n \n Следующая картинка!",
			    'attachment'   => "photo{$pub}_{$photo_id}",	    
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
		    else{
			    $request_params = array( 
			    'message' => "К сожалению, но это не Чимин...", 
			    'peer_id' => $peer_id, 
			    'access_token' => $token, 
			    'v' => '5.80',
			     );
		    }
	 }
	elseif ($message == 'Вернуться в меню') {
		    $num = sheets_return($user_id);
		    $step = "menu";
		    sheets_update_step($num, $step);
		    $request_params = array( 
		    'message' => "Отдахни.", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80',
	            'keyboard' => json_encode($keyboard_menu)
		     );
	 }
	else {
		    $request_params = array( 
		    'message' => "Непонямэ", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80',
		     );
	 }
}
elseif ($user_step == 'photo'){
	if ($message == 'J-Hope') {
		$album = $albums["Hosok"];
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  //'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'V') {
		    $album = $albums["V"];
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  //'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'RM') {
		    $album = $albums["RM"];
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  //'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'Suga') {
		    $album = $albums["Suga"];
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  //'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'Jin') {
		    $album = $albums["Jin"];
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  //'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'Чонгук') {
		    $album = $albums["Chonguk"];
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  //'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'Чимин') {
		    $album = $albums["Jimin"];
		$photo_id = rand_photo($pub, $album, $service_token);
		$request_params = array( 
		  //'message' => "{$photo_id}",
		  'peer_id' => $peer_id,
		  'attachment'    => "photo{$pub}_{$photo_id}",
		  'access_token'  => $token,
		  'v'             => '5.80'
		);
	 }
	elseif ($message == 'Вернуться в меню') {
		    $num = sheets_return($user_id);
		    $step = "menu";
		    sheets_update_step($num, $step);
		    $request_params = array( 
		    'message' => "Ладно, потом насмотришься.", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80',
	            'keyboard' => json_encode($keyboard_menu)
		     );
	 }
	else {
		    $request_params = array( 
		    'message' => "Непонямэ", 
		    'peer_id' => $peer_id, 
		    'access_token' => $token, 
		    'v' => '5.80'
		     );
	 }
}
}
$get_params = http_build_query($request_params); 
file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
echo('ok'); 
break;
} 
?>
