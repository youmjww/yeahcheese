// usersテーブルの作成
CREATE TABLE users (
                     id INTEGER UNIQUE NOT NULL PRIMARY KEY,
                     mailaddress VARCHAR(256) UNIQUE NOT NULL,
                     password VARCHAR(64) UNIQUE NOT NULL
                   );
// user id用のシーケンス作成 
CREATE SEQUENCE user_id START WITH 1;

// photosテーブルの作成
CREATE TABLE photos (
                      id INTEGER UNIQUE NOT NULL PRIMARY KEY,
                      name TEXT UNIQUE NOT NULL,
                      base64 TEXT,
                      event_id INTEGER
                    );
// photo id用のシーケンスを作成
CREATE SEQUENCE event_id START WITH 1;

// eventテーブルの作成
CREATE TABLE events (
                      id INTEGER PRIMARY KEY,
                      open_day TIMESTAMP UNIQUE NOT NULL,
                      end_day tTIMESTAMP UNIQUE NOT NULL,
                      event_name VARCHAR(30) UNIQUE NOT NULL,
                      user_id INTEGER UNIQUE NOT NULL,
                      auth_key VARCHAR(9) UNIQUE NOT NULL
                    );
// event id用のシーケンスを作成
CREATE SEQUENCE photo_id START WITH 1;
