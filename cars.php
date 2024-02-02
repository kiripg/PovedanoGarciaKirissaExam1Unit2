<?php

// function to connect to the database

function conect(){
       return $f1 = new PDO("mysql:host=localhost;dbname=f1", "dwes", "dwes");
}
// function for disconnecting from the database
function disconnet(){
    $f1 = null;
}
// function to update a table record
function update(){
    
    try{
        $f1= conect();
        $f1->beginTransaction();
            $stmt = $f1->prepare("UPDATE cars
                            SET model = ?, description = ?
                            WHERE carCode = ?");

            $stmt->bindParam(1, $_POST['model']);
            $stmt->bindParam(2, $_POST['description']);
            $stmt->bindParam(3, $_POST['carCode']);
           
            if($stmt->execute()){
                $f1->commit();
                echo '<h1>Update a car</h1>';
                tableUploadedOrDeleted($_POST['carCode'], $_POST['model'], $_POST['description']);
                echo "Car has been modified";
            }
        
    } catch (Exception $ex) {
        
        $ex= "Car has NOT been modified";
        echo $ex;
        $f1-> rollback();
    }
    
}
// function to delete a table record
function delete(){
    
     if (isset($_POST['Delete'])) {

            try{
                $f1= conect();
            $f1->beginTransaction();

            $stmt = $f1->prepare("DELETE FROM cars WHERE carCode = :carCode;");

            $stmt->bindParam(":carCode", $_POST['carCode']);

            if ($stmt->execute()) {
                echo "<h1>Delete a car</h1>";
                tableUploadedOrDeleted($_POST['carCode'], $_POST['model'], $_POST['description']);
                echo "Car has been deleted";
                $f1->commit();
            }
                
            } catch (Exception $ex){
                $ex= "Car has NOT been deleted";
                echo $ex;
              $f1->rollBack();  
            }
}
}

function tableUploadedOrDeleted($carCode, $model, $description){
    
  
    echo '<table><tr><td><img class="miniature" src="images/cars/'. $carCode.'.jpg" ></td></tr>';
    echo '<tr><td><input type="text" name="model" value="'.$model.'" readonly/></td></tr>';
    echo '<tr><td><input type="text" name="description" value="'. $description. '" readonly /></td></tr>';
    echo '<tr><td><input type="hidden" name="carCode" value="'.$carCode.'"/></td></tr>';
    echo '</table>';
    
}

function completeTable(){
    
        $f1 = conect();
        $query = "SELECT carCode, model, description FROM cars";
        $result = $f1->query($query);

        while ($data = $result->fetch()) {
    
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" enctype="multipart/form-data">';
    echo '<table><tr><td><img class="miniature" src="images/cars/'. $data['carCode'].'.jpg" ></td></tr>';
    echo '<tr><td><input type="text" name="model" value="'.$data['model'].'"/></td></tr>';
    echo '<tr><td><input type="text" name="description" value="'. $data['description']. '"/></td></tr>';
    echo '<tr><td><input type="hidden" name="carCode" value="'.$data['carCode'].'" />';
    echo "<input type='submit' name ='Update' value='Update'/>";
    echo "<input type='submit' name='Delete' value='Delete'/></tr>";
    echo "</table>";
    echo "</form>";
    
                       
        }
}

?>