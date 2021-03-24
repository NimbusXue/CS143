<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        th {text-align: left;}
    </style>
    <title>Movie info Page</title>
</head>
<body>
    <header>
        <h1>Movie Information Page</h1>
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
            $statement = $db->prepare("SELECT M.title, M.company, M.rating,MG.genre, M.year
            FROM Movie M, MovieGenre MG
            WHERE M.id=? AND M.id=MG.mid ");
            
            $id = $_GET['id']; 
             
            $statement->bind_param('i', $id);
            $statement->execute();
           
            $statement->bind_result($returned_title, $returned_company, $returned_rating,$returned_genre,$returned_year);     


        ?>


        <h2>Movie Information is </h2>
        <p>
        <?php
        $c=0;
        while ($statement->fetch()) {
            if($c===0){
                print "Title :$returned_title($returned_year)<br>";
                print "Produce :$returned_company<br>";
                print "MPAA Rating :$returned_rating<br>";
                print "Genre :";
            } 
            $c++;
            print "$returned_genre ";
        }
        $statement->free_result();
        $statement3 = $db->prepare("SELECT CONCAT(first,' ',last) AS Dname, dob
            FROM  MovieDirector, Director
            WHERE mid=? AND did=id ");
            
            $id3 = $_GET['id']; 
             
            $statement3->bind_param('i', $id3);
            $statement3->execute();
            $statement3->bind_result($returned_dname,$returned_dob);
            print "<br>";
            $c=0;
            while ($statement3->fetch()) {
                if($c===0){
                    print "Director :$returned_dname($returned_dob)<br>";
                } 
                $c++;
            }

        
        ?>
        </p>
        <h2>Actors in this Movie:</h2>
        <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                 $id2 = $_GET['id'];
                 $statement2 = $db->prepare("SELECT CONCAT(A.first,' ',A.last) AS Aname,role,A.id FROM Actor A,MovieActor MA WHERE MA.mid=? AND MA.aid=A.id");
                 $statement2->bind_param('i', $id2);
                 $statement2->execute();
                 $statement2->bind_result($returned_Aname,$returned_role,$returned_Aid);
                while ($statement2->fetch()) { 
                    print "<tr><td><a href='./Actor.php?id=$returned_Aid'>$returned_Aname</a></td><td>$returned_role</td></tr>";
                }
                $statement2->free_result();
                ?>
        </tbody>

        </table>

        <hr>
        <h2>User review</h2>
        <?php
        $statement6 = $db->prepare("SELECT AVG(rating),COUNT(*) FROM Review WHERE mid=?");
        $id6 = $_GET['id']; 
        $statement6->bind_param('i', $id6);
        $statement6->execute();
        $statement6->bind_result($returned_score,$returned_sum);
        // print "yes";
        while ($statement6->fetch()) { 
            print "Average score for this Movie is $returned_score/5 based on $returned_sum people's reviews<br>";
            
        }
        $statement6->free_result();
        print "<a href='./comment.php?id=$id' title='$returned_title($returned_year)'>Leave your review as well!</a>";
        
        ?>
        <hr>
        <h2>Comment details shown below :</h2>
        <?php
        
            $statement7 = $db->prepare("SELECT name,rating,time,comment FROM Review WHERE mid=?");
            $id7 = $_GET['id']; 
            $statement7->bind_param('i', $id7);
            $statement7->execute();
            $statement7->bind_result($returned_cname,$returned_rating,$returned_time,$returned_comment);
            while ($statement7->fetch()) { 
                print "$returned_cname rates this movie with score $returned_rating and left a review at $returned_time<br>";
                print "comment:<br>";
                print "$returned_comment<br>";
                
            }
             $statement7->free_result();
            
        
            
        
            
        ?>

        
        
        </article>
    </main>
    <hr>
    <footer>
        This page is &copy 2021 by Nimbus Xue
    </footer>
</body>
</html>