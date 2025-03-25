USE merchandisingDB;

-- Create suppliers table
CREATE TABLE IF NOT EXISTS suppliers (
    supplier_id INT PRIMARY KEY,                  -- Unique identifier for the supplier
    name VARCHAR(100) NOT NULL,          -- Name of the supplier
    contact_phone VARCHAR(100),          -- Contact person's name
    city VARCHAR(100),                   -- City of the supplier
    postal_code VARCHAR(20),             -- Postal code of the supplier
    country VARCHAR(100),                -- Country of the supplier
    phone VARCHAR(20),                   -- Phone number of the supplier
    email VARCHAR(100)                   -- Email address of the supplier
);

-- Create stores table
CREATE TABLE IF NOT EXISTS stores (
    store_id INT AUTO_INCREMENT PRIMARY KEY,                      -- Unique identifier for the store
    name VARCHAR(255) NOT NULL,                             -- Name of the store
    address VARCHAR(255) NOT NULL,                          -- Address of the store
    city VARCHAR(100) NOT NULL,                             -- City where the store is located
    status ENUM('active', 'inactive', 'pending') DEFAULT 'pending', -- Status of the store
    parking_space BOOLEAN DEFAULT FALSE,                    -- If the store has parking space
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Last update timestamp
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP          -- Timestamp when the store was created
);

-- Create store_performance table
CREATE TABLE IF NOT EXISTS store_performance (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each performance record
    store_id INT NOT NULL,  -- Foreign key referencing the stores table
    chiffre_daffaire DECIMAL(15, 2) NOT NULL,  -- Total revenue of the store
    expenses DECIMAL(15, 2) NOT NULL,  -- Total expenses of the store
    rentability DECIMAL(10, 2) GENERATED ALWAYS AS (chiffre_daffaire - expenses) STORED, -- Profitability (Revenue - Expenses)
    performance_index DECIMAL(5, 2),  -- Performance index (e.g., a percentage rating)
    FOREIGN KEY (store_id) REFERENCES stores(store_id)  -- Foreign key constraint
);


-- Create roles table
CREATE TABLE IF NOT EXISTS roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT, -- Unique identifier for the role (auto-incremented)
    role_name VARCHAR(50) NOT NULL UNIQUE   -- Name of the role (must be unique and not null)
);

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each user
    password VARCHAR(255) NOT NULL,    -- Store passwords, not plain text
    email VARCHAR(100) NOT NULL UNIQUE, -- Email address, must be unique
    first_name VARCHAR(50),            -- User's first name
    last_name VARCHAR(50),             -- User's last name
    store_id INT,                      -- Foreign key to the store table
    role_id INT NOT NULL,              -- Foreign key to the roles table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the user was created
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp when the user was last updated
    FOREIGN KEY (store_id) REFERENCES stores(store_id), -- Link to the store table
    FOREIGN KEY (role_id) REFERENCES roles(role_id)    -- Link to the roles table
);

-- Create managers table
CREATE TABLE IF NOT EXISTS managers (
    manager_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each manager
    is_valid BOOLEAN NOT NULL DEFAULT TRUE,  -- Boolean field to indicate if the manager is valid
    salary DECIMAL(10, 2) NOT NULL,  -- Salary of the manager
    user_id INT NOT NULL,  -- Foreign key referencing the users table
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
);

-- Create employees table
CREATE TABLE IF NOT EXISTS employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each employee
    is_valid BOOLEAN NOT NULL DEFAULT TRUE,  -- Boolean field to indicate if the employee is valid
    salary DECIMAL(10, 2) NOT NULL,  -- Salary of the employee
    performance DECIMAL(5, 2),  -- Performance percentage (e.g., 95.50 for 95.5%)
    user_id INT NOT NULL,  -- Foreign key referencing the users table
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
);

-- Create categories table
CREATE TABLE IF NOT EXISTS categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each category
    category_name VARCHAR(100) NOT NULL,  -- Name of the category
    description TEXT NOT NULL  -- Description of the category
);


-- Create products table
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each product
    product_name VARCHAR(100) NOT NULL,  -- Name of the product
    trade_price DECIMAL(10, 2) NOT NULL,  -- Price at which the store buys the product (wholesale price)
    sale_price DECIMAL(10, 2) NOT NULL,  -- Price at which the product is sold to customers
    profit DECIMAL(10, 2) NOT NULL,  -- Price at which the product is sold to customers
    category_id INT NOT NULL,  -- Foreign key referencing the categories table
    FOREIGN KEY (category_id) REFERENCES categories(category_id)  -- Foreign key constraint for category
);

-- Create stock table
CREATE TABLE IF NOT EXISTS stocks (
    stock_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each stock
    store_id INT NOT NULL,  -- Store id Forign key
    product_id INT NOT NULL,  -- Price of the product
    quentity INT NOT NULL,  -- Quantity of the product in stock
    FOREIGN KEY (store_id) REFERENCES stores(store_id),  -- Foreign key constraint for category
    FOREIGN KEY (product_id) REFERENCES products(product_id)  -- Foreign key constraint for category
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each order
    supplier_id INT NOT NULL,  -- Foreign key referencing the suppliers table
    manager_id INT NOT NULL,  -- Foreign key referencing the managers table
    product_id INT NOT NULL,  -- Foreign key referencing the products table
    quantity INT NOT NULL,  -- Quantity of the product ordered
    is_done BOOLEAN NOT NULL DEFAULT FALSE,  -- Boolean field to indicate if the order is completed
    FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id),  -- Foreign key constraint for supplier
    FOREIGN KEY (manager_id) REFERENCES managers(manager_id),  -- Foreign key constraint for manager
    FOREIGN KEY (product_id) REFERENCES products(product_id)  -- Foreign key constraint for product
);

-- Create merchandising_data table
CREATE TABLE IF NOT EXISTS merchandising_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NOT NULL,                      -- معرف المتجر
    zone_population INT,                        -- عدد السكان في المنطقة
    avg_household_size DECIMAL(3, 1),           -- متوسط عدد الأفراد في كل أسرة
    nombre_menages DECIMAL(10, 2),              -- عدد الأسر في المنطقة
    avg_annual_spending DECIMAL(10, 2),         -- متوسط الإنفاق السنوي لكل أسرة
    regional_wealth_index DECIMAL(5, 2),        -- مؤشر الثروة الإقليمي
    invasion DECIMAL(15, 2),                
    evasion DECIMAL(15, 2),                     -- الإنفاق خارج المنطقة من المقيمين
    CA_potentiel_zone DECIMAL(15, 2),           
    competitor_revenue DECIMAL(15, 2),         
    CA_potentiel_store DECIMAL(15, 2),          
    result_frot DECIMAL(10,2) NOT NULL DEFAULT 0,
    analysis_date  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (store_id) REFERENCES stores(store_id)  -- Foreign key constraint
);

-- Create sales table
CREATE TABLE IF NOT EXISTS sales (
    sale_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each sale
    product_id INT NOT NULL,  -- Foreign key referencing the products table
    employee_id INT NOT NULL,  -- Foreign key referencing the employees table
    store_id INT NOT NULL,  -- Foreign key referencing the stores table
    quantity INT NOT NULL,  -- Quantity of the product sold
    total DECIMAL(10, 2) NOT NULL,  -- Total amount of the sale
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the sale was made
    FOREIGN KEY (product_id) REFERENCES products(product_id),  -- Foreign key constraint for product
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id),  -- Foreign key constraint for employee
    FOREIGN KEY (store_id) REFERENCES stores(store_id)  -- Foreign key constraint for store
);

-- Create objectifs table
CREATE TABLE IF NOT EXISTS objectifs (
    objectif_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each objective
    frequency ENUM('daily', 'weekly') NOT NULL,  -- Enum for daily or weekly
    type ENUM('quantity_product', 'montant_total') NOT NULL,  -- Enum for quantity or maintenance
    manager_id INT NOT NULL,  -- Foreign key referencing the managers table
    FOREIGN KEY (manager_id) REFERENCES managers(manager_id)  -- Foreign key constraint
);

-- Create reports table
CREATE TABLE IF NOT EXISTS reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each report
    user_id INT NOT NULL,  -- Foreign key referencing the users table
    message TEXT NOT NULL,  -- The content of the report
    report_type ENUM('profitability', 'competitor_analysis', 'sales_performance') NOT NULL,  -- Enum for report type
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the report was generated
    subject VARCHAR(255) NOT NULL,  -- The subject of the report
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
);