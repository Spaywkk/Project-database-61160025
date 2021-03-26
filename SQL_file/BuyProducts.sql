DELIMITER  $$

DROP PROCEDURE IF EXISTS BuyProductBeat $$

CREATE PROCEDURE BuyProductBeat(IN iduser INT,IN idpost INT,IN pricebuy DOUBLE,IN timnow DATETIME)
BEGIN


    UPDATE products SET UserProduct_id = iduser, ProductStatus = 'off' WHERE ProductID = idpost;
    UPDATE users SET Balance=Balance-pricebuy WHERE id = iduser;


    INSERT INTO `orders`(`user_id`) VALUES (iduser);
    SET @ID1 = LAST_INSERT_ID(); 

    INSERT INTO `order_details` (`Price`, `Order_ID`,`Product_ID`) VALUES (pricebuy,@ID1,idpost);
    SET @ID2 = LAST_INSERT_ID();

    INSERT INTO `trading_histories` (`OderdetailID`,`OderID`) VALUES (@ID2,@ID1);

END  $$

DELIMITER  ;


--ใช้สำหรับ สร้างข้อมูลการซื้อขาย ของ รายขาย เเละ บันทึกไปยัง  trading_histories
