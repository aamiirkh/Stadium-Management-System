INSERT INTO LOCATION VALUES ('National Stadium Colony, Gulshan-e-Iqbal', 74600, 'Karachi');
SELECT * FROM LOCATION;

INSERT INTO SEAT VALUES ('Lower', 500);
INSERT INTO SEAT VALUES ('Economy', 1000);
INSERT INTO SEAT VALUES ('First Class', 2000);

SELECT * FROM SEAT;

INSERT INTO STADIUM VALUES ('1', 'National Stadium', 'Cricket', 34228, 'National Stadium Colony, Gulshan-e-Iqbal');

SELECT * FROM STADIUM;

SELECT STADIUM_NAME FROM LOCATION, STADIUM WHERE stadium.address = LOCATION.ADDRESS; 

INSERT INTO JOBS VALUES ('Gardener', 8000);
SELECT * FROM JOBS;

UPDATE LOCATION SET ADDRESS = 'Block B, North Nazimabad' WHERE ADDRESS = 'National Stadium Colony, Gulshan-e-Iqbal';

UPDATE STADIUM SET STADIUM_NAME = 'King Abdullah National Stadium' WHERE ADDRESS = 'National Stadium Colony, Gulshan-e-Iqbal';


