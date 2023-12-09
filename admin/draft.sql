DELIMITER //

CREATE TRIGGER tr_checkin
BEFORE INSERT ON roomrentinfo
FOR EACH ROW
BEGIN
    UPDATE room
    JOIN 
    SET room.status = 0
    WHERE assignroom.order_id = NEW.id AND assignroom.room_id = room.id;
END //

DELIMITER ;


UPDATE room
JOIN roombookinfo ON roombookinfo.id = NEW.book_id
JOIN assignroom ON assignroom.order_id = roombookinfo.id
SET room.status = 0
WHERE room.id = assignroom.room_id;

UPDATE room
JOIN roombookinfo ON roombookinfo.id = roomrentinfo.book_id
JOIN assignroom ON assignroom.order_id = roombookinfo.id
SET room.status = 0
WHERE room.id = assignroom.room_id;



---Check valid date checkin and checkout
DELIMITER //

CREATE TRIGGER tr_check_valid_rentroom
BEFORE INSERT ON roombookinfo
FOR EACH ROW    
BEGIN
    IF NEW.echeckinday >= NEW.echeckoutday THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ngày checkin phải nhỏ hơn ngày checkout';
    END IF;
END //

DELIMITER ;
