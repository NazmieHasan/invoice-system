# Invoice Management System 

## Laravel 10.37.3, PHP 8.2.0, MySQL 5.2.1

#### Table Structure
1. users

2. line_items
	- id
    - name
    - description
    - unit_price
    - quantity
   
3. invoices
    - id
    - invoice_number
    - customer_name
    - customer_email
    - line_items_and_qty
    - user_id
    - total_amount
 