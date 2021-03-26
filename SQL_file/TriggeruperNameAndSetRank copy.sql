DELIMITER $$

DROP TRIGGER IF EXISTS SetUpperFullNameAndRank $$

CREATE  TRIGGER SetUpperFullNameAndRank BEFORE INSERT ON users FOR EACH ROW

BEGIN 
    
    DECLARE rankInsert VARCHAR(20);
    SET rankInsert = 'silver';


    IF (New.fullname IS NOT NULL) THEN

        SET  New.fullname = UPPER(New.fullname);

    END IF;


    IF (New.rank IS NULL) THEN

        SET New.rank = rankInsert;

    END IF;


END $$

DELIMITER   ;

