drop database if exists pequenos_cientistas;
create database if not exists pequenos_cientistas;
use pequenos_cientistas;

-- Tabela: responsável
create table if not exists responsavel
(
    id            int auto_increment primary key,
    name          varchar(50) not null,
    cpf           char(11) not null unique,
    email         varchar(50) not null unique,
    password      varchar(255) not null,  -- Encrypt the password
    phone         varchar(15)
);

-- Tabela: aluno
create table if not exists aluno
(
    id            int auto_increment primary key,
    name          varchar(50) not null,
    cpf           char(11) not null unique,
    email         varchar(50) not null unique,
    password      varchar(255) not null,  -- Encrypt the password
    phone         varchar(15),
    age           int not null
);

-- Tabela: professor
create table if not exists professor
(
    id            int auto_increment primary key,
    name          varchar(50) not null,
    cpf           char(11) not null unique,
    email         varchar(50) not null unique,
    password      varchar(255) not null,  -- Encrypt the password
    subject       varchar(50) not null,   -- Subject the professor teaches
    experience    text                    -- Description of experience
);

-- Tabela: aula
create table if not exists aula
(
    id            int auto_increment primary key,
    title         varchar(100) not null,
    description   text,
    professor_id  int not null,  -- Foreign key to professor
    created_at    timestamp default current_timestamp,
    foreign key (professor_id) references professor(id)
);

-- Tabela: vídeo
create table if not exists video
(
    id            int auto_increment primary key,
    url           varchar(255) not null,
    title         varchar(100) not null,
    description   text,
    restriction_age int not null,  -- Age restriction for the video
    aula_id       int not null,    -- Foreign key to aula
    foreign key (aula_id) references aula(id)
);

-- Tabela: experimento
create table if not exists experimento
(
    id            int auto_increment primary key,
    title         varchar(100) not null,
    description   text not null,
    materials     text not null,         -- List of materials required
    steps         text not null,         -- Steps to complete the experiment
    professor_id  int not null,          -- Foreign key to professor
    foreign key (professor_id) references professor(id)
);

-- Tabela: notícia
create table if not exists noticia
(
    id            int auto_increment primary key,
    title         varchar(100) not null,
    content       text not null,
    source        varchar(100) not null,  -- Source of the news (e.g., website, journal)
    published_at  date not null
);

-- Tabela: progresso_aluno (relacionamento aluno - aula)
create table if not exists progresso_aluno
(
    id            int auto_increment primary key,
    student_id    int not null,         -- Foreign key to aluno
    lesson_id     int not null,         -- Foreign key to aula
    progress      decimal(5,2) not null, -- Progress as a percentage (0-100)
    completed     boolean default false, -- If the lesson has been completed
    start_date    date,                 -- Date when the lesson was started
    end_date      date,                 -- Date when the lesson was completed
    foreign key (student_id) references aluno(id),
    foreign key (lesson_id) references aula(id)
);

-- Tabela: filtro_conteudo (para os responsáveis controlarem o conteúdo)
create table if not exists filtro_conteudo
(
    id            int auto_increment primary key,
    responsavel_id int not null,          -- Foreign key to responsavel
    student_id    int not null,           -- Foreign key to aluno
    age_limit     int not null,           -- Age limit for content
    foreign key (responsavel_id) references responsavel(id),
    foreign key (student_id) references aluno(id)
);

-- Tabela: admin
create table if not exists admin
(
    id            int auto_increment primary key,
    name          varchar(50) not null,
    cpf           char(11) not null unique,
    email         varchar(50) not null unique,
    password      varchar(255) not null,  -- Encrypt the password
    phone         varchar(15),
    created_by    int,  -- Admin that created this admin
    created_at    timestamp default current_timestamp,
    foreign key (created_by) references admin(id)
);

-- Tabela: permissao_admin (Permissões de administração)
create table if not exists permissao_admin
(
    admin_id      int not null,           -- Foreign key to admin
    permission    varchar(50) not null,   -- Permission type (e.g., 'edit_content', 'manage_users')
    granted_at    timestamp default current_timestamp,
    primary key (admin_id, permission),
    foreign key (admin_id) references admin(id)
);

-- Tabela: ranking
create table if not exists ranking
(
    id            int auto_increment primary key,
    student_id    int not null,           -- Foreign key to aluno
    xp            int not null,           -- Experience points (XP)
    level         int not null,           -- Current level of the student
    position      int not null,           -- Position in the ranking
    foreign key (student_id) references aluno(id)
);

-- Tabela: relatorio_responsavel
create table if not exists relatorio_responsavel
(
    id            int auto_increment primary key,
    responsavel_id int not null,          -- Foreign key to responsavel
    student_id    int not null,           -- Foreign key to aluno
    rank_position int not null,           -- Student's position in the ranking
    xp_earned     int not null,           -- Total XP earned in the report period
    generated_at  timestamp default current_timestamp,
    foreign key (responsavel_id) references responsavel(id),
    foreign key (student_id) references aluno(id)
);

-- Tabela: suporte
create table if not exists suporte
(
    id            int auto_increment primary key,
    user_id       int not null,           -- Foreign key to either aluno, professor, or admin
    user_type     varchar(50) not null,   -- User type (e.g., 'student', 'professor', 'admin')
    issue         text not null,          -- Support issue description
    status        varchar(20) default 'open',  -- Status of the support request
    created_at    timestamp default current_timestamp
);

-- Tabela: chat
create table if not exists chat
(
    id            int auto_increment primary key,
    sender_id     int not null,           -- User ID of the sender
    sender_type   varchar(50) not null,   -- User type (student, professor, responsavel)
    receiver_id   int not null,           -- User ID of the receiver
    receiver_type varchar(50) not null,   -- User type of the receiver
    message       text not null,          -- Message content
    sent_at       timestamp default current_timestamp
);
