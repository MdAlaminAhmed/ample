<?php
require_once '../init.php';

// Enable error logging for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    ## Read value
    $draw = isset($_POST['draw']) ? $_POST['draw'] : 1;
    $row = isset($_POST['start']) ? $_POST['start'] : 0;
    $rowperpage = isset($_POST['length']) ? $_POST['length'] : 10; // Rows display per page
    $columnIndex = isset($_POST['order'][0]['column']) ? $_POST['order'][0]['column'] : 1; // Column index (default to second column)
    $columnName = isset($_POST['columns'][$columnIndex]['data']) ? $_POST['columns'][$columnIndex]['data'] : 'suppliar_id'; // Column name
    $columnSortOrder = isset($_POST['order'][0]['dir']) ? $_POST['order'][0]['dir'] : 'asc'; // asc or desc
    $searchValue = isset($_POST['search']['value']) ? $_POST['search']['value'] : ''; // Search value

    $searchArray = array();

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " AND (suppliar_id   LIKE :suppliar_id   or 
        name LIKE :name OR 
        con_num LIKE :con_num ) ";
   $searchArray = array( 
        'suppliar_id'=>"%$searchValue%", 
        'name'=>"%$searchValue%",
        'con_num'=>"%$searchValue%"
   );
}

## Total number of records without filtering
$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM suppliar ");
$stmt->execute();
$records = $stmt->fetch();
$totalRecords = $records['allcount'];

## Total number of records with filtering
$stmt = $pdo->prepare("SELECT COUNT(*) AS allcount FROM suppliar WHERE 1 ".$searchQuery);
$stmt->execute($searchArray);
$records = $stmt->fetch();
$totalRecordwithFilter = $records['allcount'];

// Fix columnName to match database columns
if ($columnName == 'checkbox') {
    $columnName = 'id';
} else if (!in_array($columnName, ['suppliar_id', 'name', 'company', 'address', 'con_num', 'total_buy', 'total_paid', 'total_due'])) {
    $columnName = 'id';
}

## Fetch records
$stmt = $pdo->prepare("SELECT * FROM suppliar WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");

// Bind values
foreach($searchArray as $key=>$search){
   $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach($empRecords as $row){
   $data[] = array(
      "checkbox"=>'<input type="checkbox" class="suppliarCheckbox" value="'.$row['id'].'">',
      "suppliar_id"=>$row['suppliar_id'],
      "name"=>$row['name'],
      "company"=>$row['company'],
      "address"=>$row['address'],
      "con_num"=>$row['con_num'],
      "total_buy"=>$row['total_buy'],
      "total_paid"=>$row['total_paid'],
      "total_due"=>$row['total_due'],
      "action"=>'
       <div class="btn-group">
      
          <a href="index.php?page=suppliar_edit&&edit_id='.$row['id'].'" class="btn btn-secondary btn-sm rounded-0" type="button"><i class="fas fa-edit"></i></a>
            
             <a href="index.php?page=purchase_pay&&id='.$row['id'].'" class="btn btn-info btn-sm rounded-0" type="button"><i class="fa fa-credit-card"></i></a>

             <p class="suppliarDelete_btn btn btn-danger btn-sm rounded-0" data-id="'.$row['id'].'"><i class="fas fa-trash-alt"></i></p>
          </div>
        </div>
      ',
   );
}

## Response
$response = array(
   "draw" => intval($draw),
   "iTotalRecords" => $totalRecords,
   "iTotalDisplayRecords" => $totalRecordwithFilter,
   "aaData" => $data
);

echo json_encode($response);
} catch (Exception $e) {
    // Return error response
    echo json_encode(array(
       "draw" => 1,
       "iTotalRecords" => 0,
       "iTotalDisplayRecords" => 0,
       "aaData" => array(),
       "error" => $e->getMessage()
    ));
}