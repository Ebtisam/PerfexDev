<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH. '/third_party/google-api/vendor/autoload.php';
class Googlesheets extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    
/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    
    $client = new Google_Client();
    $client->setApplicationName('Google with PHP');
    $client->setScopes([Google_Service_Drive::DRIVE,Google_Service_sheets::SPREADSHEETS]);
    $client->setAccessType('offline');
    $client->setAuthConfig( __DIR__.'/credentials.json');
    // Load previously authorized token from a file, if it exists.
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
  


    return $client;
}
    public function index()
    {
/*         $data ="";

        $client = new Google_Client();
        $client->setApplicationName('Google Sheets with PHP');
        $client->setScopes([Google_Service_sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig( __DIR__.'/credentials.json');
        $service = new Google_Service_Sheets($client);
        $spreadsheetId = "13ioLGxKTFh1nUEosxVn8iUhHUibqaxJwu6sMyW4zJug";
        $range = "congress!D2:F8";
        $response = $service->spreadsheets_values->get($spreadsheetId,$range);
        $values= $response->getValues();
        $data = [];
        
        if (empty($values))
        {
            print "No data";
        }
        else{
            $mask ="%10s %-10s %s\n";    
            $data = $values;

        }
        $data["data"] = $data;
        $this->load->view('manage',$data);
 */
        //$client->setAuthConfig('client_id.json');

        /*
            $client = new Google_Client();
            $client->setApplicationName('Google with PHP');
            $client->setScopes([Google_Service_Drive::DRIVE,Google_Service_sheets::SPREADSHEETS]);
            $client->setAccessType('offline');
            $client->setAuthConfig( __DIR__.'/credentials.json');
            $drive_service = new Google_Service_Drive($client);
            $optParams = array(
                'pageSize' => 10,
                 'fields' => 'nextPageToken, files(id, name)'
            );
            $files_list = $drive_service->files->listFiles($optParams)->getFiles(); 
            //echo json_encode($files_list);

            $service = new Google_Service_Sheets($client);
            $spreadsheetId = "13ioLGxKTFh1nUEosxVn8iUhHUibqaxJwu6sMyW4zJug";
            $range = "congress!D2:F8";
            $response = $service->spreadsheets_values->get($spreadsheetId,$range);
            $values= $response->getValues();
            $data = [];
            
            if (empty($values))
            {
                print "No data";
            }
            else{
                $mask ="%10s %-10s %s\n";    
                $data = $values;
    
            }
            $data["data"] = $data;
            
            //$data["files"] = json_encode($files_list);
            $data["files"] = ($files_list);
            //var_dump($files_list);
            $myfile = fopen("testfile.txt", "w");
            fwrite($myfile, json_encode($files_list));
            fclose($myfile);
            //$data["files"] = $files_list[0];
            $this->load->view('manage',$data);

          */
          
 // Get the API client and construct the service object.
        $client = new Google_Client();
        $client->setApplicationName('Google with PHP');
        $client->setScopes([Google_Service_Drive::DRIVE,Google_Service_sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig( __DIR__.'/credentials.json');
        $optParams = array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name)'
        );
        $service = new Google_Service_Drive($client);

        // Print the names and IDs for up to 10 files.

        $results = $service->files->listFiles($optParams);
        $data =[];
        if (count($results->getFiles()) == 0) {
            //print "No files found.\n";
        } else {
            //print "Files:\n";
            $files = $results->getFiles();
            foreach ( $files as $file) {
                
                //printf("%s (%s)\n", $file->getName(), $file->getId());
                array_push($data,strval($file->getId()));
           }
        }
        $result["files"] = $data; 
        $this->load->view('manage',$result);


    }

}
