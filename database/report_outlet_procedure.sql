CREATE DEFINER=`root`@`localhost` PROCEDURE `report_outlet`(in start_date date, in end_date date)
BEGIN
DECLARE crt_date DATE;
  SET crt_date=start_date;
  WHILE crt_date <= end_date DO
    INSERT INTO calendar_outlet VALUES(crt_date);
    SET crt_date = ADDDATE(crt_date, INTERVAL 1 DAY);
  END WHILE;
END