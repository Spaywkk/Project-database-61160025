DELIMITER $$

DROP TRIGGER IF EXISTS UpdateProduct $$

CREATE  TRIGGER UpdateProduct BEFORE UPDATE ON products FOR EACH ROW

BEGIN 

    SET  New.updated_at = NOW();

END $$

DELIMITER   ;

