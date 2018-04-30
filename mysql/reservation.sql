CREATE  TABLE `delhibelly`.`RESERVATIONS` (
  `ID` INT NOT NULL AUTO_INCREMENT ,
  `USER_ID` INT NOT NULL ,
  `DATE` DATE NOT NULL ,
  `START_TIME` TIME NOT NULL ,
  `GUESTS` INT NOT NULL ,
  'PURPOSE', varchar(100),
  PRIMARY KEY (`ID`) );

SELECT * FROM reservations;
SELECT * FROM users;
SELECT * FROM user_types;

SELECT * FROM reservations LEFT OUTER JOIN users on reservations.USER_ID = users.user_id;



INSERT INTO reservations (USER_ID,DATE,START_TIME,GUESTS) VALUES (1,'2017-8-11','18:00',5);
update reservations set USER_ID=15 WHERE ID=1;