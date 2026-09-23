CREATE TABLE user_sessions(
    --sessions id to be used in dashboard
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    --user ID ref
    user_id INT NOT NULL,

    --session attri
    session_start DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    session_end DATETIME DEFAULT NULL,
    session_duration INT DEFAULT NULL,

    -- constaraints and foreign implemantation

    CONSTRAINT fk_user_session_user_id 
        FOREIGN KEY(user_id) 
        REFERENCES users(user_id) 
        ON DELETE CASCADE
        ON UPDATE CASCADE
);