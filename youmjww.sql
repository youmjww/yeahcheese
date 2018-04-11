// usersテーブルの作成
CREATE TABLE users (
                     id INTEGER UNIQUE NOT NULL, 
                     mailaddress TEXT UNIQUE NOT NULL, 
                     password TEXT UNIQUE NOT NULL
                   );
// user id用のシーケンス作成 
CREATE SEQUENCE user_id START WITH 1;

// photosテーブルの作成
CREATE TABLE photos (
                      id INTEGER UNIQUE NOT NULL,
                      name TEXT UNIQUE NOT NULL, 
                      base64 TEXT,
                      event_id INTEGER
                    );
// photo id用のシーケンスを作成
CREATE SEQUENCE event_id START WITH 1;

// eventテーブルの作成
CREATE TABLE events (
                      id INTEGER,
                      open_day TIMESTAMP UNIQUE NOT NULL,
                      end_day tTIMESTAMP UNIQUE NOT NULL,
                      event_name TEXT UNIQUE NOT NULL,
                      user_id INTEGER UNIQUE NOT NULL,
                      auth_key TEXT UNIQUE NOT NULL
                    );
// event id用のシーケンスを作成
CREATE SEQUENCE photo_id START WITH 1;
