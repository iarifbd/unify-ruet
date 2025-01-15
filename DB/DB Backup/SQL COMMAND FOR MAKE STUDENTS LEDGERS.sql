/*____________________ Create Student Ledger Table ______________________*/

CREATE TABLE [dbo].[studentledger] (
    [id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,            -- Auto-increment, not nullable
    [gdate] date NOT NULL,                                  -- Required field
    [ldate] date NOT NULL,                                  -- Required field
    [tdate] date NOT NULL,                                  -- Required field
    [S_Id] INT NOT NULL,                                    -- Required field
    [description] NVARCHAR(255) NOT NULL,                   -- Required field
    [acctype] NVARCHAR(50) NOT NULL,                        -- Required field
    [achead] NVARCHAR(50) NOT NULL,                         -- Required field
    [dr] DECIMAL(10, 2) NOT NULL,                           -- Required field
    [cr] DECIMAL(10, 2) NOT NULL,                           -- Required field
    [balance] DECIMAL(10, 2) NOT NULL,                      -- Required field
    [status] NVARCHAR(50) NOT NULL      
);


/*_______________________________ Import Hall Charge ___________________________*/


INSERT INTO [studentledger] 
    (gdate, ldate, tdate, S_Id, description, acctype, achead, dr, cr, balance, status)
SELECT 
    BillMonth AS gdate,              -- Use BillMonth for gdate
    EOMONTH(BillMonth) AS ldate,           -- Provide a default date for ldate
    BillMonth AS tdate,              -- Use BillMonth for tdate
    S_Id,                            -- Student ID
    PurposeBill AS description,      -- Use PurposeBill for description
    'Dr' AS acctype,                 -- Set acctype as 'Dr' (debit)
    'HC' AS achead,                  -- Set achead as 'HC'
    BillAmount AS dr,                -- Use BillAmount for the debit amount
    0.00 AS cr,                      -- Set credit amount to 0
    BillAmount AS balance,           -- Set balance equal to BillAmount
    CASE 
        WHEN PaymentStatus = 'Yes' THEN 'Paid' 
        ELSE 'Due' 
    END AS status                    -- Set status based on PaymentStatus
FROM 
    StudentAccount
ORDER BY 
    BillMonth;



/*_______________________________Import Fine ___________________________*/

INSERT INTO [studentledger] 
    (gdate, ldate, tdate, S_Id, description, acctype, achead, dr, cr, balance, status)
SELECT 
    BillMonth AS gdate,              -- Use BillMonth for gdate
    EOMONTH(BillMonth) AS ldate,           -- Provide a default date for ldate
    BillMonth AS tdate,              -- Use BillMonth for tdate
    S_Id,                            -- Student ID
    PurposeBill AS description,      -- Use PurposeBill for description
    'Dr' AS acctype,                 -- Set acctype as 'Dr' (debit)
    'HC_DF' AS achead,                  -- Set achead as 'HC'
    Fine AS dr,                -- Use Fine for the debit amount
    0.00 AS cr,                      -- Set credit amount to 0
    Fine AS balance,           -- Set balance equal to Fine
    CASE 
        WHEN PaymentStatus = 'Yes' THEN 'Paid' 
        ELSE 'Due' 
    END AS status                    -- Set status based on PaymentStatus
FROM 
    StudentAccount
ORDER BY 
    BillMonth;



/*______________________________Import Payment Information _________________________________________________*/

INSERT INTO [studentledger] 
    (gdate, ldate, tdate, S_Id, description, acctype, achead, dr, cr, balance, status)
SELECT 
    TRY_CONVERT(DATE, pd.[Date], 103) AS gdate,                             -- Use 103 for British/French style (DD/MM/YYYY)
    EOMONTH(TRY_CONVERT(DATE, pd.[Date], 103)) AS ldate,                    -- Safely calculate end of month
    TRY_CONVERT(DATE, pd.[Date], 103) AS tdate,                             -- Safely convert to DATE for tdate
    pd.S_Id,                                                               -- Student ID
    'Payment Deposited' AS description,                                     -- Static text for description
    'Cr' AS acctype,                                                       -- 'Cr' for credit
    'HC_P' AS achead,                                                         -- 'P' for achead
    0.00 AS dr,                                                            -- Debit amount is always 0.00
    pd.[Amount] AS cr,                                                     -- Credit amount from Amount column
    pd.[Amount] AS balance,                                                -- Balance equals Amount
    CASE 
        WHEN pd.[Amount] = 0 THEN 'Due' 
        ELSE 'Paid' 
    END AS status                                                          -- Set status based on Amount
FROM 
    Payment_Datewise pd
WHERE 
    TRY_CONVERT(DATE, pd.[Date], 103) IS NOT NULL  -- Filter out rows with invalid date values
ORDER BY 
    pd.[Date];                                                             -- Sort by Date


/*__________________________Reset ID Number___________________________________*/


-- Step 1: Create a new table with the same structure but with an identity column
CREATE TABLE [dbo].[studentledger_new] (
    [id] INT IDENTITY(1,1) NOT NULL PRIMARY KEY,            -- Auto-increment, not nullable
    [gdate] date NOT NULL,                                  -- Required field
    [ldate] date NOT NULL,                                  -- Required field
    [tdate] date NOT NULL,                                  -- Required field
    [S_Id] INT NOT NULL,                                    -- Required field
    [description] NVARCHAR(255) NOT NULL,                   -- Required field
    [acctype] NVARCHAR(50) NOT NULL,                        -- Required field
    [achead] NVARCHAR(50) NOT NULL,                         -- Required field
    [dr] DECIMAL(10, 2) NOT NULL,                           -- Required field
    [cr] DECIMAL(10, 2) NOT NULL,                           -- Required field
    [balance] DECIMAL(10, 2) NOT NULL,                      -- Required field
    [status] NVARCHAR(50) NOT NULL      
);

-- Step 2: Insert data into the new table, generating the new ID
INSERT INTO [dbo].[studentledger_new] (gdate, ldate, tdate, S_Id, description, acctype, achead, dr, cr, balance, status)
SELECT gdate, ldate, tdate, S_Id, description, acctype, achead, dr, cr, balance, status
FROM [dbo].[studentledger]
ORDER BY gdate, S_Id,achead;

-- Step 3: Drop the old table
DROP TABLE [dbo].[studentledger];

-- Step 4: Rename the new table to the original table name
EXEC sp_rename 'dbo.studentledger_new', 'studentledger';



/*__________________________ GET Dr___________________________________*/

SELECT 
    gdate,
    SUM(CASE WHEN achead = 'HC' THEN dr ELSE 0 END) AS sum_hc,
    SUM(CASE WHEN achead = 'HC_DF' THEN dr ELSE 0 END) AS sum_hc_df
FROM 
    studentledger
GROUP BY 
    `S_Id`,gdate;



$this->db->select('gdate, 
    SUM(CASE WHEN achead = "HC" THEN dr ELSE 0 END) AS sum_hc, 
    SUM(CASE WHEN achead = "HC_DF" THEN dr ELSE 0 END) AS sum_hc_df')
         ->from('studentledger')
         ->group_by(['S_Id', 'gdate']);

$query = $this->db->get();
$result = $query->result_array(); // Fetch results as an associative array
