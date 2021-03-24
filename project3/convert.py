# dummy code for the converter in Python
import json
file1 = open("/home/cs143/data/nobel-laureates.json","r")
PO = json.loads(file1.read())
# print('This the length of the array')
# print(len(PO["laureates"]))
# print("Hello, I am the JSON-to-Relation converter!")
LP = open("laureatesPerson.del", "a")
LO = open("laureatesOrg.del", "a")
LN = open("Nobel.del", "a")
lpdict={}
lodict={}
lndict={}
for laureate in PO["laureates"]:
    if "gender" in laureate:
        if "birth" in laureate:
            bdate=laureate["birth"]["date"]
            if "city" in laureate["birth"]["place"]:
                bcity='"'+laureate["birth"]["place"]["city"]["en"]+'"'
            else:
                bcity="\\N"
            bcountry='"'+laureate["birth"]["place"]["country"]["en"]+'"'
        else:
            bdate="\\N"
            bcity="\\N"
            bcountry="\\N"
        if "familyName" in laureate:
            FN='"'+laureate["familyName"]["en"]+'"'
        else:
            FN="\\N"
        str1=laureate["id"]+','+'"'+laureate["givenName"]["en"]+'"'+','+FN+','+laureate["gender"]+','+bdate+','+bcity+','+bcountry+'\n'
        if str1 not in lpdict:
            LP.write(str1)
            lpdict[str1]="exist"
    else:
        if "founded" in laureate:
            fdate=laureate["founded"]["date"]
            if "city" in laureate["founded"]["place"]:
                fcity='"'+laureate["founded"]["place"]["city"]["en"]+'"'
            else:
                fcity="\\N"
            if "country" in laureate["founded"]["place"]:
                fcountry='"'+laureate["founded"]["place"]["country"]["en"]+'"'
            else:
                fcountry="\\N"
        else:
            fdate="\\N"
            fcity="\\N"
            fcountry="\\N"
        str2=laureate["id"]+','+'"'+laureate["orgName"]["en"]+'"'+','+fdate+','+fcity+','+fcountry+'\n'
        if str2 not in lodict:
            LO.write(str2)
            lodict[str2]="exist"
    if "nobelPrizes" in laureate:
        for nobel in laureate["nobelPrizes"]:
            if "dateAwarded" in nobel:
                dateAw=nobel["dateAwarded"]
            else:
                dateAw="\\N"
            if "affiliations" in nobel:
                for affiliation in nobel["affiliations"]:
                    if "name" in affiliation:
                        affN='"'+affiliation["name"]["en"]+'"'
                    else:
                        affN="\\N"
                    if "city" in affiliation:
                        affCity='"'+affiliation["city"]["en"]+'"'
                    else:
                        affCity="\\N"
                    if "country" in affiliation:
                        affCountry='"'+affiliation["country"]["en"]+'"'
                    else:
                        affCountry="\\N"
                    str3=laureate["id"]+','+nobel["awardYear"]+','+nobel["category"]["en"]+','+nobel["sortOrder"]+','
                    str4=nobel["portion"]+','+nobel["prizeStatus"]+","+dateAw+","+'"'+nobel["motivation"]["en"]+'"'+","+str(nobel["prizeAmount"])+","
                    str5=affN+","+affCity+","+affCountry+'\n'
                    str6=str3+str4+str5
                    if str6 not in lndict:
                        LN.write(str6)
                        lndict[str6]="exist"
            else:
                affN="\\N"
                affCity="\\N"
                affCountry="\\N"
            str3=laureate["id"]+','+nobel["awardYear"]+','+nobel["category"]["en"]+','+nobel["sortOrder"]+','
            str4=nobel["portion"]+','+nobel["prizeStatus"]+","+dateAw+","+'"'+nobel["motivation"]["en"]+'"'+","+str(nobel["prizeAmount"])+","
            str5=affN+","+affCity+","+affCountry+'\n'
            str6=str3+str4+str5
            if str6 not in lndict:
                LN.write(str6)
                lndict[str6]="exist"

    







        

        


    
