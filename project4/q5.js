db.laureates.aggregate([
    {$match:{"orgName":{$exists:true}}},
    {$unwind:"$nobelPrizes"},
    {$group:{_id:"$nobelPrizes.awardYear"}},
    {$group:{_id:null, "years":{$sum: 1}}},
    {$project:{_id:0,"years":1}}

])
