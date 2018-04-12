CREATE TABLE users (
                     id           INTEGER SERIAL PRIMARY KEY,
                     mailaddress  VARCHAR(256) UNIQUE NOT NULL,
                     password     VARCHAR(64)  NOT NULL
                   );
COMMENT ON TABLE users IS 'ユーザ情報を扱うテーブル';

CREATE TABLE photos (
                      id          INTEGER UNIQUE SERIAL PRIMARY KEY,
                      name        TEXT NOT NULL,
                      image_path  TEXT UNIQUE NOT NULL,
                      event_id    INTEGER NOT NULL
                    );
COMMENT ON TABLE photos IS '写真を扱うテーブル';

CREATE TABLE events (
                      id          INTEGER UNIQUE SERIAL PRIMARY KEY,
                      open_day    TIMESTAMP,
                      end_day     TIMESTAMP,
                      event_name  VARCHAR(30) NOT NULL,
                      user_id     INTEGER UNIQUE NOT NULL,
                      auth_key    VARCHAR(9) UNIQUE NOT NULL
                    );
COMMENT ON TABLE events IS 'イベントを扱うテーブル';
