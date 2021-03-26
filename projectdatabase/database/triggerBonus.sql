DELIMITER $$

DROP TRIGGER IF EXISTS InsertBonusForUser $$

CREATE TRIGGER InsertBonusForUser BEFORE INSERT ON orders FOR EACH ROW

BEGIN 

    UPDATE users SET BonusStar = BonusStar + RAND()*(30) WHERE id = New.user_id;

END $$

DELIMITER   ;

