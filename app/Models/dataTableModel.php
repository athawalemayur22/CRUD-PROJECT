<?php

namespace App\Models;

use CodeIgniter\CLI\Console;
use CodeIgniter\Model;


class dataTableModel extends Model
{
    public function dataTable($postData){

        $fieldNamesArr = array(
            '',
            'id',
            'name',
            'email',
            'phone',
            'age',
            'gender',
            'address',
            ''
        );
    $draw = $postData['draw'];
    $start = $postData['start'];
    $rowperpage = $postData['length']; // Rows display per page
    $columnIndex = $postData['order'][0]['column']; // Column index
    $columnName = $postData['columns'][$columnIndex]['data']; // Column name
    $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
    $searchValue = $postData['search']['value']; // Search value
    ## Get the actual column name for sorting
    $columnName = $fieldNamesArr[$columnName];

    ## Search
    $searchQuery = "";
    if ($searchValue != '') {
        $searchQuery = " (name like '%" . $searchValue . "%' or
        email like '%" . $searchValue . "%' or 
        phone like '%" . $searchValue . "%' or
        age like '%" . $searchValue . "%' or
        address like '%" . $searchValue . "%' or
        id like '%" . $searchValue. "%'
        ) ";
    }

    ## Total number of records without filtering
    $builder = $this->db->table('students');
    $query   = $builder->get()->getResult();
    $totalRecords = count($query);
   
    ## Total number of record with filtering
    $builder = $this->db->table('students');
    if ($searchQuery != '') {
        $builder->where($searchQuery);
    }
    $query   = $builder->get()->getResult();
    $totalRecordwithFilter = count($query);

    ## Fetch records
    $builder = $this->db->table('students');
    if ($searchQuery != '') {
        $builder->where($searchQuery);
    }
    $builder->orderBy($columnName, $columnSortOrder);
    if ($rowperpage > 0) {
        $builder->limit($rowperpage);
    }
    $query   = $builder->get()->getResult();
    $finalData = array();
    foreach ($query as $row){
        $data = array();
        $data[] = '<a href="javascript:void(0);" class="btn btn-primary" onclick="edit('.$row->id.')">Edit</a>';
        $data[] = $row->id;
        $data[] = $row->name;
        $data[] = $row->email;
        $data[] = $row->phone;
        $data[] = $row->age;
        $data[] = $row->gender;
        $data[] = $row->address;
        $data[] = '<img src="" style="width:50px;height:50px;"/>';
        $data[] = '<a href="javascript:void(0);" class="btn btn-danger" id="deleteBtn" onclick="deleteData('.$row->id.')">Delete</a>';
        $finalData[] = $data;
    }
   
    $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "data" => $finalData,
    );
    echo json_encode($response);
    }

    public function savaData($data){

        $result = $this->db->table('students')
                ->insert($data);
        return $result;
    }

    public function userData($userId){
        $builder = $this->db->table('students');
        $builder->where('id', $userId);
        $query   = $builder->get()->getRow(); 
        return $query;
    }

    public function updateData($userId,$data){
        $builder = $this->db->table('students');
        $builder->where('id',$userId);
        $query = $builder->update($data);
        return $query;
    }

    public function deleteData($deleteData){
        $builder = $this->db->table('students');
        $builder->where('id',$deleteData);
        $query = $builder->delete();
        print_r($query);

    }
   
}

?>