<?php
// Start session
require APPPATH. '/third_party/google-api/vendor/autoload.php';

//session_start();

class User_Authentication extends AdminController {

public function __construct() {
parent::__construct();
}

public function index() {

// Include two files from google-php-client library in controller
//include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
//include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";


// Store values in variables from project created in Google Developer Console
//$client_id = '< Generated Client Id >';
//$client_secret = '< Generated Client secret Key >';
$redirect_uri = admin_url('googlesheets/re');
//$simple_api_key = '< Generated Server/API Key >';

// Create Client Request to access Google API
$client = new Google_Client();
$client->setApplicationName("PHP Google OAuth Login Example");
$client->setAuthConfig('credentials.json');
$client->setRedirectUri($redirect_uri);
$client->addScope("Google_Service_Drive::DRIVE");

// Send Client Request
$objOAuthService = new Google_Service_Oauth2($client);

// Add Access Token to Session
if (isset($_GET['code'])) {
$client->authenticate($_GET['code']);
$_SESSION['access_token'] = $client->getAccessToken();
header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

// Set Access Token to make Request
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
$client->setAccessToken($_SESSION['access_token']);
}

// Get User Data from Google and store them in $data
if ($client->getAccessToken()) {
$userData = $objOAuthService->userinfo->get();
$data['userData'] = $userData;
$_SESSION['access_token'] = $client->getAccessToken();
} else {
$authUrl = $client->createAuthUrl();
$data['authUrl'] = $authUrl;
}
// Load view and send values stored in $data
$this->load->view('google_authentication', $data);
}

// Unset session and logout
public function logout() {
unset($_SESSION['access_token']);
redirect(base_url());
}
}
?>