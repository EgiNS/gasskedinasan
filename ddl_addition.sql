CREATE TABLE events 
    ( id INT AUTO_INCREMENT PRIMARY KEY, 
      name VARCHAR(100) NOT NULL, 
      slug VARCHAR(100) NOT NULL UNIQUE, 
      harga DECIMAL(12,2) DEFAULT 0, 
      keterangan TEXT, 
      gambar VARCHAR(255), 
      group_link VARCHAR(255), 
      created_at DATETIME DEFAULT CURRENT_TIMESTAMP, 
      updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
    );

    CREATE TABLE events_tryout (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    tryout_id INT NOT NULL,
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_event
    	FOREIGN KEY (event_id) REFERENCES events(id)
    	ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_tryout
    	FOREIGN KEY (tryout_id) REFERENCES tryout(id)
    	ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT unique_event_tryout UNIQUE (event_id, tryout_id)
);

    
    CREATE TABLE events_pendaftar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    transaction_id INT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_event_pendaftar_event 
        FOREIGN KEY (event_id) REFERENCES events(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,

    CONSTRAINT fk_event_pendaftar_user 
        FOREIGN KEY (user_id) REFERENCES user(id)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,

    CONSTRAINT fk_event_pendaftar_transaction 
        FOREIGN KEY (transaction_id) REFERENCES transactions(id)
        ON DELETE SET NULL 
        ON UPDATE CASCADE
);
