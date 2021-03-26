DELIMITER  $$

DROP PROCEDURE IF EXISTS SoldOutProduct $$

CREATE PROCEDURE SoldOutProduct(IN idproduct INT)

BEGIN

    UPDATE products SET ProductStatus = 'soldout' WHERE ProductID = idproduct;
    

END  $$

DELIMITER  ;
