<?php
//Reference for Table Filter Function
//http://1bestcsharp.blogspot.com/2016/07/php-html-table-filter-data.html
//Author:Michael Goldson

    $servername = "localhost:";
    $username =  "comp2140";
    $password = "group5";

try{
    
    $con = new PDO('mysql:host=localhost;dbname=MaintainDB', $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $ex) {

    echo 'Not Connected '.$ex->getMessage();
}

$tableContent = '';
$start = '';
$start2 = '';
$start3 = '';
$start4 = '';
$start5 = '';
$selectStmt = $con->prepare('SELECT * FROM maintain');
$selectStmt->execute();
$data = $selectStmt->fetchAll();


$count=0;
        foreach($data as $data){
            $count++;
            if ($count%2==0){
                $tableContent = $tableContent.'<tr class="shaded">
                        <td>'.$data["name"].'</td> 
                        <td>'.$data["department"].'</td>
                        <td>'.$data["email"].'</td> 
                        <td>'.$data["area"].'</td>
                        <td>'.$data["location"].'</td> 
                        <td>'.$data["description"].'</td> 
                        <td>'.$data["category"].'</td> 
                        <td>'.$data["status"].'</td> 
                        <td>'.$data["id"].'</td> 
                        </tr>';
            }
            else{
                $tableContent = $tableContent.'<tr class="grshaded">
                        <td>'.$data["name"].'</td> 
                        <td>'.$data["department"].'</td>
                        <td>'.$data["email"].'</td> 
                        <td>'.$data["area"].'</td>
                        <td>'.$data["location"].'</td> 
                        <td>'.$data["description"].'</td> 
                        <td>'.$data["category"].'</td> 
                        <td>'.$data["status"].'</td> 
                        <td>'.$data["id"].'</td> 
                        </tr>';
            }
            
        }


if(isset($_POST['search']))
{
$start = $_POST['start'];
$start2 = $_POST['start2'];
$start3 = $_POST['start3'];
//echo $start;
//echo $start2;
//$start = $con->quote($start);
$tableContent = '';
$selectStmt = $con->prepare('SELECT * FROM maintain WHERE (email like :start OR name like :start) AND status like :start2 AND area like :start3');
$selectStmt->execute(array( ':start'=>$start.'%', ':start2'=>$start2.'%', ':start3'=>$start3.'%'));
$data = $selectStmt->fetchAll();

$count=0;
        foreach($data as $data){
            $count++;
            if ($count%2==0){
                $tableContent = $tableContent.'<tr class="shaded">
                        <td>'.$data["name"].'</td> 
                        <td>'.$data["department"].'</td>
                        <td>'.$data["email"].'</td> 
                        <td>'.$data["area"].'</td>
                        <td>'.$data["location"].'</td> 
                        <td>'.$data["description"].'</td> 
                        <td>'.$data["category"].'</td> 
                        <td>'.$data["status"].'</td> 
                        <td>'.$data["id"].'</td> 
                        </tr>';
            }
            else{
                $tableContent = $tableContent.'<tr class="grshaded">
                        <td>'.$data["name"].'</td> 
                        <td>'.$data["department"].'</td>
                        <td>'.$data["email"].'</td> 
                        <td>'.$data["area"].'</td>
                        <td>'.$data["location"].'</td> 
                        <td>'.$data["description"].'</td> 
                        <td>'.$data["category"].'</td> 
                        <td>'.$data["status"].'</td> 
                        <td>'.$data["id"].'</td> 
                        </tr>';
            }
            
        }
    
}


if(isset($_POST['update']))
{

$start4 = $_POST['start4'];
$start5 = $_POST['start5'];
//echo $start;
//echo $start2;
//$start = $con->quote($start);
$query = 'UPDATE maintain SET status = :start4 WHERE id = :start5';
$tableContent = '';
$selectStmt = $con->prepare($query);
$updateStmt= $selectStmt->execute(array( ':start4'=>$start4, ':start5'=>$start5));


$selectStmt2 = $con->prepare('SELECT * FROM maintain WHERE id = :start5');
$selectStmt2->execute(array( ':start5'=>$start5.'%'));
$data = $selectStmt2->fetchAll();

if ($updateStmt){
    echo 'Data Updated';
}
else{
    echo 'ERROR Data not updated';
}

$count=0;
        foreach($data as $data){
            $count++;
            if ($count%2==0){
                $tableContent = $tableContent.'<tr class="shaded">
                        <td>'.$data["name"].'</td> 
                        <td>'.$data["department"].'</td>
                        <td>'.$data["email"].'</td> 
                        <td>'.$data["area"].'</td>
                        <td>'.$data["location"].'</td> 
                        <td>'.$data["description"].'</td> 
                        <td>'.$data["category"].'</td> 
                        <td>'.$data["status"].'</td> 
                        <td>'.$data["id"].'</td> 
                        </tr>';
            }
            else{
                $tableContent = $tableContent.'<tr class="grshaded">
                        <td>'.$data["name"].'</td> 
                        <td>'.$data["department"].'</td>
                        <td>'.$data["email"].'</td> 
                        <td>'.$data["area"].'</td>
                        <td>'.$data["location"].'</td> 
                        <td>'.$data["description"].'</td> 
                        <td>'.$data["category"].'</td> 
                        <td>'.$data["status"].'</td> 
                        <td>'.$data["id"].'</td> 
                        </tr>';
            }
            
        }
    
}






?>

<!DOCTYPE html>
<html>
    <head>
        <title>Maintenance Log Manager</title>  
        <link rel="stylesheet" type="text/css" href="Styles/phpstyle.css" />  

        <h1>Maintenance Log Manager</h1>


    </head>
    <body>
        <form action="manage2.0.php" method="POST" style="border-color:blue; width: 25em; border-width: 0.5px; display:inline-block;">
            <h4>Filter Log</h4>
            <!-- 
For The First Time The Table Will Be Populated With All Data
But When You Choose An Option From The Select Options And Click The Find Button, The Table Will Be Populated With specific Data 
             -->
            <!-- <select name="start">
                <option value="">...</option>
                <option value="A" <?php if($start == 'A'){echo 'selected';}?>>A</option>
                <option value="B" <?php if($start == 'B'){echo 'selected';}?>>B</option>
                <option value="C" <?php if($start == 'C'){echo 'selected';}?>>C</option>
                <option value="D" <?php if($start == 'D'){echo 'selected';}?>>D</option>
                <option value="E" <?php if($start == 'E'){echo 'selected';}?>>E</option>
                <option value="F" <?php if($start == 'F'){echo 'selected';}?>>F</option>
                <option value="G" <?php if($start == 'G'){echo 'selected';}?>>G</option>
                <option value="H" <?php if($start == 'H'){echo 'selected';}?>>H</option>
                <option value="I" <?php if($start == 'I'){echo 'selected';}?>>I</option>
                <option value="J" <?php if($start == 'J'){echo 'selected';}?>>J</option>
                <option value="K" <?php if($start == 'K'){echo 'selected';}?>>K</option>
                <option value="L" <?php if($start == 'L'){echo 'selected';}?>>L</option>
            </select>-->

    <label style="padding: 0.5em; width:07em; background-color: azure; display:inline-block;">Email / Name</label>
    <input id="start" type="text" name="start" style="padding: 6px 10px; margin: 3px 0;  display: inline-block;  border-radius: 4px; box-sizing: border-box;font-family: Verdana, Geneva, sans-serif; font-size: 0.7em;"/><br />

    <label style="padding: 0.5em; width:07em; background-color: azure; display:inline-block;"> Status </label>
    <select name="start2" style="padding: 6px 10px;margin: 3px 0;  display: inline-block;  border-radius: 4px; box-sizing: border-box;font-family: Verdana, Geneva, sans-serif; font-size: 0.7em;">
                <option value="">...</option>
                <option value="Pending" <?php if($start2 == 'Pending'){echo 'selected';}?>>Pending</option>
                <option value="On Track" <?php if($start2 == 'On Track'){echo 'selected';}?>>On Track</option>
                <option value="Completed" <?php if($start2 == 'Completed'){echo 'selected';}?>>Completed</option>
            </select> <br />

    <label style="padding: 0.5em; width:07em; background-color: azure; display:inline-block;">Area</label>
    <input id="start3" type="text" name="start3" style="padding: 6px 10px; margin: 3px 0;  display: inline-block; 
     border-radius: 4px; box-sizing: border-box;font-family: Verdana, Geneva, sans-serif; font-size: 0.7em;"/> <br />

    <label style ="padding: 0.5em; width:07em; display:inline-block; "> </label>
    <input type="submit" name="search" value="Find" style="background-color: #3366CC; font-size: 0.7em; color: white;
     padding: 7px 10px; margin: 7px 0; border: none; border-radius: 3px; cursor: pointer; font-family: Verdana, Geneva, sans-serif;"> 
                
    </form>




    <form action="manage2.0.php" method="POST" style=" width: 20em;  display:inline-block; vertical-align: ">
    <h4>Update Status</h4>
    <label style="padding: 0.4em; width:07em; background-color: azure; display:inline-block;">ID</label>
    <input id="start5" type="text" name="start5" style="padding: 6px 10px; margin: 3px 0;  display: inline-block; 
     border-radius: 4px; box-sizing: border-box;font-family: Verdana, Geneva, sans-serif; font-size: 0.7em;"/> <br />

    <label style="padding: 0.5em; width:07em; background-color: azure; display:inline-block;"> Status </label>
    <select name="start4" style="padding: 6px 10px;margin: 3px 0;  display: inline-block;  border-radius: 4px; box-sizing: border-box;font-family: Verdana, Geneva, sans-serif; font-size: 0.7em;">
                <option value="Pending" selected="selected"<?php if($start4 == 'Pending'){echo 'selected';}?>>Pending</option>
                <option value="On Track" <?php if($start4 == 'On Track'){echo 'selected';}?>>On Track</option>
                <option value="Completed" <?php if($start4 == 'Completed'){echo 'selected';}?>>Completed</option>
            </select> <br/> 

    <label style ="padding: 0.5em; width:07em; display:inline-block; "> </label>
    <input type="submit" name="update" value="Update" style="background-color: #3366CC; font-size: 0.7em; color: white;
     padding: 7px 10px; margin: 7px 0; border: none; border-radius: 3px; cursor: pointer; font-family: Verdana, Geneva, sans-serif;"> 
                  
        </form>


        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th>Area</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>ID</th>
                </tr>
            </thead>
                
                <?php
                
                echo $tableContent;
                
                ?>
                
            </table>
        
    </body>    
</html>
