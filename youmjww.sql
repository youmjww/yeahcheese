// usersテーブルの作成
CREATE TABLE users ( id INTEGER, mailaddress TEXT, password TEXT, admin char(4));
// user id用のシーケンス作成 
CREATE SEQUENCE user_id START WITH 1;

// photosテーブルの作成
CREATE TABLE photos (id INTEGER, name TEXT, base64 TEXT, event_id INTEGER);
// photo id用のシーケンスを作成
CREATE SEQUENCE event_id START WITH 1;

// eventテーブルの作成
CREATE TABLE events (id INTEGER, open_day TIMESTAMP, end_day tTIMESTAMP event_name TEXT, user_id INTEGER, auth_key TEXT);
// event id用のシーケンスを作成
CREATE SEQUENCE photo_id START WITH 1;
