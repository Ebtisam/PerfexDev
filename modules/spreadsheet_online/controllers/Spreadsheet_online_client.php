<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Team password client controller
 */
class Spreadsheet_online_client extends ClientsController
{
  /**
   * __construct
   */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('spreadsheet_online_model');
    }
    /**
     * index 
     * @param  int $page 
     * @param  int $id   
     * @param  string $key  
     * @return view       
     */
      public function index(){  
       if(is_client_logged_in()){
          $data['folder_my_share_tree'] = $this->spreadsheet_online_model->tree_my_folder_share_client();
          $data['title'] = _l('spreadsheet_online');
          $this->data($data);
          $this->view('client_share');
          $this->layout();
        }else{
          redirect(site_url('authentication'));
        }
      } 

      /**
     * get hash client
     * @param int $id 
     * @return json    
     */
    public function get_hash_client($id){
      $rel_id = get_client_user_id();
      $rel_type = 'client';
      echo json_encode($this->spreadsheet_online_model->get_hash($rel_type, $rel_id, $id));
    }

    /**
     * new file view 
     * @param  int $parent_id 
     * @param  int $id        
     * @return  view or json            
     */
    public function file_view_share($hash = ""){
      $data_form = $this->input->post();
      $data['tree_save'] = json_encode($this->spreadsheet_online_model->get_folder_tree());
      
      if($hash != ""){
        $share_child = $this->spreadsheet_online_model->get_share_form_hash($hash);
        $id = $share_child->id_share;
        $file_excel = $this->spreadsheet_online_model->get_file_sheet($id);
        $data['parent_id'] = $file_excel->parent_id;
        $data['role'] = $share_child->role;
        if (($share_child->rel_id != get_client_user_id())) {
              access_denied('spreadsheet_online');
        }
      }else{
        $id = "";
        $data['parent_id'] = "";
        $data['role'] = 1;
      }

      $data_form = $this->input->post();
      if ($this->input->server('REQUEST_METHOD') === 'POST')
      {
        $data_form['doc_type'] = "excel";
      }
      $data['title'] = _l('new_file');
      $data['folder'] = $this->spreadsheet_online_model->get_my_folder_all();
      if($data_form || isset($data_form['id'])){
        if($data_form['id'] == ""){
          $success = $this->spreadsheet_online_model->add_file_sheet($data_form);
          if(is_numeric($success)){
            $message = _l('added_successfully');
            $file_excel = $this->spreadsheet_online_model->get_file_sheet($success);
            echo json_encode(['success' => true, 'message' => $message, 'name_excel' => $file_excel->name ]);
          }
          else{
            $message = _l('added_fail');
            echo json_encode(['success' => false, 'message' => $message]);
          }
        }
      }
      if($id != "" || isset($data_form['id'])){
        if(isset($data_form['id'])){
          if($data_form['id'] != ""){
            $data['id'] = $data_form['id'];
          }
        }else{
          $data['id'] = $id;
          $data['file_excel'] = $this->spreadsheet_online_model->get_file_sheet($data['id']);
          $mystring = $data['file_excel']->data_form;
          $findme   = 'images';
          $pos = strpos($mystring, $findme);
          if($pos){
            $data['data_form'] = str_replace('""', '"', $data['file_excel']->data_form); 
          }else{
            $data['data_form'] = $data['file_excel']->data_form; 
          }
        }

        if($data_form && $data_form['id'] != ""){
          $success = $this->spreadsheet_online_model->edit_file_sheet($data_form);
          if($success == true){
            $message = _l('updated_successfully');
            echo json_encode(['success' => $success, 'message' => $message]);
          }
          else{
            $message = _l('updated_fail');
            echo json_encode(['success' => $success, 'message' => $message]);
          }
        }
      }
      if(!isset($success)){
        $this->data($data);
        $this->view('share_file_view_client');
        $this->layout();
      }
    }

    public function file_word_view_share($hash = ""){
      log_message("error","client_file_word_view_share");
      $data_form = $this->input->post();

      $data['tree_save'] = json_encode($this->spreadsheet_online_model->get_folder_tree());
      
      if($hash != ""){
        log_message("error",$hash);
        $share_child = $this->spreadsheet_online_model->get_share_form_hash($hash);
        $id = $share_child->id_share;
        log_message("error","id share");
        log_message("error",$id);
        $file_excel = $this->spreadsheet_online_model->get_file_sheet($id);
        $data['parent_id'] = $file_excel->parent_id;
        $data['role'] = $share_child->role;
        if (($share_child->rel_id != get_client_user_id())) {
              access_denied('spreadsheet_online');
        }
      }else{
        $id = "";
        $data['parent_id'] = "";
        $data['role'] = 1;
      }

      $data_form = $this->input->post();
      if ($this->input->server('REQUEST_METHOD') === 'POST')
      {
        log_message("error","Post request");
        $data_form['doc_type'] = "word";
        $data_form['data_form'] = $this->input->post('data_form',false);

      }
      $data['title'] = _l('new_file');
      $data['folder'] = $this->spreadsheet_online_model->get_my_folder_all();
      if($data_form || isset($data_form['id'])){
        if($data_form['id'] == ""){
          $success = $this->spreadsheet_online_model->add_file_sheet($data_form);
          if(is_numeric($success)){
            $message = _l('added_successfully');
            $file_excel = $this->spreadsheet_online_model->get_file_sheet($success);
            echo json_encode(['success' => true, 'message' => $message, 'name_excel' => $file_excel->name ]);
          }
          else{
            $message = _l('added_fail');
            echo json_encode(['success' => false, 'message' => $message]);
          }
        }
      }
      if($id != "" || isset($data_form['id'])){
        if(isset($data_form['id'])){
          if($data_form['id'] != ""){
            $data['id'] = $data_form['id'];
          }
        }else{
          $data['id'] = $id;
          $data['file_excel'] = $this->spreadsheet_online_model->get_file_sheet($data['id']);
          $data['data_form'] = $data['file_excel']->data_form; 
          
        }

        if($data_form && $data_form['id'] != ""){
          $success = $this->spreadsheet_online_model->edit_file_sheet($data_form);
          if($success == true){
            $message = _l('updated_successfully');
            echo json_encode(['success' => $success, 'message' => $message]);
          }
          else{
            $message = _l('updated_fail');
            echo json_encode(['success' => $success, 'message' => $message]);
          }
        }
      }
      if(!isset($success)){
        $this->data($data);
        $this->view('share_word_file_view_client');
        $this->layout();
      }
    }

    /**
     * Add edit folder
    */
    public function add_edit_folder_client(){
      if($this->input->post()){
        $data = $this->input->post();    
        if($data['id'] == ''){
          $id = $this->spreadsheet_online_model->add_folder($data);
          if(is_numeric($id)){
            $message = _l('added_successfully');
            set_alert('success', $message);
          }
          else{
            $message = _l('added_fail');
            set_alert('warning', $message);
          }
        }
        else{
          $res = $this->spreadsheet_online_model->edit_folder($data);
          if($res == true){
            $message = _l('updated_successfully');
            set_alert('success', $message);
          }
          else{
            $message = _l('updated_fail');
            set_alert('warning', $message);
          }
        }
        redirect(site_url('spreadsheet_online/spreadsheet_online_client'));
      }    
    }
    
    /**
     * new file view 
     * @param  int $parent_id 
     * @param  int $id        
     * @return  view or json            
     */
    public function file_view_share_related($hash = ""){
      $data_form = $this->input->post();
      $data['tree_save'] = json_encode($this->spreadsheet_online_model->get_folder_tree());
      
      if($hash != ""){
        $share_child = $this->spreadsheet_online_model->get_share_form_hash_related($hash);
        $id = $share_child->parent_id;
        $file_excel = $this->spreadsheet_online_model->get_file_sheet($id);
        $data['parent_id'] = $file_excel->parent_id;
        $data['role'] = $share_child->role;
      }else{
        $id = "";
        $data['parent_id'] = "";
        $data['role'] = 1;
      }

      $data_form = $this->input->post();
      $data['title'] = _l('new_file');
      $data['folder'] = $this->spreadsheet_online_model->get_my_folder_all();
      if($data_form || isset($data_form['id'])){
        if($data_form['id'] == ""){
          $success = $this->spreadsheet_online_model->add_file_sheet($data_form);
          if(is_numeric($success)){
            $message = _l('added_successfully');
            $file_excel = $this->spreadsheet_online_model->get_file_sheet($success);
            echo json_encode(['success' => true, 'message' => $message, 'name_excel' => $file_excel->name ]);
          }
          else{
            $message = _l('added_fail');
            echo json_encode(['success' => false, 'message' => $message]);
          }
        }
      }
      if($id != "" || isset($data_form['id'])){
        if(isset($data_form['id'])){
          if($data_form['id'] != ""){
            $data['id'] = $data_form['id'];
          }
        }else{
          $data['id'] = $id;
          $data['file_excel'] = $this->spreadsheet_online_model->get_file_sheet($data['id']);
          $mystring = $data['file_excel']->data_form;
          $findme   = 'images';
          $pos = strpos($mystring, $findme);
          if($pos){
            $data['data_form'] = str_replace('""', '"', $data['file_excel']->data_form); 
          }else{
            $data['data_form'] = $data['file_excel']->data_form; 
          }
        }

        if($data_form && $data_form['id'] != ""){
          $success = $this->spreadsheet_online_model->edit_file_sheet($data_form);
          if($success == true){
            $message = _l('updated_successfully');
            echo json_encode(['success' => $success, 'message' => $message]);
          }
          else{
            $message = _l('updated_fail');
            echo json_encode(['success' => $success, 'message' => $message]);
          }
        }
      }
      if(!isset($success)){
        $this->data($data);
        $this->view('share_file_view_client');
        $this->layout();
      }
    }

}