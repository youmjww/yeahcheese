CREATE TABLE users (
                     id           INTEGER SERIAL PRIMARY KEY,
                     mailaddress  VARCHAR(256) UNIQUE NOT NULL,
                     password     VARCHAR(64)  NOT NULL
                   );
COMMENT ON TABLE users IS 'ユーザ情報を扱うテーブル';
COMMENT ON COLUMN users.id IS 'ユーザの識別ID';
COMMENT ON COLUMN users.mailaddress IS 'ユーザのメールアドレス';
COMMENT ON COLUMN users.password IS 'ユーザのハッシュ化されたパスワード';



CREATE TABLE photos (
                      id          INTEGER UNIQUE SERIAL PRIMARY KEY,
                      name        TEXT NOT NULL,
                      image_path  TEXT UNIQUE NOT NULL,
                      event_id    INTEGER NOT NULL
                    );
COMMENT ON TABLE photos IS '写真を扱うテーブル';
COMMENT ON COLUMN photos.id IS '写真の識別ID';
COMMENT ON COLUMN photos.name IS '写真の名前';
COMMENT ON COLUMN photos.image_path IS '写真の格納されている場所';
COMMENT ON COLUMN photos.event_id IS 'events.id 写真のイベントを識別する為のID';


CREATE TABLE events (
                      id          INTEGER UNIQUE SERIAL PRIMARY KEY,
                      open_day    TIMESTAMP,
                      end_day     TIMESTAMP,
                      event_name  VARCHAR(30) NOT NULL,
                      user_id     INTEGER UNIQUE NOT NULL,
                      auth_key    VARCHAR(9) UNIQUE NOT NULL
                    );
COMMENT ON TABLE events IS 'イベントを扱うテーブル';
COMMENT ON COLUMN events.id IS 'イベントの識別ID';
COMMENT ON COLUMN events.open_day IS 'イベントの公開開始日';
COMMENT ON COLUMN events.end_day IS 'イベントの公開終了日';
COMMENT ON COLUMN events.event_name IS 'イベント名';
COMMENT ON COLUMN events.user_id IS 'user.id イベントのオーナーを識別する為のID';
COMMENT ON COLUMN events.auth_key IS '閲覧者がイベントを閲覧するときに必要になるキー';
