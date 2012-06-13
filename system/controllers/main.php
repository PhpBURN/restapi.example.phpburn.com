<?php
class main extends RestServer {
	public function index() {
    
	}
  
  public function add() {
    $body = array();
    
    $body['message'] = "We're adding something";
    
    $body['item'] = array(
        'name' => 'Klederson Bueno',
        'email' => "klederson@klederson.com"
    );
    
    $this->sendResponse(200, $body);
  }
  
  public function get($id) {
    $status = 200;
    switch ($id) {
      case 1:
          $item = array(
              'name' => 'Klederson Bueno',
              'type' => 'Human'
          );
        break;
      case 2:
          $item = array(
              'name' => 'PhpBURN',
              'type' => 'Framework'
          );
        break;
      default:
          $status = 404;
          $item = array();
        break;
    }
    
    $this->sendResponse($status,$item);
  }
  
  public function delete($id) {
    //accept only gets
    if($this->getMethod() != 'get')
      $this->sendResponse(404);
    
    
    $status = 200;
    $body = array('You are trying to delete user: ' . $id);
    $this->sendResponse($status, $body);
  }
  
  public function editName($id,$name) {
    $status = 200;
    $name = urldecode($name);
    
    $body = array("You are trying to change user's $id name to $name");
    
    $this->sendResponse($status, $body);
  }
}
?>