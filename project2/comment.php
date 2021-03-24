<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comment</title>
</head>
<body>
    <header>
        <h1>Add new comment here :</h1>
        <a href="./index.php">Home</a> 
    </header>
    <main>
        <article>
            <section>
            <form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <fieldset>
                        <p>
                            <select name="Movie">
                            <?php 
                            $id = $_GET['id']; 
                            $db = new mysqli('localhost', 'cs143', '', 'cs143');
                            if ($db->connect_errno > 0) { 
                                die('Unable to connect to database [' . $db->connect_error . ']'); 
                            }
                            $query = "SELECT DISTINCT title, year FROM Movie M WHERE id='%d'";
                            $sanitized_name=$db->real_escape_string($id);
                            $query_to_issue = sprintf($query, $sanitized_name); 
                            $rs = $db->query($query_to_issue);
                            if (!$rs) {
                                $errmsg = $db->error; 
                                print "Query failed: $errmsg <br>"; 
                                exit(1); 
                            }
                            while ($row = $rs->fetch_assoc()) {   
                                $title = $row['title']; 
                                $year = $row['year']; 
                                print "<option value='$id'>$title($year)</option>";
            
                            }
                            $rs->free();
                            ?>
                            
                                
                                  
                             </select>
                            
                        </p>
                       
                    </fieldset>
                    
                    <fieldset>
                        <p>
                           <label for="commenter">Your name</label>
                            <input type="text" id="commenter" value="Mr. Anonymous" name="commenter_name" />
                        </p>
                    </fieldset>

                    <fieldset>
                        <p>
                            Please give your rating!
                        </p>
                        <p>
                            <label for="option1">1</label>
                            <input type="radio" id="option1" value="1" name="Choices" />
                            <label for="option2">2</label>
                            <input type="radio" id="option2" value="2" name="Choices" />
                            <label for="option3">3</label>
                            <input type="radio" id="option3" value="3" name="Choices" />
                            <label for="option4">4</label>
                            <input type="radio" id="option4" value="4" name="Choices" />
                            <label for="option5">5</label> 
                            <input type="radio" id="option5" value="5" name="Choices" checked/>
                        </p>
                    </fieldset>
                    <fieldset>
                        <p>
                            Welcome to leave a comment below!
                        </p>
                        <p>   
                            <textarea rows="8" cols="200" name="comments">Please leave your comments here</textarea>       
                        </p>
                    </fieldset>
                    <fieldset>
                        <input type="submit" value="Submit your comment"/>
                    </fieldset>
                </form>
                <?php 
                if ($_POST["Choices"]){
                    $score=$_POST["Choices"];
                    $name=$_POST["commenter_name"];
                    $comment=$_POST["comments"];
                    $id=$_POST["Movie"];
                    $date = date('Y-m-d H:i:s', time());
                    $db = new mysqli('localhost', 'cs143', '', 'cs143');
                    if ($db->connect_errno > 0) { 
                        die('Unable to connect to database [' . $db->connect_error . ']'); 
                    }
                    // print "$score <br>";
                    // print "$name <br>";
                    // print "$comment <br>";
                    // print "$id <br>";
                    // print "$date <br>";

                    // $statment9 = $db->prepare("INSERT INTO Review VALUES ($name,$date,$id,$score,$comment)");
                    // $statement9->bind_param('ssiis', $name,$date,$id,$score,$comment);
                    $query = "INSERT INTO Review VALUES ('$name', '$date',$id,$score,'$comment')";
                    // print "$query";
                    $sanitized_name=$db->real_escape_string($name);
                    $sanitized_date=$db->real_escape_string($date);
                    $sanitized_id=$db->real_escape_string($id);
                    $sanitized_score=$db->real_escape_string($score);
                    $sanitized_comment=$db->real_escape_string($comment);
                    $query_to_issue = sprintf($query, $sanitized_name,$sanitized_date,$sanitized_id,$sanitized_score,$sanitized_comment); 
                    
                    $rs = $db->query($query);
                    if (!$rs) {
                        $errmsg = $db->error; 
                        print "Query failed: $errmsg <br>"; 
                        exit(1); 
                    }
                    // $statement9->execute();
                    print "<a href='./Movie.php?id=$id'>Click to check your comment</a>";  

                }
                ?>
                
            </section>

        </article>
        

    </main>
    <footer>

    </footer>

</body>
</html>
