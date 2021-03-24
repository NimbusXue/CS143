SELECT first, last
FROM Actor , Movie,MovieActor
WHERE Actor.id=MovieActor.aid AND Movie.title='Die Another Day' AND Movie.id=MovieActor.mid;