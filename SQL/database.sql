create table meaning
(
    id           int unsigned auto_increment
        primary key,
    meaning_text varchar(500) not null,
    created_at   timestamp    null,
    updated_at   timestamp    null
);

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
);

create table sinonimo
(
    id          int unsigned auto_increment
        primary key,
    description varchar(50) not null,
    created_at  timestamp   null,
    updated_at  timestamp   null
);

create table word
(
    id          int unsigned auto_increment
        primary key,
    word_text   varchar(50) not null,
    tech_term   varchar(10) not null,
    firs_letter varchar(50) not null,
    created_at  timestamp   null,
    updated_at  timestamp   null
);

create table word_has_significance
(
    id         int unsigned auto_increment
        primary key,
    word_id    int unsigned not null,
    meaning_id int unsigned not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    constraint word_has_significance_meaning_id_foreign
        foreign key (meaning_id) references meaning (id),
    constraint word_has_significance_word_id_foreign
        foreign key (word_id) references word (id)
);

create table word_has_synonymous
(
    id          int unsigned auto_increment
        primary key,
    word_id     int unsigned not null,
    sinonimo_id int unsigned not null,
    created_at  timestamp    null,
    updated_at  timestamp    null,
    constraint word_has_synonymous_sinonimo_id_foreign
        foreign key (sinonimo_id) references sinonimo (id),
    constraint word_has_synonymous_word_id_foreign
        foreign key (word_id) references word (id)
);
