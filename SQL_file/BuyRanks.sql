DELIMITER  $$

DROP PROCEDURE IF EXISTS BuyRank $$

CREATE PROCEDURE BuyRank(IN iduser INT,IN namerank VARCHAR(255))

BEGIN

    DECLARE rankPrice INT;

    IF (namerank = 'silver') THEN

        SET rankPrice = 0;

    ELSEIF (namerank = 'gold') THEN 

        SET rankPrice = 1000;

    ELSE

        SET rankPrice = 5000;
    
    END IF;

    UPDATE users SET `rank` = namerank ,Balance = Balance-rankPrice  WHERE id = iduser;

END  $$

DELIMITER  ;
