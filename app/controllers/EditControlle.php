<?php
use Phalcon\Mvc\View;
class EditController extends ControllerBase{
 
//  public function indexAction(){
// 	if($this->request->isPost()){
//     $id=$this->seeion->get('id');
//     $N1=Event::findFirst("id='$id' ");
//     $N1->name = trim($this->request->getPost('name')); 
//     $N1->date = trim($this->request->getPost('date')); 
//     $N1->detail=trim($this->request->getPost('detail')); 
//     $N1->picture=trim($this->request->getPost('file'));
//     $N1->save();
//     $this->response->redirect('event');
//   }
  public function editAction(){
    if($this->request->isPost()){
      $name = trim($this->request->getPost('name')); // รับค่าจาก form
      $date = trim($this->request->getPost('date')); // รับค่าจาก form
      $detail = trim($this->request->getPost('detail')); // รับค่าจาก form
      $picture = trim($this->request->getPost('file')); 
      $id=$this->session->get('id');
      $event=Event::findFirst("id = '$id'");
      $event->id=$this->session->get('memberAuthen');
      $event->name=$name;
      $event->date=$date;
      $event->detail=$detail;
      $event->picture=$picture;
      $event->save();
      $this->response->redirect('event');
      }

      public function setIDAction($temp){
        $this->session->set('event',$temp);
        $this->response->redirect('edit');    
      }
      public function deleteIDAction($temp){
        $event = Event::findFirst($temp);
        $event->delete();
        $this->response->redirect('event');    
      }

}

