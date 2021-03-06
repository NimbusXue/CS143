db.laureates.aggregate([
    {$match: {"familyName": {$exists: true}}},
    { $unwind:"$nobelPrizes"},
    {$group:{
        _id:"$familyName",
        count:{$sum:1},
     }
    },
    { $match : {count:{$gte:5}}},
    { $project : { _id : 0,  "familyName":"$_id.en"} }
    
   ]);
