--discount double entry
-- https://www.geeksforgeeks.org/journal-entry-for-discount-allowed-and-received/

-- purchase a/c = inventory a/c 105
-- sales a/c = sales revenue a/c

-- https://blog.journalize.io/posts/an-elegant-db-schema-for-double-entry-accounting/

select account, name, sum(amount * direction * normal) as balance from transactions left join accounts on account = accounts.number group by name order by account, name;

-- in live code below

select tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code group by account_name order by tr.account_head_id, ac.account_name;

-- with where clause to see the credit

select tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code WHERE tr.account_head_id = 207 group by account_name order by tr.account_head_id, ac.account_name;

-- find assets/liabilities/equity/expenses with like starts 1/2/3/4/5

select tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code WHERE tr.account_head_id LIKE '2%' group by account_name order by tr.account_head_id, ac.account_name;

-- example-liabilities

select tr.account_head_id, GROUP_CONCAT(tr.trns_id SEPARATOR ', ') AS invoices , GROUP_CONCAT((tr.amount * tr.direction * ac.normal) SEPARATOR ', ') AS invoices , ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code WHERE tr.account_head_id LIKE '2%' group by account_name order by tr.account_head_id, ac.account_name;





select account, account_name, sum(amount * direction * normal) as balance from transactions left join account_types on account = account_types.code group by account_name order by account, account_name;

select max(left_side) || ' = ' || max(right_side) as equation from ( select group_concat( case when normal = 1 then account_name end, ' + ' ) as left_side, group_concat( case when normal = -1 then account_name end, ' + ' ) as right_side from account_types where code % 100 = 0 group by normal )as t;



-- for details supplier balance

select tr.account_head_id, ac.account_name, tr.trns_id, (tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code;


select tr.account_head_id, sp.supplier_address, sp.supplier_phone, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code left join suppliers sp on ac.code = sp.parent_id WHERE tr.account_head_id LIKE '2%' group by ac.account_name order by tr.account_head_id, ac.account_name;

-- ++++++++++++++++++++++++++++++++++++++++

-- https://forums.mysql.com/read.php?10,517612,517948

-- https://github.com/Raja0sama/Accounting-System

-- ledger +final balance sheet details (Assets = Equity+Liability+Revenue-Expense)
select ah.account_head, tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code join account_heads ah on ac.account_head_id = ah.id WHERE tr.store_id = 101 GROUP BY ac.code ORDER BY ah.account_head;

-- in Balance Sheet if required details as account head name then 
select ah.account_head, tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code join account_heads ah on ac.account_head_id = ah.id WHERE tr.store_id = 101 AND ah.account_head = 'Assets' GROUP BY ac.code ORDER BY ah.account_head;



select transactions.account_head_id, trns_date, trns_id, case when direction = 1 then amount end as DR, case when direction = -1 then amount end as CR from transactions left join account_types on account_types.code = transactions.account_head_id order by transactions.account_head_id, trns_date, CR, DR;

-- balance sheet

select transactions.account_head_id, sum(amount * direction * normal) as balance from transactions left join account_types on transactions.account_head_id = account_types.code group by transactions.account_head_id transactions.store_id = 101 order by transactions.account_head_id;

select account_types.code, account_types.account_name, sum(amount * direction * normal) as balance from transactions left join account_types on transactions.account_head_id = account_types.code WHERE transactions.store_id = 101 GROUP BY account_types.id order by account_types.account_name;

-- final balance sheet
select tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code WHERE tr.store_id = 101 GROUP BY ac.code ORDER BY ac.account_name;



-- easy technique

SELECT ah.account_head, SUM(tr.amount * tr.direction * ac.normal) AS balance
FROM transactions tr
LEFT JOIN account_types ac ON tr.account_head_id = ac.code
JOIN account_heads ah ON ac.account_head_id = ah.id
WHERE tr.store_id = 101
GROUP BY ah.account_head
ORDER BY ah.account_head;

SELECT CASE WHEN account_types.account_head_id = 1 THEN 'ASSETS' WHEN account_types.account_head_id = 2 THEN 'Liabilities' WHEN account_types.account_head_id = 3 THEN 'Expense' WHEN account_types.account_head_id = 4 THEN 'Revenue' WHEN account_types.account_head_id = 5 THEN 'Equity' ELSE 'OTHER' END AS category, SUM(CASE WHEN account_types.normal = 1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS debit_total, SUM(CASE WHEN account_types.normal = -1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS credit_total FROM transactions tr LEFT JOIN account_types ON account_types.code = tr.account_head_id WHERE tr.store_id = 101 GROUP BY account_types.account_head_id ORDER BY account_types.account_head_id;

-- with balance

SELECT 
  CASE 
    WHEN account_types.account_head_id = 1 THEN 'ASSETS' 
    WHEN account_types.account_head_id = 2 THEN 'Liabilities' 
    WHEN account_types.account_head_id = 3 THEN 'Expense' 
    WHEN account_types.account_head_id = 4 THEN 'Revenue' 
    WHEN account_types.account_head_id = 5 THEN 'Equity' 
    ELSE 'OTHER' 
  END AS category, 
  SUM(CASE WHEN account_types.normal = 1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS debit_total, 
  SUM(CASE WHEN account_types.normal = -1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS credit_total,
  SUM(CASE WHEN account_types.normal = 1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) 
    - SUM(CASE WHEN account_types.normal = -1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS balance
FROM 
  transactions tr
  LEFT JOIN account_types ON account_types.code = tr.account_head_id
WHERE tr.store_id = 101
GROUP BY 
  account_types.account_head_id
ORDER BY 
  account_types.account_head_id;

SELECT ah.account_head, ac.account_name, SUM(tr.amount * tr.direction * ac.normal) AS balance FROM transactions tr LEFT JOIN account_types ac ON tr.account_head_id = ac.code JOIN account_heads ah ON ac.account_head_id = ah.id WHERE tr.store_id = 101 GROUP BY ah.account_head, ac.account_name ORDER BY ah.account_head;

-- income statement

SELECT CASE WHEN account_types.account_head_id = 3 THEN 'Expense' WHEN account_types.account_head_id = 4 THEN 'Revenue' ELSE 'OTHER' END AS category, SUM(CASE WHEN account_types.normal = 1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS debit_total, SUM(CASE WHEN account_types.normal = -1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS credit_total, SUM(CASE WHEN account_types.normal = 1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) - SUM(CASE WHEN account_types.normal = -1 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS balance FROM transactions tr LEFT JOIN account_types ON account_types.code = tr.account_head_id WHERE account_types.account_head_id IN (3, 4) GROUP BY account_types.account_head_id ORDER BY account_types.account_head_id;

-- Cashflow Statement

SELECT 
  CASE 
    WHEN account_heads.account_head = 'Assets' THEN 'Operating Activities' 
    WHEN account_types.account_head_id = 4 THEN 'Operating Activities' 
    WHEN account_heads.account_head = 'Liabilities' THEN 'Financing Activities'
    WHEN account_types.account_head_id = 5 THEN 'Financing Activities'
    ELSE 'Investing Activities' 
  END AS category, 
  SUM(CASE 
        WHEN account_types.normal = 1 AND account_types.account_head_id = 4 THEN tr.amount * tr.direction * account_types.normal 
        WHEN account_types.normal = -1 AND account_types.account_head_id = 5 THEN tr.amount * tr.direction * account_types.normal 
        ELSE 0 
      END) AS cash_inflow,
  SUM(CASE 
        WHEN account_types.normal = -1 AND account_types.account_head_id = 4 THEN tr.amount * tr.direction * account_types.normal 
        WHEN account_types.normal = 1 AND account_types.account_head_id = 5 THEN tr.amount * tr.direction * account_types.normal 
        ELSE 0 
      END) AS cash_outflow
FROM 
  transactions tr
  JOIN account_types ON account_types.code = tr.account_head_id
  JOIN account_heads ON account_heads.id = account_types.account_head_id
WHERE 
  account_heads.account_head IN ('Assets', 'Liabilities', 'Equity')
GROUP BY 
  category
ORDER BY 
  category;

-- Net income, revenue, expenses

SELECT SUM(CASE WHEN account_types.account_head_id = 4 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS revenue, SUM(CASE WHEN account_types.account_head_id = 3 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS expenses, SUM(CASE WHEN account_types.account_head_id = 4 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) - SUM(CASE WHEN account_types.account_head_id = 3 THEN tr.amount * tr.direction * account_types.normal ELSE 0 END) AS net_income FROM transactions tr JOIN account_types ON account_types.code = tr.account_head_id WHERE account_types.account_head_id IN (3, 4) AND tr.trns_date >= '2022-01-01' AND tr.trns_date < '2023-04-01';


-- trial balance

SELECT account_heads.account_head AS account_type, account_types.account_name AS account_name, SUM(CASE WHEN transactions.direction = 1 THEN transactions.amount * account_types.normal ELSE 0 END) AS debit_total, SUM(CASE WHEN transactions.direction = -1 THEN transactions.amount * account_types.normal ELSE 0 END) AS credit_total, SUM(transactions.amount * transactions.direction * account_types.normal) AS balance FROM transactions JOIN account_types ON account_types.code = transactions.account_head_id JOIN account_heads ON account_heads.id = account_types.account_head_id GROUP BY account_heads.account_head, account_types.account_name ORDER BY account_heads.account_head, account_types.account_name;

select ah.account_head, tr.account_head_id, ac.account_name, sum(tr.amount * tr.direction * ac.normal) as balance from transactions tr left join account_types ac on tr.account_head_id = ac.code join account_heads ah on ac.account_head_id = ah.id WHERE tr.store_id = 101 AND ah.account_head = 'Assets' GROUP BY ac.code ORDER BY ah.account_head;


todays sale price - buy price
SELECT SUM(ps.sell_price * psq.quantity) AS total_sales, SUM(ps.buy_price * psq.quantity) AS total_cost, SUM(ps.sell_price * psq.quantity) - SUM(ps.buy_price * psq.quantity) AS profit FROM sale_products psq JOIN product_stocks ps ON psq.pdtstock_id = ps.id JOIN transactions t ON psq.invoice_no = t.trns_id JOIN account_types ats ON t.account_head_id = ats.code WHERE t.trns_date = CURDATE();

now calculate expenses then substract from top

SELECT SUM(amount * direction * normal) AS Exp FROM transactions LEFT JOIN account_types ON account_types.code = transactions.account_head_id WHERE account_types.account_head_id = 3 AND transactions.trns_date = CURDATE();