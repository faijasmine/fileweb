<?php
 
class ProfileController extends ControllerBase {

   public function beforeExecuteRoute(){ // function ที่ทำงานก่อนเริ่มการทำงานของระบบทั้งระบบ
	  $this->checkAuthen();
   } 
	 	
 
  public function indexAction(){
	   if($this->request->isPost()){

	   $photoUpdate='';//upload photo
	   if($this->request->hasFiles() == true){
		   	$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
			$uploads = $this->request->getUploadedFiles(); //$_FILES['photo'];
		
				$isUploaded = false;			
				foreach($uploads as $upload){
					if(in_array($upload->gettype(), $allowed)){					
					 $photoName=md5(uniqid(rand(), true)).strtolower($upload->getname());
					 $path = '../public/img/'.$photoName;
					 ($upload->moveTo($path)) ? $isUploaded = true : $isUploaded = false;
					}
				}
							 
				if($isUploaded)  $photoUpdate=$photoName ;
		}else
				 die('You must choose at least one file to send. Please try again.');
 	
	  $profileId = trim($this->request->getPost('profileId'));
      $email = trim($this->request->getPost('email')); // รับค่าจาก form     
	  $firstname = trim($this->request->getPost('firstname')); // รับค่าจาก form 
	  
	  $profileObj = user::findFirst($profileId);
	  //$profileObj = new User(); insert data
	  $profileObj->username=$email;
	  $profileObj->first_name=$firstname;
	  $profileObj->picture=$photoUpdate;
	  $profileObj->save();
	 // $profileObj->delete(); delete data
   } 
   else
   $profileId= $this->session->get('memberAuthen');//$_SESSION['memberAuther'];	 
   $profile=user::findFirst($profileId);
   $this->view->profile=$profile;
  }	
}