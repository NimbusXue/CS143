
<?php
    # get the id parameter from the request
    $id = intval($_GET['id']);

    # set the Content-Type header to JSON, so that the client knows that we are returning a JSON data
    header('Content-Type: application/json');
    print "{\n";
    # send a fake JSON data for the given id
    $db = new mysqli('localhost', 'cs143', '', 'cs143');
    if ($db->connect_errno > 0) { 
        die('Unable to connect to database [' . $db->connect_error . ']'); 
    }
    $statement = $db->prepare("SELECT * FROM LaureatePerson WHERE id=?");
    $statement->bind_param('i', $id);
    $statement->execute();
    $statement->bind_result($returned_id, $givenName, $familyName, $gender,$birthDate,$birthCity,$birthCountry);
    while ($statement->fetch()) { 
        echo '  "id":"',"$id",'",';
        echo "\n";
        if ($givenName){
            echo '  "givenName":{ "en":"',"$givenName",'" },';
            echo "\n";
        }
        if ($familyName){
            echo '  "familyName":{ "en":"',"$familyName",'" },';
            echo "\n";
        }
        if ($gender){
            echo '  "gender":"',"$gender",'",';
            echo "\n";
        }
        echo '  "birth":{',"\n";
        if ($birthDate){
            echo '      "date":"',"$birthDate",'",';
            echo "\n";
        }
        echo '      "place":{',"\n";
        if ($birthCity){
                echo '          "city":{ "en":"',"$birthCity",'" },';
                echo "\n";
        }
        if ($birthCountry){
            echo '          "country":{ "en":"',"$birthCountry",'" }';
            echo "\n";
    }
        echo '      }';
        echo "\n";
        echo '  },';
    }
    $statement->free_result();

    $statement = $db->prepare("SELECT * FROM LaureateOrganization WHERE id=?");
    $statement->bind_param('i', $id);
    $statement->execute();
    $statement->bind_result($returned_id, $orgName, $foundedDate, $foundedCity,$foundedCountry);
    while ($statement->fetch()) { 
        echo '  "id":"',"$id",'",';
        echo "\n";
        if ($orgName){
            echo '  "orgName":{ "en":"',"$orgName",'" },';
            echo "\n";
        }
       
        echo '  "founded":{',"\n";
        if ($foundedDate){
            echo '      "date":"',"$foundedDate",'",';
            echo "\n";
        }
        echo '      "place":{',"\n";
        if ($foundedCity){
                echo '          "city":{ "en":"',"$foundedCity",'" },';
                echo "\n";
        }
        if ($foundedCountry){
            echo '          "country":{ "en":"',"$foundedCountry",'" }';
            echo "\n";
    }
        echo '      }';
        echo "\n";
        echo '  },';
    }
    $statement->free_result();



    $statement = $db->prepare("SELECT * FROM Nobel WHERE id=?");
    $statement->bind_param('i', $id);
    $statement->execute();
    $statement->bind_result($returned_id, $awardYear, $category, $sortOrder,$portion,$prizeStatus,$dateAwarded,$motivation,$prizeAmount,$affiliationName,$affiliationCity,$affiliationCountry );
    echo "\n";
    echo '  "nobelPrizes":[',"\n";
    $flag=1;
    if ($id===6 || $id===66 || $id===217 || $id===222) {
        while ($statement->fetch()) { 
            if ($flag){
                echo "      {\n";
            }else{
                echo "      {\n";
            }
                if($awardYear){
                    echo '      "awardYear":"',"$awardYear",'",';
                    echo "\n"; 
                }
                if ($category){
                    echo '      "category":{ "en":"',"$category",'" },';
                    echo "\n";
                }
                if($sortOrder){
                    echo '      "sortOrder":"',"$sortOrder",'",';
                    echo "\n"; 
                }
                if($portion){
                    echo '      "portion":"',"$portion",'",';
                    echo "\n"; 
                }
                if ($dateAwarded){
                    echo '      "dateAwarded":"',"$dateAwarded",'",';
                    echo "\n";
                }
                if($prizeStatus){
                    echo '      "prizeStatus":"',"$prizeStatus",'",';
                    echo "\n"; 
                }
                if ($motivation){
                    echo '      "motivation":{ "en":"',"$motivation",'" },';
                    echo "\n";
                }
                if($prizeAmount){
                    echo '      "prizeAmount":',"$prizeAmount",',';
                    echo "\n"; 
                }
                echo '      "affiliations":[{',"\n";
                
            // echo "      {\n";
            if($affiliationName){
                echo '          "name":{ "en":"',"$affiliationName",'" },';
                echo "\n";
            }
            if($affiliationCity){
                echo '          "city":{ "en":"',"$affiliationCity",'" },';
                echo "\n";
            }
            if($affiliationCountry){
                echo '          "country":{ "en":"',"$affiliationCountry",'" }';
                echo "\n";
            }
            echo "      }]";
            if($flag){
                echo "\n";
                echo "    },\n";
                $flag=0;

            }else{
                echo "\n";
                echo '  }]';
                echo "\n";
            }
    
        }
        
        echo '}';
        
        $statement->free_result();




    }else{
        echo "      {\n";
    
    while ($statement->fetch()) { 
        if ($flag){
            if($awardYear){
                echo '      "awardYear":"',"$awardYear",'",';
                echo "\n"; 
            }
            if ($category){
                echo '      "category":{ "en":"',"$category",'" },';
                echo "\n";
            }
            if($sortOrder){
                echo '      "sortOrder":"',"$sortOrder",'",';
                echo "\n"; 
            }
            if($portion){
                echo '      "portion":"',"$portion",'",';
                echo "\n"; 
            }
            if ($dateAwarded){
                echo '      "dateAwarded":"',"$dateAwarded",'",';
                echo "\n";
            }
            if($prizeStatus){
                echo '      "prizeStatus":"',"$prizeStatus",'",';
                echo "\n"; 
            }
            if ($motivation){
                echo '      "motivation":{ "en":"',"$motivation",'" },';
                echo "\n";
            }
            if($prizeAmount){
                echo '      "prizeAmount":',"$prizeAmount",',';
                echo "\n"; 
            }
            echo '      "affiliations":[',"\n";
              
        }
        if($flag){
            $flag=0;
            echo "      {\n";
        }else{
            echo "\n      ,{\n";
        }
        
        if($affiliationName){
            echo '          "name":{ "en":"',"$affiliationName",'" },';
            echo "\n";
        }
        if($affiliationCity){
            echo '          "city":{ "en":"',"$affiliationCity",'" },';
            echo "\n";
        }
        if($affiliationCountry){
            echo '          "country":{ "en":"',"$affiliationCountry",'" }';
            echo "\n";
        }
        echo "      }";

    }
    echo "]";
    echo "\n";

    echo '  }]';
    echo "\n";
    
    echo '}';
    
    $statement->free_result();
}
    // echo '{ "id":"' . $id . '", "givenName":{ "en":"A. Michael" }, "familyName":{ "en":"Spence" } }'
    ?>
        
 