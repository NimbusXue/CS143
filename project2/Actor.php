<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        th {text-align: left;}
    </style>
    <title>Actor info Page</title>
</head>
<body>
    <header>
        <h1>Actor Information Page</h1>
        <a href="./index.php">Home</a> 
    </header>
    <hr>
    <main>
        <article>
        
        <?php  
            $db = new mysqli('localhost', 'cs143', '', 'cs143');
            if ($db->connect_errno > 0) { 
                die('Unable to connect to database [' . $db->connect_error . ']'); 
            }
            $statement = $db->prepare("SELECT CONCAT(first,' ',last) AS FullName, sex,dob,dod FROM Actor WHERE id=?");
            // $statement2 = $db->prepare("SELECT MA.role, M.title FROM MovieActor MA,Movie M,Actor A WHERE A.id=? AND M.id=MA.mid AND MA.aid=A.id");
            $id = $_GET['id']; 
            $statement->bind_param('i', $id);
            $statement->execute();
            // $statement2->bind_param('i', $id);
            // print "$id"; 
            // $statement2->execute();
            $statement->bind_result($returned_name, $returned_sex, $returned_dob, $returned_dod);
            // $statement2->bind_result($returned_role, $returned_title);
            $query = "SELECT MA.role, M.title,M.id FROM MovieActor MA,Movie M,Actor A WHERE A.id='%d' AND M.id=MA.mid AND MA.aid=A.id";
            $sanitized_name=$db->real_escape_string($id);
            $query_to_issue = sprintf($query, $sanitized_name); 
           
                


        ?>


        <h2>Actor Information is </h2>
        <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Sex</th>
                <th>Date of Birth</th>
                <th>Date of Death</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                while ($statement->fetch()) { 
                    if(!$returned_dod){
                        $returned_dod="Still alive";
                    }
                    print "<tr><td>$returned_name</td><td>$returned_sex</td><td>$returned_dob</td><td>$returned_dod</td></tr>";
                }
                $statement->free_result();
                ?>
        </tbody>

        </table>

        <h2>Actor's Movies and Role</h2>
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Movie Title</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                     $rs = $db->query($query_to_issue);
                     if (!$rs) {
                         $errmsg = $db->error; 
                         print "Query failed: $errmsg <br>"; 
                         exit(1); 
                     }
                     while ($row = $rs->fetch_assoc()) {  
                         $role = $row['role']; 
                         $title = $row['title']; 
                         $mid = $row['id']; 
                         print "<tr><td>$role</td><td><a href='./Movie.php?id=$mid'>$title</a></td></tr>";
     
                     }
                     $rs->free();
                ?>
            </tbody>
        </table>
        
        


        </article>
    </main>
    <hr>
    <footer>
        This page is &copy 2021 by Nimbus Xue
    </footer>
</body>
</html>