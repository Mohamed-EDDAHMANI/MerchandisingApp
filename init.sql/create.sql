-- use merchandisingDB;


-- CREATE TABLE suppliers (
--     id INT PRIMARY KEY,                  -- Unique identifier for the supplier
--     name VARCHAR(100) NOT NULL,          -- Name of the supplier
--     contact_phone VARCHAR(100),          -- Contact person's name
--     city VARCHAR(100),                   -- City of the supplier
--     postal_code VARCHAR(20),             -- Postal code of the supplier
--     country VARCHAR(100),                -- Country of the supplier
--     phone VARCHAR(20),                   -- Phone number of the supplier
--     email VARCHAR(100)                   -- Email address of the supplier
-- );

-- CREATE TABLE stores (
--     id INT PRIMARY KEY,               -- Unique identifier for the store
--     address VARCHAR(255) NOT NULL,    -- Address of the store
--     city VARCHAR(100) NOT NULL,       -- City where the store is located
--     state VARCHAR(100),               -- State or region (optional)
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp when the store was created
-- );

-- CREATE TABLE merchandising_data (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     store_id INT NOT NULL,  -- مفتاح خارجي للمتجر الذي يتم تحليله
--     population INT,  -- عدد السكان في المنطقة
--     average_purchasing_power DECIMAL(10, 2),  -- متوسط القوة الشرائية للسكان
--     competitor_revenue DECIMAL(15, 2),  -- إيرادات المنافسين في المنطقة
--     estimated_revenue DECIMAL(15, 2),  -- الإيرادات المتوقعة للمتجر
--     operational_costs DECIMAL(15, 2),  -- التكاليف التشغيلية للمتجر
--     profit_margin DECIMAL(5, 2),  -- هامش الربح المحسوب
--     analysis_date DATE,  -- تاريخ التحليل
--     FOREIGN KEY (store_id) REFERENCES stores(id)
-- );

-- CREATE TABLE competitors (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,  -- اسم المنافس
--     store_id INT NOT NULL,  -- مفتاح خارجي للمتجر (لربط المنافسين بمنطقة محددة)
--     revenue DECIMAL(15, 2),  -- إيرادات المنافس
--     location VARCHAR(255),  -- موقع المنافس
--     FOREIGN KEY (store_id) REFERENCES stores(id)
-- );

-- CREATE TABLE roles (
--     id INT PRIMARY KEY AUTO_INCREMENT, -- Unique identifier for the role (auto-incremented)
--     role VARCHAR(50) NOT NULL UNIQUE   -- Name of the role (must be unique and not null)
-- );

-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each user
--     password VARCHAR(255) NOT NULL,    -- Store passwords, not plain text
--     email VARCHAR(100) NOT NULL UNIQUE,     -- Email address, must be unique
--     first_name VARCHAR(50),                 -- User's first name
--     last_name VARCHAR(50),                  -- User's last name
--     store_id INT NOT NULL,                        -- Foreign key to the store table
--     role_id INT NOT NULL,                         -- Foreign key to the roles table
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the user was created
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp when the user was last updated
--     FOREIGN KEY (store_id) REFERENCES stores(id), -- Link to the store table
--     FOREIGN KEY (role_id) REFERENCES roles(id)        -- Link to the roles table
-- );

-- -- -------------------------------------------------------------------------------------

-- CREATE TABLE managers (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each manager
--     is_valid BOOLEAN NOT NULL DEFAULT TRUE,  -- Boolean field to indicate if the manager is valid
--     salary DECIMAL(10, 2) NOT NULL,  -- Salary of the manager
--     user_id INT NOT NULL,  -- Foreign key referencing the users table
--     FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
-- );

-- CREATE TABLE employees (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each employee
--     is_valid BOOLEAN NOT NULL DEFAULT TRUE,  -- Boolean field to indicate if the employee is valid
--     salary INT NOT NULL,  -- Salary of the employee
--     performance DECIMAL(5, 2) NOT NULL,  -- Performance percentage (e.g., 95.50 for 95.5%)
--     user_id INT NOT NULL,  -- Foreign key referencing the users table
--     CONSTRAINT fk_user_employee FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
-- );

-- CREATE TABLE orders (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each order
--     supplier_id INT NOT NULL,  -- Foreign key referencing the suppliers table
--     manager_id INT NOT NULL,  -- Foreign key referencing the managers table
--     product_id INT NOT NULL,  -- Foreign key referencing the products table
--     quantity INT NOT NULL,  -- Quantity of the product ordered
--     is_done BOOLEAN NOT NULL DEFAULT FALSE,  -- Boolean field to indicate if the order is completed
--     FOREIGN KEY (supplier_id) REFERENCES suppliers(id),  -- Foreign key constraint for supplier
--     FOREIGN KEY (manager_id) REFERENCES managers(id),  -- Foreign key constraint for manager
--     FOREIGN KEY (product_id) REFERENCES products(id)  -- Foreign key constraint for product
-- );

-- CREATE TABLE reports (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each report
--     user_id INT NOT NULL,  -- Foreign key referencing the users table
--     message TEXT NOT NULL,  -- The content of the report
--     report_type ENUM('profitability', 'competitor_analysis', 'sales_performance') NOT NULL,  -- Enum for report type
--     generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the report was generated
--     subject VARCHAR(255) NOT NULL,  -- The subject of the report
--     FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
-- );

-- CREATE TABLE products (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each product
--     name VARCHAR(100) NOT NULL,  -- Name of the product
--     price DECIMAL(10, 2) NOT NULL,  -- Price of the product
--     stock INT NOT NULL,  -- Quantity of the product in stock
--     supplier_id INT NOT NULL,  -- Foreign key referencing the suppliers table
--     category_id INT NOT NULL,  -- Foreign key referencing the categories table
--     CONSTRAINT fk_supplier FOREIGN KEY (supplier_id) REFERENCES suppliers(id),  -- Foreign key constraint for supplier
--     CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id)  -- Foreign key constraint for category
-- );

-- CREATE TABLE sales (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each sale
--     product_id INT NOT NULL,  -- Foreign key referencing the products table
--     employee_id INT NOT NULL,  -- Foreign key referencing the employees table
--     store_id INT NOT NULL,  -- Foreign key referencing the stores table
--     quantity INT NOT NULL,  -- Quantity of the product sold
--     total DECIMAL(10, 2) NOT NULL,  -- Total amount of the sale
--     date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the sale was made
--     FOREIGN KEY (product_id) REFERENCES products(id),  -- Foreign key constraint for product
--     FOREIGN KEY (employee_id) REFERENCES employees(id),  -- Foreign key constraint for employee
--     FOREIGN KEY (store_id) REFERENCES stores(id)  -- Foreign key constraint for store
-- );

-- CREATE TABLE categories (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each category
--     name VARCHAR(100) NOT NULL,  -- Name of the category
--     description TEXT NOT NULL  -- Description of the category
-- );

-- CREATE TABLE objectifs (
--     id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each objective
--     frequency ENUM('daily', 'weekly') NOT NULL,  -- Enum for daily or weekly
--     type ENUM('quantity_product', 'montant_total') NOT NULL,  -- Enum for quantity or maintenance
--     manager_id INT NOT NULL,  -- Foreign key referencing the managers table
--     FOREIGN KEY (manager_id) REFERENCES managers(id)  -- Foreign key constraint
-- );


use merchandisingDB;

-- جدول suppliers
CREATE TABLE suppliers (
    id INT PRIMARY KEY,                  -- Unique identifier for the supplier
    name VARCHAR(100) NOT NULL,          -- Name of the supplier
    contact_phone VARCHAR(100),          -- Contact person's name
    city VARCHAR(100),                   -- City of the supplier
    postal_code VARCHAR(20),             -- Postal code of the supplier
    country VARCHAR(100),                -- Country of the supplier
    phone VARCHAR(20),                   -- Phone number of the supplier
    email VARCHAR(100)                   -- Email address of the supplier
);

-- جدول stores
CREATE TABLE stores (
    id INT PRIMARY KEY,               -- Unique identifier for the store
    address VARCHAR(255) NOT NULL,    -- Address of the store
    city VARCHAR(100) NOT NULL,       -- City where the store is located
    state VARCHAR(100),               -- State or region (optional)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp when the store was created
);

-- جدول roles
CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT, -- Unique identifier for the role (auto-incremented)
    role VARCHAR(50) NOT NULL UNIQUE   -- Name of the role (must be unique and not null)
);

-- جدول users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each user
    password VARCHAR(255) NOT NULL,    -- Store passwords, not plain text
    email VARCHAR(100) NOT NULL UNIQUE,     -- Email address, must be unique
    first_name VARCHAR(50),                 -- User's first name
    last_name VARCHAR(50),                  -- User's last name
    store_id INT NULL,                        -- Foreign key to the store table
    role_id INT NOT NULL,                         -- Foreign key to the roles table
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the user was created
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp when the user was last updated
    FOREIGN KEY (store_id) REFERENCES stores(id), -- Link to the store table
    FOREIGN KEY (role_id) REFERENCES roles(id)        -- Link to the roles table
);

-- جدول managers
CREATE TABLE managers (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each manager
    is_valid BOOLEAN NOT NULL DEFAULT TRUE,  -- Boolean field to indicate if the manager is valid
    salary DECIMAL(10, 2) NOT NULL,  -- Salary of the manager
    user_id INT NOT NULL,  -- Foreign key referencing the users table
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
);

-- جدول employees
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each employee
    is_valid BOOLEAN NOT NULL DEFAULT TRUE,  -- Boolean field to indicate if the employee is valid
    salary INT NOT NULL,  -- Salary of the employee
    performance DECIMAL(5, 2) NOT NULL,  -- Performance percentage (e.g., 95.50 for 95.5%)
    user_id INT NOT NULL,  -- Foreign key referencing the users table
    CONSTRAINT fk_user_employee FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
);

-- جدول categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each category
    name VARCHAR(100) NOT NULL,  -- Name of the category
    description TEXT NOT NULL  -- Description of the category
);

-- جدول products
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each product
    name VARCHAR(100) NOT NULL,  -- Name of the product
    price DECIMAL(10, 2) NOT NULL,  -- Price of the product
    stock INT NOT NULL,  -- Quantity of the product in stock
    supplier_id INT NOT NULL,  -- Foreign key referencing the suppliers table
    category_id INT NOT NULL,  -- Foreign key referencing the categories table
    CONSTRAINT fk_supplier FOREIGN KEY (supplier_id) REFERENCES suppliers(id),  -- Foreign key constraint for supplier
    CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(id)  -- Foreign key constraint for category
);

-- جدول orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each order
    supplier_id INT NOT NULL,  -- Foreign key referencing the suppliers table
    manager_id INT NOT NULL,  -- Foreign key referencing the managers table
    product_id INT NOT NULL,  -- Foreign key referencing the products table
    quantity INT NOT NULL,  -- Quantity of the product ordered
    is_done BOOLEAN NOT NULL DEFAULT FALSE,  -- Boolean field to indicate if the order is completed
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),  -- Foreign key constraint for supplier
    FOREIGN KEY (manager_id) REFERENCES managers(id),  -- Foreign key constraint for manager
    FOREIGN KEY (product_id) REFERENCES products(id)  -- Foreign key constraint for product
);

-- جدول merchandising_data
CREATE TABLE merchandising_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    store_id INT NOT NULL,  -- مفتاح خارجي للمتجر الذي يتم تحليله
    population INT,  -- عدد السكان في المنطقة
    average_purchasing_power DECIMAL(10, 2),  -- متوسط القوة الشرائية للسكان
    competitor_revenue DECIMAL(15, 2),  -- إيرادات المنافسين في المنطقة
    estimated_revenue DECIMAL(15, 2),  -- الإيرادات المتوقعة للمتجر
    operational_costs DECIMAL(15, 2),  -- التكاليف التشغيلية للمتجر
    profit_margin DECIMAL(5, 2),  -- هامش الربح المحسوب
    analysis_date DATE,  -- تاريخ التحليل
    FOREIGN KEY (store_id) REFERENCES stores(id)
);

-- جدول competitors
CREATE TABLE competitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,  -- اسم المنافس
    store_id INT NOT NULL,  -- مفتاح خارجي للمتجر (لربط المنافسين بمنطقة محددة)
    revenue DECIMAL(15, 2),  -- إيرادات المنافس
    location VARCHAR(255),  -- موقع المنافس
    FOREIGN KEY (store_id) REFERENCES stores(id)
);

-- جدول sales
CREATE TABLE sales (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each sale
    product_id INT NOT NULL,  -- Foreign key referencing the products table
    employee_id INT NOT NULL,  -- Foreign key referencing the employees table
    store_id INT NOT NULL,  -- Foreign key referencing the stores table
    quantity INT NOT NULL,  -- Quantity of the product sold
    total DECIMAL(10, 2) NOT NULL,  -- Total amount of the sale
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the sale was made
    FOREIGN KEY (product_id) REFERENCES products(id),  -- Foreign key constraint for product
    FOREIGN KEY (employee_id) REFERENCES employees(id),  -- Foreign key constraint for employee
    FOREIGN KEY (store_id) REFERENCES stores(id)  -- Foreign key constraint for store
);

-- جدول objectifs
CREATE TABLE objectifs (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each objective
    frequency ENUM('daily', 'weekly') NOT NULL,  -- Enum for daily or weekly
    type ENUM('quantity_product', 'montant_total') NOT NULL,  -- Enum for quantity or maintenance
    manager_id INT NOT NULL,  -- Foreign key referencing the managers table
    FOREIGN KEY (manager_id) REFERENCES managers(id)  -- Foreign key constraint
);

-- جدول reports
CREATE TABLE reports (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique identifier for each report
    user_id INT NOT NULL,  -- Foreign key referencing the users table
    message TEXT NOT NULL,  -- The content of the report
    report_type ENUM('profitability', 'competitor_analysis', 'sales_performance') NOT NULL,  -- Enum for report type
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Timestamp when the report was generated
    subject VARCHAR(255) NOT NULL,  -- The subject of the report
    FOREIGN KEY (user_id) REFERENCES users(id)  -- Foreign key constraint
);