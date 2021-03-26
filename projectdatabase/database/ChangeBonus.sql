DELIMITER  $$

DROP PROCEDURE IF EXISTS ChangeBonus $$

CREATE PROCEDURE ChangeBonus(IN iduser INT,IN bonus INT)

BEGIN

    IF (bonus = 100) THEN

        UPDATE users SET BonusStar = BonusStar-bonus, Balance = Balance + 100 WHERE id = iduser;

    ELSEIF (bonus = 150) THEN

        UPDATE users SET BonusStar = BonusStar-bonus, Balance = Balance + 150 WHERE id = iduser;

    ELSE 

        UPDATE users SET BonusStar = BonusStar-bonus,Balance = Balance + 350  WHERE id = iduser;

    END IF;

    
END  $$

DELIMITER  ;
