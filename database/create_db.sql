drop database if exists pequenos_cientistas;
create database if not exists pequenos_cientistas;
use pequenos_cientistas;

create table if not exists responsavel
(
    id       int auto_increment primary key,
    name     varchar(50)  not null,
    cpf      char(11)     not null unique,
    email    varchar(50)  not null unique,
    password varchar(255) not null,
    phone    varchar(15)
);

create table if not exists aluno
(
    id             int auto_increment primary key,
    name           varchar(50)  not null,
    cpf            char(11)     not null unique,
    email          varchar(50)  not null unique,
    password       varchar(255) not null,
    id_responsavel int          not null,
    date_born      date         not null,
    foreign key (id_responsavel) references responsavel (id)
);

create table if not exists professor
(
    id         int auto_increment primary key,
    name       varchar(50)  not null,
    cpf        char(11)     not null unique,
    email      varchar(50)  not null unique,
    password   varchar(255) not null,
    subject    varchar(50)  not null,
    experience text
);

create table if not exists aula
(
    id           int auto_increment primary key,
    title        varchar(100) not null,
    description  text,
    professor_id int          not null,
    created_at   timestamp default current_timestamp,
    foreign key (professor_id) references professor (id)
);

create table if not exists video
(
    id              int auto_increment primary key,
    url             varchar(255) not null,
    title           varchar(100) not null,
    description     text,
    restriction_age int          not null,
    aula_id         int          not null,
    foreign key (aula_id) references aula (id)
);

create table if not exists experimento
(
    id           int auto_increment primary key,
    title        varchar(100) not null,
    description  text         not null,
    materials    text         not null,
    steps        text         not null,
    professor_id int          not null,
    foreign key (professor_id) references professor (id)
);

create table if not exists noticia
(
    id           int auto_increment primary key,
    title        varchar(100) not null,
    content      text         not null,
    source       varchar(100) not null,
    published_at date         not null
);

create table if not exists progresso_aluno
(
    id         int auto_increment primary key,
    student_id int           not null,
    lesson_id  int           not null,
    progress   decimal(5, 2) not null,
    completed  boolean default false,
    start_date date,
    end_date   date,
    foreign key (student_id) references aluno (id),
    foreign key (lesson_id) references aula (id)
);

create table if not exists filtro_conteudo
(
    id             int auto_increment primary key,
    responsavel_id int not null,
    student_id     int not null,
    age_limit      int not null,
    foreign key (responsavel_id) references responsavel (id),
    foreign key (student_id) references aluno (id)
);

create table if not exists admin
(
    id         int auto_increment primary key,
    name       varchar(50)  not null,
    cpf        char(11)     not null unique,
    email      varchar(50)  not null unique,
    password   varchar(255) not null,
    phone      varchar(15),
    created_by int,
    created_at timestamp default current_timestamp,
    foreign key (created_by) references admin (id)
);

create table if not exists permissao_admin
(
    admin_id   int         not null,
    permission varchar(50) not null,
    granted_at timestamp default current_timestamp,
    primary key (admin_id, permission),
    foreign key (admin_id) references admin (id)
);

create table if not exists ranking
(
    id         int auto_increment primary key,
    student_id int not null,
    xp         int not null,
    level      int not null,
    position   int not null,
    foreign key (student_id) references aluno (id)
);

create table if not exists relatorio_responsavel
(
    id             int auto_increment primary key,
    responsavel_id int not null,
    student_id     int not null,
    rank_position  int not null,
    xp_earned      int not null,
    generated_at   timestamp default current_timestamp,
    foreign key (responsavel_id) references responsavel (id),
    foreign key (student_id) references aluno (id)
);

create table if not exists suporte
(
    id         int auto_increment primary key,
    user_id    int         not null,
    user_type  varchar(50) not null,
    issue      text        not null,
    status     varchar(20) default 'open',
    created_at timestamp   default current_timestamp
);

create table if not exists chat
(
    id            int auto_increment primary key,
    sender_id     int         not null,
    sender_type   varchar(50) not null,
    receiver_id   int         not null,
    receiver_type varchar(50) not null,
    message       text        not null,
    sent_at       timestamp default current_timestamp
);

create table if not exists users
(
    id        int auto_increment primary key,
    name      varchar(255),
    email     varchar(255) unique                                  not null,
    cpf       char(11) unique                                      not null,
    user_type enum ('professor', 'aluno', 'responsavel', 'admin') not null,
    user_id   int
);

delimiter $$

create trigger after_insert_aluno
    after insert
    on aluno
    for each row
begin
    if not exists (select 1 from users where email = new.email or cpf = new.cpf) then
        insert into users (name, email, cpf, user_type)
        values (new.name, new.email, new.cpf, 'aluno');
    end if;
end $$

delimiter ;

delimiter $$

create trigger after_insert_responsavel
    after insert
    on responsavel
    for each row
begin
    if not exists (select 1 from users where email = new.email or cpf = new.cpf) then
        insert into users (name, email, cpf, user_type)
        values (new.name, new.email, new.cpf, 'responsavel');
    end if;
end $$

delimiter ;

delimiter $$

create trigger after_insert_professor
    after insert
    on professor
    for each row
begin
    if not exists (select 1 from users where email = new.email or cpf = new.cpf) then
        insert into users (name, email, cpf, user_type)
        values (new.name, new.email, new.cpf, 'professor');
    end if;
end $$

delimiter ;

delimiter $$

create trigger after_insert_admin
    after insert
    on admin
    for each row
begin
    if not exists (select 1 from users where email = new.email or cpf = new.cpf) then
        insert into users (name, email, cpf, user_type)
        values (new.name, new.email, new.cpf, 'admin');
    end if;
end $$

delimiter ;
