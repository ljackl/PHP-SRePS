#adding data to item table
INSERT INTO item (item_name, item_desc, item_stock, item_cost)
  VALUES ("toothbrush", "brushes teeth", 7, 2.30),
  ("pencil", "writes with lead", 8, 1.35),
  ("pen", "writes with ink", 9, 1.50)

#Updating data item table
UPDATE item SET item_cost = 1.20, item_stock = 6 WHERE item_name = "pencil"

#Searching data item table
SELECT * FROM item WHERE item_stock < 10

#Deleting data item table
DELETE FROM item WHERE item_name = "toothbrush"

DELETE FROM item WHERE item_desc = "writes with lead"

DELETE FROM item WHERE item_desc = "writes with ink"
