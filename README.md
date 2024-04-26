# Warehouse

## Running

```
php -S localhost:8000
```

## Database

```sql
CREATE TABLE Kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO Kategori (nama) VALUES ('Makanan'), ('Minuman');

CREATE TABLE Inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    kategori_id INT,
    harga DECIMAL(10, 2),
    stock INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES Kategori(id)
);

CREATE TABLE BarangMasuk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inventory_id INT,
    jumlah INT,
    tanggal DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (inventory_id) REFERENCES Inventory(id)
);

CREATE TABLE BarangKeluar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    inventory_id INT,
    jumlah INT,
    tanggal DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (inventory_id) REFERENCES Inventory(id)
);

```