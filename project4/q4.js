db.laureates.aggregate([
    {$unwind: "$nobelPrizes"}, 
    {$unwind: "$nobelPrizes.affiliations"}, 
    {$match: {"nobelPrizes.affiliations.name.en": "University of California"}}, 
    {$group: {_id: "$nobelPrizes.affiliations.city.en"}}, 
    {$group: {_id: null, "locations": {$sum: 1}}}, 
    {$project: {_id: 0,"locations":1}}
]);
