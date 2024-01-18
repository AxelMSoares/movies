create table if not EXISTS movies (
    id int auto_increment not null,
    title varchar(50) not null,
    release_date date,
    categories varchar (500),
    duration varchar(10),
    synopsis text,
    casting varchar(1000),
    director varchar(100),
    poster varchar(500),
    trailer varchar (500),
    soft_delete boolean,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    primary key (id)
);

create table if not exists categories(
    id int auto_increment not null,
    name varchar(50) not null,
    primary key (id)
);

create table if not exists role(
    id int auto_increment not null,
    name varchar(50) not null,
    primary key (id)
);

create table if not exists users(
    id int auto_increment not null,
    nickname varchar(50) not null,
    pwd varchar(64) not null,
    email varchar(50) not null,
    age tinyint,
    rgpd boolean not null,
    cgu boolean not null,
    newsletters boolean,
    role_id int not null,
    primary key (id),
    foreign key (role_id) references role(id)
);

create table if not exists comments(
    id int auto_increment not null,
    movie_id int not null,
    user_id int not null,
    content text not null,
    primary key (id),
    foreign key (movie_id) references movies(id),
    foreign key (user_id) references users(id)
);

create table if not exists movies_categories(
    id int auto_increment not null,
    movies_id int not null,
    categories_id int not null,
    primary key(id),
    foreign key (movies_id) references movies(id),
    foreign key (categories_id) references categories(id)
);



