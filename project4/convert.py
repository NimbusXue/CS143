import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))
file = open("laureates.import", "a")

laureate = data["laureates"]

for laureate in data["laureates"]:
    json_object = json.dumps(laureate, indent = 4)
    file.write(json_object) 
    file.write("\n")

