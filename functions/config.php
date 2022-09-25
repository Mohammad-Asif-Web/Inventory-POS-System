<?php

try{
    $db_name = "mysql:host=localhost;dbname=inventory_pos";
    $db_user = 'root';
    $db_pass = '';
    $pdo = new PDO($db_name, $db_user, $db_pass);
    // echo "connection successfull";
} catch(PDOException $error){
    echo $error->getMessage();
}


// $role = "Admin";
// $id = 1;

// $sql = "SELECT * FROM tbl_user WHERE role = ? AND user_id = ?";
// $query = $pdo->prepare($sql);

// // role comes first that's why role param number is 1
// $query->bindParam(1, $role, PDO::PARAM_STR);

// // user_id comes at second, that's why user_id param no is 2
// $query->bindParam(2, $id, PDO::PARAM_INT);

// $query->execute();
// $result = $query->fetchAll(PDO::FETCH_ASSOC);

// if(count($result)){
//     foreach($result as $row){
//         echo "<pre>";
//         print_r($row);
//         echo "</pre>";
//     }
// } else {
//     echo "Query Failed";
// }

/* 1. How to Run SQL Query

$pdo->query(SQL Query)
        or
$pdo->prepare(SQL Query)

2. bindParam(param no, $param_value, param data type)

Data type in bindParam() Function:
    A. PDO::PARAM_INT   -- if the param value is INT Data Type
    B. PDO::PARAM_STR   -- if the param value is string data type
    C. PDO::PARAM_BOOL  -- if the param value is Boolean data type
    D. PDO::PARAM_NULL  -- if you want to keep null value

3. execute the prepare -- if we don't execute the prepare, we don't get the value
$result->execute();

4. php fetch style for fetch function:
    A. PDO::FETCH_ASSOC -- if we need only associative array
    B. PDO::FETCH_NUM   -- if we need only index array
    C. PDO::FETCH_BOTH  -- if we need both associative an num array(THIS IS DEFAULT)
    D. PDO::FETCH_OBJ   -- if we need only object

5. how to Close Connection

$pdo = null;

*/

?>