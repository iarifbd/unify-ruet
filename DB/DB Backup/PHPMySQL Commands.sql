-- Step 1: Create a new table with the same structure but with an auto-increment column
CREATE TABLE studentledger_new (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,            -- Auto-increment, not nullable
    gdate DATE NOT NULL,                                   -- Required field
    ldate DATE NOT NULL,                                   -- Required field
    tdate DATE NOT NULL,                                   -- Required field
    S_Id INT NOT NULL,                                     -- Required field
    description VARCHAR(255) NOT NULL,                      -- Required field
    acctype VARCHAR(50) NOT NULL,                           -- Required field
    achead VARCHAR(50) NOT NULL,                            -- Required field
    dr DECIMAL(10, 2) NOT NULL,                            -- Required field
    cr DECIMAL(10, 2) NOT NULL,                            -- Required field
    balance DECIMAL(10, 2) NOT NULL,                       -- Required field
    status VARCHAR(50) NOT NULL                            -- Required field
);

-- Step 2: Insert data into the new table, generating the new ID
INSERT INTO studentledger_new (gdate, ldate, tdate, S_Id, description, acctype, achead, dr, cr, balance, status)
SELECT gdate, ldate, tdate, S_Id, description, acctype, achead, dr, cr, balance, status
FROM studentledger
ORDER BY gdate, S_Id, achead;

-- Step 3: Drop the old table
DROP TABLE studentledger;

-- Step 4: Rename the new table to the original table name
RENAME TABLE studentledger_new TO studentledger;
