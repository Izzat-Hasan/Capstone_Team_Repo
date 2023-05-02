<?php
Class Help extends Controller{
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }

        $this->HelpModel = $this->model('Help');
    }
    public function index(){
        $Help = $this->HelpModel->getHelp();
        $data = ['Help'=> $Help];
        $this->view('Help/index', $data);
    }

    public function show($id){
        $Help = $this->HelpModel->getHelpById($id);
        $data = [
            'Help' =>$Help,
        ];

        $this->view('Help/show', $data);
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if($this->HelpModel->deleteHelp($id)){
            redirect('Help');
          } else {
            die('Something went wrong');
          }
        } else {
          redirect('Help');
        }
      }
      public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Sanitize post array
          $_post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
            'Help_name' => trim($_post['Help_name']),
            'Help_email' => trim($_post['Help_email']),
            'Help_number' => trim($_post['Help_number']),
            'email_err' => '',
            'name_err' => '',
            'number_err' => ''
   
          ];
  
          // Validate data
          if(empty($data['help_name'])){
            $data['name_err'] = 'Please enter a name';
          }
          if(empty($data['help_number'])){
              $data['number_err'] = 'Please enter a number';
            }
          if(empty($data['help_email'])){
            $data['email_err'] = 'Please enter an email';
          }

  
          // Make sure no errors
          if(empty($data['name_err']) && empty($data['email_err']) && empty($data['number_err'])){
            // Validated
      
            if($this->helpModel->addhelp($data)){
              redirect('Help');
            } else {
              die('Something went wrong');
            }
          } else {
            // Load view with errors
            $this->view('Help/add', $data);
          }
  
        } else {
          $data = [
            'email_err' => '',
            'name_err' => '',
            'number_err' => ''
        
          ];
    
          $this->view('Help/add', $data);
        }
      }
      public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Sanitize post array
          $_post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
          $data = [
               'id' => $id,
              'Help_name' => trim($_post['Help_name']),
              'Help_email' => trim($_post['Help_email']),
              'Help_number' => trim($_post['Help_number']),
              'name_err' => '',
              'email_err' => '',
              'number_err' => ''

            ];
    
  
          // Validate data
          if(empty($data['Help_name'])){
              $data['name_err'] = 'Please enter a Help name name';
          }
          if(empty($data['Help_email'])){
              $data['email_err'] = 'Please enter a Help email';
          }
          if(empty($data['Help_number'])){
          $data['number_err'] = 'Please enter a enter a number';
          }
          
  
          // Make sure no errors
          if(empty($data['name_err']) && empty($data['email_err']) && empty($data['number_err'])){
            // Validated
            if($this->helpModel->updatehelp($data)){
              redirect('Help');          
            } else {
              die('Something went wrong');
            }
            
            
          } else {
            // Loads view with errors
            $this->view('Help/edit', $data);
          }
  
        } else {
          $help = $this->helpModel->getHelpById($id);
  
  
          $data = [
            'id' => $id,
            'help_name' => $help->help_name,
            'help_email' => $help->help_email,
            'help_number' => $help->help_number

          ];
    
          $this->view('Helps/edit', $data);
        }
      }
  
}
?>