drop database if exists pequenos_cientistas;

create database if not exists pequenos_cientistas;
use pequenos_cientistas;

create table if not exists responsible
(
    id       int auto_increment,
    name     varchar(50)  not null,
    cpf      char(11)     not null,
    email    varchar(50)  not null,
    password varchar(255) not null,
    phone    varchar(15),
    primary key (id),
    unique (cpf),
    unique (email)
);

create table if not exists student
(
    id             int auto_increment,
    name           varchar(50)  not null,
    cpf            char(11)     not null,
    email          varchar(50)  not null,
    password       varchar(255) not null,
    responsible_id int,
    primary key (id),
    unique (cpf),
    unique (email),
    foreign key (responsible_id) references responsible (id)
);

create table if not exists teacher
(
    id       int auto_increment,
    name     varchar(50)  not null,
    cpf      char(11)     not null,
    email    varchar(50)  not null,
    password varchar(255) not null,
    subject  varchar(50),
    primary key (id),
    unique (cpf),
    unique (email)
);

create table if not exists video
(
    id              int auto_increment,
    url             varchar(255) not null,
    name            varchar(50)  not null,
    restriction_age decimal(2),
    primary key (id)
);

create table if not exists lesson
(
    id          int auto_increment,
    title       varchar(100) not null,
    description text,
    date        date         not null,
    teacher_id  int          not null,
    primary key (id),
    foreign key (teacher_id) references teacher (id)
);

create table if not exists task
(
    id          int auto_increment,
    title       varchar(100) not null,
    description text,
    due_date    date,
    lesson_id   int          not null,
    primary key (id),
    foreign key (lesson_id) references lesson (id)
);

create table if not exists student_lesson
(
    student_id int,
    lesson_id  int,
    primary key (student_id, lesson_id),
    foreign key (student_id) references student (id),
    foreign key (lesson_id) references lesson (id)
);

create table if not exists student_task
(
    student_id int,
    task_id    int,
    status     enum ('completed', 'pending') not null,
    primary key (student_id, task_id),
    foreign key (student_id) references student (id),
    foreign key (task_id) references task (id)
);

create table if not exists experiment
(
    id          int auto_increment,
    title       varchar(100) not null,
    description text,
    video_id    int,
    difficulty  enum ('easy', 'medium', 'hard'),
    primary key (id),
    foreign key (video_id) references video (id)
);

create table if not exists teacher_experiment
(
    teacher_id    int,
    experiment_id int,
    primary key (teacher_id, experiment_id),
    foreign key (teacher_id) references teacher (id),
    foreign key (experiment_id) references experiment (id)
);
