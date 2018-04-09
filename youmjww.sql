// usersテーブルの作成
create table users ( id integer, mailaddress text, password text, admin char(4));
// user id用のシーケンス作成 
create sequence user_id start with 1;

// photosテーブルの作成
create table photos (id integer, name text, base64 text, event_id integer);
// photo id用のシーケンスを作成
create sequence event_id start with 1;

// eventテーブルの作成
create table events (id integer, open_day timestamp, end_day timestamp, event_name text, user_id integer, auth_key text);
// event id用のシーケンスを作成
create sequence photo_id start with 1;
