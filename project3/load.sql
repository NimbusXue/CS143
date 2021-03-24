DROP TABLE IF EXISTS LaureatePerson;
DROP TABLE IF EXISTS LaureateOrganization;
DROP TABLE IF EXISTS Nobel;
CREATE TABLE LaureatePerson(id INT PRIMARY KEY, givenName VARCHAR(100), familyName VARCHAR(100), gender VARCHAR(20), birthDate DATE,birthCity VARCHAR(100),birthCountry VARCHAR(100));
CREATE TABLE LaureateOrganization(id INT PRIMARY KEY, orgName VARCHAR(200), foundedDate DATE,foundedCity VARCHAR(100),foundedCountry VARCHAR(100));
CREATE TABLE Nobel
(id INT, awardYear INT,category VARCHAR(100),sortOrder INT, portion VARCHAR(20),prizeStatus VARCHAR(50),dateAwarded DATE,
motivation TEXT, prizeAmount INT, affiliationName VARCHAR(200),affiliationCity VARCHAR(100),affiliationCountry VARCHAR(100)
);
LOAD DATA LOCAL INFILE 'laureatesPerson.del' INTO TABLE LaureatePerson
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE 'laureatesOrg.del' INTO TABLE LaureateOrganization
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE 'Nobel.del' INTO TABLE Nobel
FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';

