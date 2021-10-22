<?php


namespace App\Controllers;
use App\Models\dataTableModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Files\UploadedFile;

class Datatable extends Controller
{
    private $table ;

    function __construct(){
        $this->table = new dataTableModel;
    }

    public function index()
    {
        $data = $this->request->getPost();
        $tableData = $this->table->dataTable($data);
        
    }

    public function addrecord(){

        $data = $this->request->getPost();
        $userData = $this->table->savaData($data);
        echo json_encode($userData);
    }

    public function editrecord(){
        $userId = $this->request->getPost();
        $userData = $this->table->userData($userId);
        echo(json_encode($userData));
    }

    public function updaterecord(){
        $updataData = $this->request->getPost();
        $data = array(
            'name' => $updataData['name'],
            'email' => $updataData['email'],
            'phone' => $updataData['phone'],
            'age' => $updataData['age'],
            'gender' => $updataData['gender'],
            'address' => $updataData['address']
        );
        $getUserData = $this->table->updateData($updataData['id'],$data);
        echo(json_encode($getUserData));
    }

    public function deleterecord(){
        $deleteData = $this->request->getPost();
        $deletemsg = $this->table->deleteData($deleteData);
        return $deletemsg;
    }


    public function uploadpic(){
        return view('pages/upload');
    }

    // public function image(){
    //     $file = $this->request->getFile('image');
    //     if ($file->isValid() && ! $file->hasMoved()) {
    //         $imageName = $file->getRandomName();
    //         $file->move('uploads/', $imageName);
    //     }

    //     $data = [
    //         'name' => $this->request->getPost('name')


    //     ];



        


        

    // }



   
}










?>