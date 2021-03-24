<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        th {text-align: left;}
        
    </style>
    <title>Search Page</title>
</head>
<body>
    <header>
        <h1>Searching Page</h1>
        <a href="./index.php">Home</a> 
    </header>
    <hr>
    <main>
        <article>
        <form action="search.php" method="post">
            Search: <input type="text" name="search_text" placeholder="Searching...">
            <br><br>
            <input type="submit" value="Click Me">
        </form>
        <?php  
            $db = new mysqli('localhost', 'cs143', '', 'cs143');
            if ($db->connect_errno > 0) { 
                die('Unable to connect to database [' . $db->connect_error . ']'); 
            }
            $query = "SELECT CONCAT(first,' ',last) AS FullName, dob,id FROM Actor WHERE CONCAT(first,' ',last) like '%s'";
            $query2 = "SELECT title, year ,id FROM Movie WHERE title like '%s'";
            $word =$_POST['search_text'];
            $words = explode(" ", $word);
            $len = count($words);
            $query_to_issue=$query;
            $query_to_issue2=$query2;
            if($len===1){
                $sanitized_name=$db->real_escape_string($words[0]);
                $query_to_issue = sprintf($query, "%".$sanitized_name."%"); 
                $query_to_issue2 = sprintf($query2, "%".$sanitized_name."%"); 
            }elseif($len>1){
                $sanitized_name=$db->real_escape_string($words[0]);
                $query_to_issue = sprintf($query, "%".$sanitized_name."%"); 
                $query_to_issue2 = sprintf($query2, "%".$sanitized_name."%"); 
                for($x = 1; $x < $len; $x++){
                    $sanitized_name=$db->real_escape_string($words[$x]);
                    $query_to_issue=$query_to_issue." AND CONCAT(first,' ',last) like "."'%".$sanitized_name."%'";
                    $query_to_issue2=$query_to_issue2." AND title like "."'%".$sanitized_name."%'";
                }
                

            }
            $query_to_issue=$query_to_issue." ORDER BY FullName";
            $query_to_issue2=$query_to_issue2." ORDER BY title";
            // print "word count is $len <br>";
            // print "$query_to_issue<br>";
            // print "$query_to_issue2";
        ?>
        
        <h2>Below are Matching Actors </h2>
        <table >
            <thead>
            <tr>
                <th>Name</th>
                <th>Date of Birth</th>
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
                    $name = $row['FullName']; 
                    $dob = $row['dob']; 
                    $aid = $row['id']; 
                    print "<tr>  <td><a href='./Actor.php?id=$aid'>$name</a></td> <td><a href='./Actor.php?id=$aid'>$dob</a></td> </tr>";

                }
                $rs->free();

                 
                ?>
           
            </tbody>
        </table>



        <h2>Below are Matching Movies </h2>
        <table >
            <thead>
            <tr>
                <th>Title</th>
                <th>Year</th>
            </tr>
            </thead>
            <tbody>
            
            <?php  
            
            $rs = $db->query($query_to_issue2);
            if (!$rs) {
                $errmsg = $db->error; 
                print "Query failed: $errmsg <br>"; 
                exit(1); 
            }
            while ($row = $rs->fetch_assoc()) {  
                $title = $row['title']; 
                $year = $row['year']; 
                $mid =$row['id'];
               
                print "<tr> <td><a href='./Movie.php?id=$mid'>$title</a> </td> <td><a href='./Movie.php?id=$mid'>$year</a> </td></tr>";

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