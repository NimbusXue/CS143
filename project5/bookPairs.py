# set up SparkContext for WordCount application
from pyspark import SparkContext
import itertools
sc = SparkContext("local", "BookPairs")
lines = sc.textFile("/home/cs143/data/goodreads.user.books")
pairs = lines.flatMap(lambda line: list(itertools.combinations(line.split(":")[1].split(","), 2)))
Orderpairs = pairs.map(lambda pair:(min(int(pair[0]),int(pair[1])),max(int(pair[0]),int(pair[1]))))
pair1s = Orderpairs.map(lambda pair: (pair, 1))
pairCounts = pair1s.reduceByKey(lambda a, b: a+b)
pair20 = pairCounts.filter(lambda pairCount: pairCount[1] > 20)
pair20sort = pair20.sortByKey(True)
pair20sort.saveAsTextFile("output")