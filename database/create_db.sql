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
    id          int auto_increment primary key,
    title       varchar(100) not null,
    description text,
    create_by   int          not null,
    created_at  timestamp default current_timestamp,
    foreign key (create_by) references professor (id)
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

create table if not exists desafios
(
    id int primary key
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
    student_id int not null,
    lesson_id  int not null,
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
    student_id int not null,
    xp         int default 0,
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
    email     varchar(255) unique                                 not null,
    cpf       char(11) unique                                     not null,
    user_type enum ('professor', 'aluno', 'responsavel', 'admin') not null,
    user_id   int
);

# PROCEDURE

delimiter $$

create procedure if not exists new_aluno(in new_name varchar(50),
                                         in new_cpf char(11),
                                         in new_email varchar(50),
                                         in new_password varchar(50),
                                         in new_id_responsavel int,
                                         in new_date_born date)
begin
    declare aluno_id int default null;
    if new_name is not null
    and new_cpf is not null
    and new_email is not null
    and new_password is not null
    and new_id_responsavel is not null
    and new_date_born is not null
    then
        insert into aluno (name, cpf, email, password, id_responsavel, date_born)
        values (new_name, new_cpf, new_email, new_password, new_id_responsavel, new_date_born);
        set aluno_id := (select last_insert_id());
        insert into ranking (student_id, xp, level, position)
        values (aluno_id, 0, 1, 0);

    end if;

end $$

delimiter ;



# VIEWS

create or replace view progresso_aula as
select pa.student_id,
       al.name  as name_aluno,
       pa.completed,
       au.title as aula_title,
       pa.start_date,
       pf.name  as name_professor
from progresso_aluno as pa
         join aula as au on pa.lesson_id = au.id
         join professor as pf on au.create_by = pf.id
         join aluno as al on pa.student_id = al.id;

select *
from progresso_aluno;

create or replace view aluno_responsavel as
select al.id as aluno_id, al.name as aulo_name, re.name as responsavel_name, re.email
from aluno as al
         join responsavel as re on al.id_responsavel = re.id;


# TRIGGERS

delimiter $$

create trigger after_insert_aluno
    after insert
    on aluno
    for each row
begin
    if not exists (select 1 from users where email = new.email or cpf = new.cpf) then
        insert into users (name, email, cpf, user_type, user_id)
        values (new.name, new.email, new.cpf, 'aluno', new.id);
        insert into ranking (student_id)
        values (new.id);
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
        insert into users (name, email, cpf, user_type, user_id)
        values (new.name, new.email, new.cpf, 'responsavel', new.id);
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
        insert into users (name, email, cpf, user_type, user_id)
        values (new.name, new.email, new.cpf, 'professor', new.id);
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
        insert into users (name, email, cpf, user_type, user_id)
        values (new.name, new.email, new.cpf, 'admin', new.id);
    end if;
end $$

delimiter ;


# INSERTS


# RESPONSAVEIS
insert into responsavel (name, cpf, email, password, phone)
values ('João Silva', '12345678901', 'joao.silva@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41999999999');

insert into responsavel (name, cpf, email, password, phone)
values ('Maria Souza', '23456789012', 'maria.souza@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41988888888');

insert into responsavel (name, cpf, email, password, phone)
values ('Carlos Santos', '34567890123', 'carlos.santos@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41977777777');

insert into responsavel (name, cpf, email, password, phone)
values ('Ana Lima', '45678901234', 'ana.lima@email.com', '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6',
        '41966666666');

insert into responsavel (name, cpf, email, password, phone)
values ('Pedro Ferreira', '56789012345', 'pedro.ferreira@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41955555555');

# ALUNOS
insert into aluno (name, cpf, email, password, id_responsavel, date_born)
values ('Lucas Almeida', '67890123456', 'lucas.almeida@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 1, '2010-05-12');

insert into aluno (name, cpf, email, password, id_responsavel, date_born)
values ('Bruna Costa', '78901234567', 'bruna.costa@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 2, '2011-08-21');

insert into aluno (name, cpf, email, password, id_responsavel, date_born)
values ('Paulo Souza', '89012345678', 'paulo.souza@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 3, '2009-12-02');

insert into aluno (name, cpf, email, password, id_responsavel, date_born)
values ('Sofia Santos', '90123456789', 'sofia.santos@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 4, '2012-03-15');

insert into aluno (name, cpf, email, password, id_responsavel, date_born)
values ('Rafael Ferreira', '01234567890', 'rafael.ferreira@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 5, '2011-07-09');

# PROFESSORES
insert into professor (name, cpf, email, password, subject, experience)
values ('Fernanda Oliveira', '12345098765', 'fernanda.oliveira@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 'Matemática', '10 anos de experiência');

insert into professor (name, cpf, email, password, subject, experience)
values ('José Martins', '23456109876', 'jose.martins@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 'Ciências', '15 anos de experiência');

insert into professor (name, cpf, email, password, subject, experience)
values ('Renata Mendes', '34567210987', 'renata.mendes@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 'História', '8 anos de experiência');

insert into professor (name, cpf, email, password, subject, experience)
values ('Rodrigo Costa', '45678321098', 'rodrigo.costa@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 'Geografia', '12 anos de experiência');

insert into professor (name, cpf, email, password, subject, experience)
values ('Carla Lima', '56789432109', 'carla.lima@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', 'Português', '5 anos de experiência');

# ADMINS
insert into admin (name, cpf, email, password, phone, created_by)
values ('Adriano Silva', '67890543210', 'adriano.silva@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41944444444', null);

insert into admin (name, cpf, email, password, phone, created_by)
values ('Bárbara Sousa', '78901654321', 'barbara.sousa@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41933333333', null);

insert into admin (name, cpf, email, password, phone, created_by)
values ('Carlos Oliveira', '89012765432', 'carlos.oliveira@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41922222222', null);

insert into admin (name, cpf, email, password, phone, created_by)
values ('Daniela Melo', '90123876543', 'daniela.melo@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41911111111', null);

insert into admin (name, cpf, email, password, phone, created_by)
values ('Eduardo Lima', '01234987654', 'eduardo.lima@email.com',
        '$2y$10$pKBORQ6xIJ/9YP2JvLic9.ZcO5i/jI7bN.OF0VVV7ZCV4fW.RUiq6', '41900000000', null);


# AULAS
insert into aula (title, description, create_by)
values ('Introdução à Matemática', 'Conceitos básicos de matemática', 1),
       ('Explorando o Mundo dos Animais', 'Aula sobre a diversidade dos animais', 2),
       ('História Antiga', 'Introdução à história das primeiras civilizações', 3),
       ('Geografia do Brasil', 'Características geográficas do Brasil', 4),
       ('Gramática Básica', 'Aula sobre gramática e escrita correta', 5);

# Progresso dos alunos
insert into progresso_aluno (student_id, lesson_id, completed, start_date, end_date)
values (1, 1, true, '2024-01-10', '2024-01-15'),
       (2, 1, false, '2024-01-11', null),
       (3, 2, true, '2024-01-12', '2024-01-20'),
       (4, 2, false, '2024-01-13', null),
       (5, 3, false, '2024-01-14', null),
       (1, 4, true, '2024-02-01', '2024-02-10'),
       (2, 4, false, '2024-02-02', null),
       (3, 5, true, '2024-02-03', '2024-02-10'),
       (4, 5, true, '2024-02-04', '2024-02-11');