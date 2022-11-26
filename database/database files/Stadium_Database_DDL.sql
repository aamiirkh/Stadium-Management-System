
CREATE TABLE billing (
    invoice_number INTEGER NOT NULL,
    rate_per_hour  INT(5) NOT NULL,
    total_cost     INT(7) NOT NULL
);


ALTER TABLE billing ADD CONSTRAINT billing_pk PRIMARY KEY ( invoice_number );

CREATE TABLE duration (
    `Date` 					DATE NOT NULL,
    start_time              DATE NOT NULL,
    end_time                DATE NOT NULL,
    no_of_reservation_hours INTEGER NOT NULL
);


CREATE TABLE jobs (
    job_id    varchar(10) NOT NULL,
    job_title VARCHAR(50) NOT NULL,
    salary    INTEGER NOT NULL
);


ALTER TABLE jobs ADD CONSTRAINT jobs_pk PRIMARY KEY ( job_id );

CREATE TABLE location (
    location_id INTEGER NOT NULL,
    address     VARCHAR(150) NOT NULL,
    postal_code INTEGER NOT NULL,
    city        VARCHAR(25) NOT NULL
);

ALTER TABLE location ADD CONSTRAINT location_pk PRIMARY KEY ( location_id );

CREATE TABLE reservation (
    `Date`         DATE NOT NULL,
    start_time     DATE NOT NULL,
    invoice_number INTEGER NOT NULL,
    team_id        INTEGER NOT NULL,
    stadium_id     INTEGER NOT NULL
);

ALTER TABLE reservation ADD CONSTRAINT reservation_pk PRIMARY KEY ( `date`,
                                                                    start_time );

CREATE TABLE seat (
    seat_type    VARCHAR(15) NOT NULL,
    ticket_price int(5) NOT NULL
);

ALTER TABLE seat ADD CONSTRAINT seat_pk PRIMARY KEY ( seat_type );

CREATE TABLE stadium (
    stadium_id       INTEGER NOT NULL,
    stadium_name     VARCHAR(100) NOT NULL,
    stadium_type     varchar(20) NOT NULL,
    stadium_capacity INTEGER NOT NULL,
    location_id      INTEGER NOT NULL
);

ALTER TABLE stadium ADD CONSTRAINT stadium_pk PRIMARY KEY ( stadium_id );

CREATE TABLE staff (
    staff_id     INTEGER NOT NULL,
    f_name       VARCHAR(20) NOT NULL,
    l_name       VARCHAR(20) NOT NULL,
    role         VARCHAR(100) NOT NULL,
    phone_number INTEGER NOT NULL,
    hire_date    DATE NOT NULL,
    job_id       VARCHAR(10) NOT NULL
);

ALTER TABLE staff ADD CONSTRAINT staff_pk PRIMARY KEY ( staff_id );

CREATE TABLE team (
    team_id            INTEGER NOT NULL,
    team_name          VARCHAR(50) NOT NULL,
    no_of_team_members INTEGER
);

ALTER TABLE team ADD CONSTRAINT team_pk PRIMARY KEY ( team_id );

CREATE TABLE team_member (
    member_id    INTEGER NOT NULL,
    team_id      INTEGER NOT NULL,
    f_name       varchar(20) NOT NULL,
    l_name       VARCHAR(20),
    age          INTEGER NOT NULL,
    phone_number INTEGER NOT NULL,
    sex          CHAR(1),
    role         VARCHAR(25)
);

ALTER TABLE team_member ADD CONSTRAINT team_member_pk PRIMARY KEY ( member_id );

CREATE TABLE ticket (
    ticket_id  INTEGER NOT NULL,
    `Date`     DATE NOT NULL,
    start_time DATE NOT NULL,
    stadium_id INTEGER NOT NULL,
    seat_type  VARCHAR(15) NOT NULL
);

ALTER TABLE ticket ADD CONSTRAINT ticket_pk PRIMARY KEY ( ticket_id );

ALTER TABLE duration
    ADD CONSTRAINT duration_reservation_fk FOREIGN KEY ( `Date`,
                                                         start_time )
        REFERENCES reservation ( `Date`,
                                 start_time);

ALTER TABLE reservation
    ADD CONSTRAINT reservation_billing_fk FOREIGN KEY ( invoice_number )
        REFERENCES billing ( invoice_number )
            ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE reservation
    ADD CONSTRAINT reservation_stadium_fk FOREIGN KEY ( stadium_id )
        REFERENCES stadium ( stadium_id )
            ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE reservation
    ADD CONSTRAINT reservation_team_fk FOREIGN KEY ( team_id )
        REFERENCES team ( team_id )
           ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE stadium
    ADD CONSTRAINT stadium_location_fk FOREIGN KEY ( location_id )
        REFERENCES location ( location_id )
            ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE staff
    ADD CONSTRAINT staff_jobs_fk FOREIGN KEY ( job_id )
        REFERENCES jobs ( job_id )
            ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE team_member
    ADD CONSTRAINT team_member_team_fk FOREIGN KEY ( team_id )
        REFERENCES team ( team_id )
            ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ticket
    ADD CONSTRAINT ticket_seat_fk FOREIGN KEY ( seat_type )
        REFERENCES seat ( seat_type )
            ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE ticket
    ADD CONSTRAINT ticket_stadium_fk FOREIGN KEY ( stadium_id )
        REFERENCES stadium ( stadium_id )
            ON UPDATE CASCADE ON DELETE CASCADE;